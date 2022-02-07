<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Platform;
use App\Models\Vaccine;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
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

    // public function index()
    // {
    //     $vaccines = Vaccine::all();
    //     return view('vaccines.index', [
    //         'vaccines' => $vaccines
    //     ]);
    // }

    public function create(Request $request)
    {
        $notification = null;
        if ($request->id) {
            $notification = Notification::findOrFail($request->id);
        }

        $vaccines = Vaccine::all();
        $platforms = Platform::all()->where('status', Platform::STATUS_ENABLED);
        $notificationListStatus = Notification::listStatus() ;

        return view('notifications.create', [
            'platforms' => $platforms,
            'vaccines' => $vaccines,
            'notification' => $notification,
            'notificationListStatus' => $notificationListStatus
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vaccine_id' => 'required',
            'platform_ids' => 'required',
            'name' => 'required|max:255',
            'days' => 'required',
            'status' => 'required',
        ], [
            'vaccine_id.required' => 'O campo vacina é obrigatório.',
            'platform_ids.required' => 'O campo plataforma é obrigatório.',
            'days.required' => 'O campo Dias para vacinação após nascimento é obrigatório.',
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $notificationService = new NotificationService();
        $data = $request;
        $notificationService->create($data);
        
        return back()->with('success', 'Registro adicionada/atualizada com sucesso.');
    }

    // public function delete(Request $request)
    // {
    //     $vaccine = Vaccine::findOrFail($request->id);

    //     $vaccine->delete();      
    //     return back()->with(['success' => 'Registro deletado.']);

    // }
}
