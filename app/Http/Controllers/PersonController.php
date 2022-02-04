<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $persons = Person::all();
        return view('persons.index', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request)
    {
        $person = null;
        if ($request->id) {
            $person = Person::findOrFail($request->id);
        }

        $persons = Person::all();
        return view('persons.create', [
            'persons' => $persons,
            'person' => $person
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:persons,email,' . $request->id . '|email:rfc|max:255',
            'birth' => 'required|date'
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Person::updateOrCreate(
            ['id' => $request->id],
            [
                'person_id' => $request->person_id,
                'name' => $request->name,
                'email' => $request->email,
                'birth' => $request->birth,
            ]
        
        );

        return back()->with('success', 'Pessoa adicionada/atualizada com sucesso.');
    }
}
