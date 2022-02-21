<?php

namespace App\Services;

use App\Models\Person;

class PersonService
{
    public function create($data)
    {
        $person = Person::updateOrCreate(
            ['id' => $data->id],
            [
                'person_id' => $data->person_id,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
            ]
        );

        $person->childrens()->delete();
        
        if ($data->childrens) {
            foreach ($data->childrens as $key => $child) {
                $person->childrens()->createMany([
                    [
                        'name' => $child,
                        'birth' => $data->birth[$key]
                    ]
                ]);
            }
        }
    }
}