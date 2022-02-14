<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSend extends Model
{
    use HasFactory;
    
    protected $table = 'notification_send';

    protected $fillable = [
        'notification_id',
        'platform_id',
        'sid',
        'to',
        'body',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }


    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
