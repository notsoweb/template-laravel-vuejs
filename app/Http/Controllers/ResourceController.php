<?php namespace App\Http\Controllers;
/**
 * @copyright Copyright (c) 2001-2022 Golsystems (https://www.golsystems.mx) - All rights reserved.
 */

use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * Permite traer recursos estaticos que son solo para consulta
 * 
 * Retorna la información necesaria para los select, listas o recursos determinados
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class ResourceController extends Controller
{
    /**
     * Retorna todos los municipios sincronizados con un usuario
     */
    public function rolesByUser($user)
    {
        try {
            $model = User::find($user);
    
            return $this->successFetch([
                'roles' => $model->roles
            ]);
        } catch (\Throwable $th) {
            $this->reportError($th, __METHOD__);
            return $this->errorFetch('El usuario no existe');
        }
    }

    /**
     * Crea log de lso errores ocurridos en este controlador
     */
    private function reportError($th, $method)
    {
        Log::channel('resources')->error("Method: $method");
        Log::channel('resources')->error($th->getMessage());
    }
}
