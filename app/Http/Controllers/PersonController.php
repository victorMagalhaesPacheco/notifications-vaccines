<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{

    private $personService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PersonService $personService)
    {
        $this->middleware('auth');
        $this->personService = $personService;
    }

    public function index()
    {
        $persons = Person::where('person_id', null)->get();
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
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request;
        $this->personService->create($data);

        return back()->with('success', 'Registro adicionada/atualizada com sucesso.');
    }

    public function delete(Request $request)
    {
        $person = Person::findOrFail($request->id);

        if (count($person->childrens) > 0) {
            return back()->with(['alert' => 'Não é possível deleter  registro. O mesmo tem filhos vínculados.']);
        }

        $person->delete();      
        return back()->with(['success' => 'Registro deletado.']);

    }
}
