<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $fillable = [
        'vaccine_id',
        'name',
        'message',
        'dayhour',
        'alertdaysbefore',
        'status'
    ];

    public static function listStatus($status = null)
    {
        $list = [
            self::STATUS_DISABLED => 'Desabilitado',
            self::STATUS_ENABLED => 'Habilitado',
        ];

        return !empty($status) ? $list[$status] : $list;
    }
}
