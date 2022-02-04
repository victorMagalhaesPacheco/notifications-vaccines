<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    public function childrens()
    {
        return $this->hasMany(Person::class);
    }
}
