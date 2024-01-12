<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        //
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail',"database"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $sender = User::find($this->message->sender_id);
        return (new MailMessage)->from("no-reply@codersfree.com","Coders free")
                ->subject($this->message->subject)
                ->attach(public_path("img/442562.jpg"),[
                    "as"=>"imagen.jpg",
                    "mime"=>"image/jpeg"
                ])->view("email.message-sent",[
                    "sender"=>$sender,
                    "body"=>$this->message->body
                ]);
                    /*->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                                ->line('Thank you for using our application!');*/
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $sender = User::find($this->message->sender_id);
        return [
            "url"=>route("message.show",$this->message),
            "message"=>"Has recibido un nuevo mensaje de".$sender->name
        ];
    }

    
   
}
