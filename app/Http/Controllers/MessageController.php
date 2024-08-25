<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = $request->sender_id;
        $message->suggestion_id = $request->suggestion_id;
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => $message]);
    }

    public function getMessages($suggession_id)
    {
        $messages = Message::where('suggestion_id', $suggession_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
}
