<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\NotificationSend;
use App\Models\Person;
use App\Models\Platform;
use Twilio\Rest\Client;
class NotificationService
{
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

    public function send()
    {
        $notifications = Notification::all()->where('status', Notification::STATUS_ENABLED);
        $childrens = Person::whereNotNull('person_id')->get();

        foreach ($notifications as $notification) {
            foreach ($notification->platforms as $notificationPlatform) {
                foreach ($childrens as $child) {
                    $birth = \Carbon\Carbon::parse($child->birth);
                    $birthAlertDaysBefore = \Carbon\Carbon::parse($child->birth);

                    $daySend = $birth->addDays($notification->days);
                    $daySendAlertDaysBefore = $birthAlertDaysBefore->addDays($notification->alertdaysbefore);
              
                    if ($daySend->format('Y-m-d') == Date('Y-m-d')) {
                        $message = str_replace(
                            ['[person.name]', '[child.name]'],
                            [$child->parent->name, $child->name],
                            $notificationPlatform->message
                        );
                        $this->sendMessage($notificationPlatform, $child->parent, $message);                     
                    }

                    if ($daySendAlertDaysBefore->format('Y-m-d') == Date('Y-m-d')) {
                        $message = str_replace(
                            ['[person.name]', '[child.name]'],
                            [$child->parent->name, $child->name],
                            '[Alerta] ' . $notificationPlatform->message
                        );
                        $this->sendMessage($notificationPlatform, $child->parent, $message);                     
                    }
                }
            }
        }
    }

    private function sendMessage($notificationPlatform, $parent, $message)
    {
        $sid = env('TWILIO_ACCOUNT_SID', '');
        $token = env('TWILIO_AUTH_TOKEN', '');
        $client = new Client($sid, $token);

        if ($notificationPlatform->platform_id == Platform::PLATFORM_SMS) {
            $request = $client->messages->create(
                '+55' . $parent->phone,
                [
                    'from' => env('TWILIO_NUMBER_FROM', ''),
                    'body' => $message
                ]
            );

            NotificationSend::create([
                'notification_id' => $notificationPlatform->notification_id,
                'platform_id' => $notificationPlatform->platform_id,
                'sid' => $request->sid,
                'to' => $request->to,
                'body' => $request->body
            ]);
        } else if ($notificationPlatform->platform_id == Platform::PLATFORM_EMAIL) {
            $details = [
                'title' => 'VacineME - Notificação',
                'message' => $message
            ];
              
            \Mail::to($parent->email)->send(new \App\Mail\NotificationMail($details));

            NotificationSend::create([
                'notification_id' => $notificationPlatform->notification_id,
                'platform_id' => $notificationPlatform->platform_id,
                'sid' => '---',
                'to' => $parent->email,
                'body' => $message
            ]);
        }
       
    }
}