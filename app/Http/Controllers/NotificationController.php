<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationSend;
use App\Models\Person;
use App\Models\Platform;
use App\Models\Vaccine;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NotificationController extends Controller
{
    private $notificationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth');
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notifications = Notification::orderBy('id', 'desc')->get();
        return view('notifications.index', [
            'notifications' => $notifications
        ]);
    }

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
            'platform_ids.required' => 'O campo plataforma de envio é obrigatório.',
            'days.required' => 'O campo Dia para notificar após nascimento é obrigatório.',
        ]);

        if ($validator->fails()) {
            return  back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request;
        $this->notificationService->create($data);
        
        return back()->with('success', 'Registro adicionado/atualizado com sucesso.');
    }

    public function send(Request $request)
    {
        $notifications = $this->notificationService->send($request);

        if ($request->has('simulate')) {
            $simulate = $request->input('simulate');
            if ($simulate) {
                return view('notifications.simulate', ['notifications' => $notifications]);
            }
        } else {
           return redirect()->route('notifications.index')->with('success', 'Notificações enviadas com sucesso.');
        }
    }

    public function history()
    {
        return view('notifications.history', [
            'notificationsSent' => NotificationSend::all()
        ]);
    }
}
