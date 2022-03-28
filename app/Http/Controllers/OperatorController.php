<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
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
        $operators = User::all();
        return view('operators.index', [
            'operators' => $operators
        ]);
    }

    public function create(Request $request)
    {
        $operator = null;
        if ($request->id) {
            $operator = User::findOrFail($request->id);
        }

        return view('operators.create', [
            'operator' => $operator
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:users,email,' . $request->id . '|email:rfc|max:255',
            'password' => 'min:8|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'required'
        ];

        if (isset($request->id) && $request->password_update == 'N') {
            unset($rules['password']);
            unset($rules['password_confirm']);
        }
        
        $validator = Validator::make($request->all(), $rules);        

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            User::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
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
            $operator = User::findOrFail($request->id);
            $operator->delete();      
            return back()->with(['success' => 'Registro deletado.']);
        } catch (Exception $e) {
            return back()->with(['alert' => 'Não foi possível deletar o registro.']);
        } 
    }
}
