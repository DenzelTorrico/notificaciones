<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create() {
        $users =  User::select(["id","name","email"])->where("id","!=",Auth::user()->id)->get();
        return view("message",compact("users"));
    }
    public function MessageShow(Message $message){

        return $message;
    }
    
        public function CreateMessage(Request $request){
                $request->validate([
                    "subject"=>"required",
                    "body"=>"required",
                ],["subject.required"=>"EL CAMPO SUBJECT DEBE SER OBLIGATORIO",
                    "body.required"=>"POR FAVOR ENVIA UN MENSAJE"
            ]);
            $messageData = $request->all();
            $messageData["from_user_id"] = auth()->user()->id;
            $newmessage = Message::create($messageData);

            $recipient = User::find($messageData["to_user_id"]);
            $delay = now()->addSeconds(10);
            $recipient->notify(new MessageSent($newmessage));

            if ($newmessage) {
                // Mensaje creado exitosamente, redirige a donde quieras
                return redirect()->route('message.index')->with('success', 'Mensaje creado exitosamente');
            } else {
                // Error al insertar el mensaje, redirige de vuelta con el error
                return redirect()->back()->withErrors(['error' => 'Error al crear el mensaje']);
            }
        }
}
