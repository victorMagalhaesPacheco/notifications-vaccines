<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Services\PersonService;
use Exception;
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
            'name_notification' => 'required|min:2|max:255',
            'email' => 'max:255',
            'phone' => 'required',
            'childrens.*' => 'required|min:2|max:255',
            'birth.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $data = $request;
            $this->personService->create($data);

            return back()->with('success', 'Registro adicionado/atualizado com sucesso.');
        } catch (Exception $e) {
            return back()->with(['alert' => 'Não foi criar ou atualizar o registro.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $person = Person::findOrFail($request->id);
            $person->childrens()->delete();
            $person->delete();      
            return back()->with(['success' => 'Registro deletado.']);

        } catch (Exception $e) {
            return back()->with(['alert' => 'Não foi possível deletar o registro.']);
        } 
    }
}
