<?php

namespace Tests\Feature;

use App\Models\Person;
use App\Models\Phone;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class PeopleTest extends TestCase
{
     use WithFaker;

    public function test_get_people(): void
    {
        $response = $this->get(route("person.index"));
        $response->assertStatus(200);
    }

    public function test_create_person(): void
    {
        $this->setUpFaker();

        $person = [
            'name' => "Person test",
            'cpf' => $this->faker->regexify('[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[\-]?[0-9]{2}'),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->dateTimeInInterval('-20 years')->format("Y-m-d"),
            'nationality' => "Brasilian",
            'phones' => ["2199999999", "2195555559"]
        ];

        $response = $this->call('POST', route('person.store'), $person);

        $response->assertStatus(201);
    }

    public function test_update_person(): void
    {
        $this->setUpFaker();

        Person::where("name", "Person changed")->delete();

        $person = Person::create([
            'name' => "Person test",
            'cpf' => $this->faker->regexify('[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[\-]?[0-9]{2}'),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->dateTimeInInterval('-20 years')->format("Y-m-d"),
            'nationality' => "Brasilian",
            'phones' => ["2199999999", "2195555559"]
        ]);

        $response = $this->call('PUT', route('person.update', ["person" => $person->id]), ["name" => "Person changed"]);

        $response->assertStatus(204);

        $person_changed = Person::where("name", "Person changed")->get();
        $this->assertCount(1, $person_changed);

    }

    public function test_delete_person_with_phones()
    {
        $person = Person::create([
            'name' => "Person test",
            'cpf' => $this->faker->regexify('[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[\-]?[0-9]{2}'),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->dateTimeInInterval('-20 years')->format("Y-m-d"),
            'nationality' => "Brasilian",
            'phones' => ["2199999999", "2195555559"]
        ]);

        $response = $this->call('DELETE', route('person.destroy', ["person" => $person->id]));
        $response->assertStatus(204);

        $phones = Phone::where('person_id', $person->id)->get();
        $people = Person::where("id", $person->id)->get();

        $this->assertCount(0, $phones);
        $this->assertCount(0, $people);

    }
}
