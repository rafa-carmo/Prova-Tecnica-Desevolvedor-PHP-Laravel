<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Phone;

class PersonService {

    public function get_people(): String {
        $people = Person::with('phones')->get()->toJson(JSON_PRETTY_PRINT);
        return $people;
    }

    public function create_person(
        String $name,
        String $cpf,
        String $email,
        String $birth_date,
        String $nationality,
        Array $phones,
    ): int
    {

        $params = array_filter(get_defined_vars());
        unset($params["phones"]);
        $person = Person::create($params);


        $phones_to_save = [];
        foreach( $phones as $phone ) {
            array_push($phones_to_save, new Phone(["phone" => $phone, "person_id", $person->id]));
        }
        $person->phones()->saveMany($phones_to_save);

        return $person->id;
    }
}
