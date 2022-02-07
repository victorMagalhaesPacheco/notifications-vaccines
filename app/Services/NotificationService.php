<?php

namespace App\Services;

use App\Models\Notification;

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


        foreach ($data->platform_ids as $plataformId) {
            $notification->platforms()->createMany([
                [
                    'platform_id' => $plataformId,
                    'message' => $data->{'message_platform_' . $plataformId}
                ]
            ]);
        }
    }
}