<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationSend;
use App\Models\Person;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countNotificationsSent = NotificationSend::all();
        $countNotificationsEnabled = Notification::all()->where('status', Notification::STATUS_ENABLED);
        $countPersons = Person::all()->whereNull('person_id');

    
        return view('home', [
            'countNotificationsSent' => count($countNotificationsSent),
            'countNotificationsEnabled' => count($countNotificationsEnabled),
            'countPersons' => count($countPersons),
        ]);
    }
}
