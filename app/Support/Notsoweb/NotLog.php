<?php namespace App\Support\Notsoweb;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

 /**
 * Realiza acción de forma reportada en el log interno de Notsoweb
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class NotLog
{
    /**
     * Genera una contraseña random para un usuario determinado y lo registra en el log.
     * 
     * Permite generar una contraseña para cualquier usuario, pero registra la contraseña en un log.
     * Esto tiene la finalidad de que las contraseñas generadas en los proyectos sean unicas y que
     * no queden plasmadas en el codigo.
     * 
     * @param string $email Correo
     * @param string $password Contraseña
     * 
     * @return array
     */
    public static function NewUser($email) : Array
    {
        $password = Str::random(8);

        Log::channel('notsoweb')->info("Usuario {$email} sembrado");
        Log::channel('notsoweb')->info("Password: {$password}");

        $hash = Hash::make($password);

        return [$email, $hash];
    }
}