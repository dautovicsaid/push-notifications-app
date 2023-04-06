<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

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
        return view('home');
    }

    public function deviceTokenUpdate(Request $request)
    {
        $request->user()->update([
            'device_token' => $request->token,
        ]);
    }


    public function notification(Request $request)
    {
        try {
            $tokens = User::query()->whereNotNull('device_token')->pluck('device_token')->toArray();

            Notification::send(null,new SendPushNotification($request->title,$request->message,$tokens));
            return redirect()->back()->with('success','Notification Sent Successfully!!');

        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->back()->with('error','Something went wrong!!');
        }
    }
}
