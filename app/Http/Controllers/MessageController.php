<?php

namespace App\Http\Controllers;

use App\Events\NewMessageNotification;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user_id = Auth::id();

        return view('brodcast', compact('user_id'));
    }

    public function chat(Request $request): View
    {
        $users = User::all();
        $users = $users->filter(function ($user) {
            return $user->id != Auth::id();
        });
        return view('chat', compact('users'));
    }

    public function receive(Request $request): View
    {
        return view('receive');
    }

    public function send(Request $request): RedirectResponse
    {
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->recipient_id = $request->get('receiver_id');
        $message->message = $request->get('message');
        $message->save();

        event(new NewMessageNotification($message));

        return redirect()->back();
    }
}
