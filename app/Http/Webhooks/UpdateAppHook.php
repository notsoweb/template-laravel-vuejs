<?php namespace App\Http\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Recibe los eventos de actualización de la aplicación
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.1
 */
class UpdateAppHook extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        Log::channel('hook:update-app')->info('update:', $data);
    }
}