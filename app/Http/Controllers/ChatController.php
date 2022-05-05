<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index() {
        $messages = ChatMessage::all();
        return view('chat.index', ['messages' => $messages]);
    }

    public function send(Request $request) {
        ChatMessage::create([
            'user_id' => Auth::id(),
            'content' => $request['message']
        ]);

        return redirect()->back();
    }
}
