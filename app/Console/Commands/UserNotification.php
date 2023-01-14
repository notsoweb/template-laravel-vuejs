<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\User;
use App\Notifications\UserHeaderNotification;
use Illuminate\Console\Command;

/**
 * Lanza una notificación a un usuario especifico
 * 
 * La notificación queda guardada en las notificaciones del usuario.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class UserNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:user
                    {--email= : Correo del usuario}
                    {--message=Hola mundo : Mensaje a enviar}
                    {--icon=info : Icono de la notificación}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar algo al cliente mediante consola.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->option('email');
        $message = $this->option('message');
        $icon = $this->option('icon');

        if($email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->notify(new UserHeaderNotification($message, $icon));
                echo "Mensaje enviado. \n";

                return Command::SUCCESS;
            } else {
                echo "El usuario no existe";
            }

        } else {
            echo "Se necesita escribir un correo";
        }

        return Command::INVALID;
    }
}
