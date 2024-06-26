<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TaskComplete extends Notification
{
    use Queueable;
    protected $data;
    protected $user_id;
    protected $assigned_by;
    protected $assigned_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($user_id,$data)
    {
        $this->user_id = $user_id;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->data['assigned_to'].' completed Task',
            'body'  => $this->data['task_title'],
            'user_id'=>$this->user_id,
            'url' => route('admin.tasks.index'),
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->data['assigned_to'].' completed Task',
            'body'  => $this->data['task_title'],
            'user_id'=>$this->user_id,
            'url' => route('admin.tasks.index'),
        ]);
    }

    /**
     * Set the broadcast channel of the notification.
     */
    public function broadcastOn(){
        return ['my-channel'];
    }
}
