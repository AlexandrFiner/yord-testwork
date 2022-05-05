<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function index() {
        $messages = ChatMessage::all();
        return view('chat.index', ['messages' => $messages]);
    }

    public function send(Request $request) {
        if(Auth::user()) {

            $message = ChatMessage::create([
                'user_id' => Auth::id(),
                'content' => $request['message']
            ]);

            broadcast(new MessageSent($message))->toOthers();
            // return redirect()->back();
        }
        // return redirect()->back();
        return;
    }
}
