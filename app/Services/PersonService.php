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
                'name_notification' => $data->name_notification,
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
                        'name_notification' => $data->childrens_notification[$key],
                        'birth' => $data->birth[$key]
                    ]
                ]);
            }
        }
    }
}