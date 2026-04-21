<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateProductNotification extends Notification
{
    use Queueable;
    private $productID;
    /**
     * Create a new notification instance.
     */
    public function __construct($productID)
    {
        $this->productID = $productID;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return [
            'title' => 'محصول جدید',
            'body' => 'محصولی جدید به لیست محصولات افزوده شد',
            'url' => '/admin/product/show/' . $this->productID,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
