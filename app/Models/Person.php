<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'person_id',
        'name',
        'email',
        'birth',
        'phone'
    ];

    public function childrens()
    {
        return $this->hasMany(Person::class);
    }

    public function parent()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function getPhoneWhatsapp()
    {
        $whatsapp = str_replace(['(', ')'], ['', ''], $this->phone);
        return substr_replace($whatsapp, '', 2, 1);
    }
}
