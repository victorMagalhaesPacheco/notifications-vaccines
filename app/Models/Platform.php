<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'status'
    ];

    
}
