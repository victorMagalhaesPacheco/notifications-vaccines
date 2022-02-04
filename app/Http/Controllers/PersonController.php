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

    public function create()
    {
        $persons = Person::all();
        return view('persons.create', [
            'persons' => $persons
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:persons|email:rfc|max:255',
            'birth' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect(route('persons.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Person::create([
            'person_id' => $request->person_id,
            'name' => $request->name,
            'email' => $request->email,
            'birth' => $request->birth,
        ]);

        return back()->with('success', 'Pessoa adicionada com sucesso.');
    }
}
