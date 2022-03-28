<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;


    const PLATFORM_SMS = 1;
    const PLATFORM_WHATSAPP = 2;
    const PLATFORM_EMAIL = 3;
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'status'
    ];

    
}
