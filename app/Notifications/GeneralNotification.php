<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    public $notification_data;

    public function __construct($notification_data)
    {
        $this->notification_data = $notification_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'model_id' => $this->notification_data['model_id'],
            'title' => $this->notification_data['title'],
            'message' => $this->notification_data['message'],
            'type' => $this->notification_data['type'],
        ];
    }
}
