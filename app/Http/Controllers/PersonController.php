<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    public function __construct(private PersonService $person){}

    public function index() : Response
    {
        return response($this->person->get_people(),200);
    }


    public function create()
    {
        return "Hello World";
    }

    public function store(CreatePersonRequest $request)
    {

        $this->person->create_person(...$request->validated());
        return response('', 201);
    }


    public function show(Person $person)
    {
        return "Hello World";
    }


    public function edit(Person $person)
    {
        return "Hello World";
    }

    public function update(UpdatePersonRequest $request, Person $person)
    {
        $personData = $request->validated();
        $person->update($personData);
        return response('', 204);
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return response('', 204);
    }
}
