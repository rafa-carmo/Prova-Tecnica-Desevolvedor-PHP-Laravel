<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Person::factory()->has(Phone::factory()->count(random_int(1, 5)))->count(5)->create();

    }
}
