<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPlatform extends Model
{
    use HasFactory;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $fillable = [
        'notification_id',
        'platform_id',
        'message'
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
