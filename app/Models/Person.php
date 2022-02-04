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
        'birth'
    ];

    public function childrens()
    {
        return $this->hasMany(Person::class);
    }
}
