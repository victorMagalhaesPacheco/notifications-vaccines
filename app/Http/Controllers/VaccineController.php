<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccineController extends Controller
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
        $vaccines = Vaccine::orderBy('id', 'desc')->get();
        return view('vaccines.index', [
            'vaccines' => $vaccines
        ]);
    }

    public function create(Request $request)
    {
        $vaccine = null;
        if ($request->id) {
            $vaccine = Vaccine::findOrFail($request->id);
        }

        return view('vaccines.create', [
            'vaccine' => $vaccine
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255'
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            Vaccine::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                ]
            
            );

            return back()->with('success', 'Registro adicionado/atualizado com sucesso.');

        } catch (Exception $e) {
            return back()->with(['alert' => 'Não foi criar ou atualizar o registro.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $vaccine = Vaccine::findOrFail($request->id);

            $vaccine->delete();      
            return back()->with(['success' => 'Registro deletado.']);
        } catch (Exception $e) {
            return back()->with(['alert' => 'Não foi possível deletar o registro.']);
        } 

    }
}
