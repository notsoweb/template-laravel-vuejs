<?php namespace App\Notifications;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

/**
 * Dispara una notificación a un usuario especifico
 * 
 * Estas notificaciones son las que se encuentrar en el menu superior, en el header.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class UserHeaderNotification extends Notification
{
    use Queueable;

    /**
     * Parametros para detonar la notificación
     *
     * @return void
     */
    public function __construct(
        public $message,
        public $icon = 'notifications_active',
        public $type = 'info',
    ) {}

    /**
     * Canales de envio de la notificación
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * Obtiene la representación del array de la notificación.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'icon' => $this->icon,
            'type' => $this->type,
        ];
    }

    /**
     * Manda un mensaje por medio de un broadcast privado
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'icon' => $this->type,
        ]);
    }
}
