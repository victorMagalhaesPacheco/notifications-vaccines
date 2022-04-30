<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\NotificationSend;
use App\Models\Person;
use App\Models\Platform;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    private $twilio;

    public function __construct()
    {
        $sid = env('TWILIO_ACCOUNT_SID', '');
        $token = env('TWILIO_AUTH_TOKEN', '');
        $this->twilio = new Client($sid, $token);
    }

    public function create($data)
    {
        $notification = Notification::updateOrCreate(
            ['id' => $data->id],
            [
                'vaccine_id' => $data->vaccine_id,
                'name' => $data->name,
                'days' => $data->days,
                'alertdaysbefore' => $data->alertdaysbefore,
                'status' => $data->status,
            ]
        );

        $notification->platforms()->delete();
        
        foreach ($data->platform_ids as $plataformId) {
            $notification->platforms()->createMany([
                [
                    'platform_id' => $plataformId,
                    'message' => $data->{'message_platform_' . $plataformId}
                ]
            ]);
        }
    }

    public function send(Request $request)
    {
        $notifications = Notification::all()->where('status', Notification::STATUS_ENABLED);
        $childrens = Person::whereNotNull('person_id')->get();

        $simulate = false;
        if ($request->has('simulate')) {
            $simulate = $request->input('simulate');
        }

        $notificationsSend = [];

        foreach ($notifications as $notification) {
            foreach ($notification->platforms as $notificationPlatform) {
                foreach ($childrens as $child) {
                    $birth = \Carbon\Carbon::parse($child->birth);
                    $birthAlertDaysBefore = \Carbon\Carbon::parse($child->birth);

                    $daySend = $birth->addDays($notification->days);
                    
                    if (!is_null($notification->alertdaysbefore)) {
                        $daySendAlertDaysBefore = $birthAlertDaysBefore->addDays($notification->alertdaysbefore);
                    } else {
                        $daySendAlertDaysBefore = $birthAlertDaysBefore;
                    }

                    if ($daySend->format('Y-m-d') == Date('Y-m-d')) {
                        $message = str_replace(
                            ['[person.name]', '[child.name]'],
                            [$child->parent->name_notification, $child->name_notification],
                            $notificationPlatform->message
                        );
                        $notificationsSend[] = $this->sendMessage($notificationPlatform, $child->parent, $message, $simulate);                     
                    }

                    if ($daySendAlertDaysBefore->format('Y-m-d') == Date('Y-m-d')) {
                        $message = str_replace(
                            ['[person.name]', '[child.name]'],
                            [$child->parent->name_notification, $child->name_notification],
                            $notificationPlatform->message
                        );
                        $notificationsSend[] = $this->sendMessage($notificationPlatform, $child->parent, $message, $simulate);                     
                    }
                }
            }
        }

        return $notificationsSend;
    }

    private function sendMessage($notificationPlatform, $parent, $message, $simulate)
    {
        if (!$simulate) {
            if ($notificationPlatform->platform_id == Platform::PLATFORM_SMS) {
                try {
                    $request = $this->twilio->messages->create(
                        '+55' . $parent->phone,
                        [
                            'from' => env('TWILIO_NUMBER_FROM', ''),
                            'body' => $message
                        ]
                    );

                    $sid = $request->sid;
                    $to = $request->to;
                    $message = $request->body;
                } catch (\Twilio\Exceptions\RestException $restException) {
                    Log::error($restException->getMessage());
                }
            } else if ($notificationPlatform->platform_id == Platform::PLATFORM_WHATSAPP) {
                try {
                    $request = $this->twilio->messages->create(
                        'whatsapp:+55' . $parent->getPhoneWhatsapp(),
                        [
                            'From' => 'whatsapp:' . env('TWILIO_NUMBER_WHATSAPP_FROM', ''),
                            'Body' => $message
                        ]
                    );

                    $message = $request->body;
                    $sid = $request->sid;
                    $to = $request->to;
                } catch (\Twilio\Exceptions\RestException $restException) {
                    Log::error($restException->getMessage());
                }                
            } else if ($notificationPlatform->platform_id == Platform::PLATFORM_EMAIL) {
                $details = [
                    'title' => 'vaciname - Notificação',
                    'message' => $message
                ];
                  
                \Mail::to($parent->email)->send(new \App\Mail\NotificationMail($details));
    
                $sid = '---';
                $to = $parent->email;
            } 
    
            NotificationSend::create([
                'notification_id' => $notificationPlatform->notification_id,
                'platform_id' => $notificationPlatform->platform_id,
                'person_id' => $parent->id,
                'sid' => $sid ?? '---',
                'to' => $to ?? '---',
                'body' => $message
            ]);
        } else {
            if ($notificationPlatform->platform_id == Platform::PLATFORM_SMS) {
                $to = $parent->phone;
            } else if ($notificationPlatform->platform_id == Platform::PLATFORM_EMAIL) {
                $to = $parent->email;
            } else if ($notificationPlatform->platform_id == Platform::PLATFORM_WHATSAPP) {
                $to = $parent->phone;
            }

            $nofiticationsSimulated = [
                'platform' => $notificationPlatform->platform->name,
                'person' => '#' . $parent->id . ' - ' . $parent->name,
                'to' => $to,
                'body' => $message
            ];

            return $nofiticationsSimulated;
        }
    }

    public function __invoke()
    {

        Log::info("CRONTAB EXECUTADA COM SUCESSO.");
        $this->send(new Request());
    }
}