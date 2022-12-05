<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Reporta una cantidad de algo
     * 
     * @version 1.0.0
     * 
     * @param string $action Accion completa
     * @param array $json Array de datos
     * @param int $qty Cantidad de datos
     * @param string $context Información adicional
     */
    public function reportQty(string $action, array $json, int $qty = 1, string $attribute = null) : void
    {
        Log::channel('report')->info($attribute ,[
            'qty' => $qty,
            'action'=> $action,
            'data' => json_encode($json)
        ]);
    }

    /**
     * Reporta la duplicación de un registro
     * 
     * @version 1.0.0
     * 
     * @param string $module Modulo sobre el que se desencadena la acción
     * @param array $json Array de datos
     * @param string $context Información adicional
     */
    public function reportDuplicated(string $module, array $json, string $context = null) : void
    {
        $this->reportQty(
            action:"{$module}.duplicated",
            json: $json,
            attribute: $context
        );
    }

    /**
     * Reporta la creación de un registro
     * 
     * @version 1.0.0
     * 
     * @param string $module Modulo sobre el que se desencadena la acción
     * @param array $json Array de datos
     * @param string $context Información adicional
     */
    public function reportCreate(string $module, array $json, string $context = null) : void
    {
        $this->reportQty(
            action:"{$module}.created",
            json: $json,
            attribute: $context
        );
    }

    /**
     * Reporta la actualización de un registro
     * 
     * @version 1.0.0
     * 
     * @param string $module Modulo sobre el que se desencadena la acción
     * @param array $json Array de datos
     * @param string $context Información adicional
     */
    public function reportUpdate(string $module, array $json, string $context = null) : void
    {
        $this->reportQty(
            action:"{$module}.updated",
            json: $json,
            attribute: $context
        );
    }

    /**
     * Reporta la eliminación de un registro
     * 
     * @version 1.0.0
     * 
     * @param string $module Modulo sobre el que se desencadena la acción
     * @param array $json Array de datos
     * @param string $context Información adicional
     */
    public function reportDestroy(string $module, array $json, string $context = null) : void
    {
        $this->reportQty(
            action:"{$module}.destroyed",
            json: $json,
            attribute: $context
        );
    }

    /**
    * Inertia Flash
    *
    * Crea unformación el la sessión flash para la siguiente petición.
    * Es capas de acomularlas.
    *
    * @version 1.0.0
    *
    * @param  null|string  $component
    * @param  array|\Illuminate\Contracts\Support\Arrayable  $props
    * @return \Inertia\ResponseFactory|\Inertia\Response
    */
    public function notify($message, $type = 'success', $key = 'flash')
    {
        $old = Inertia::getShared($key, null);
        $data = [
            'type' => $type,
            'message' => $message,
        ];

        if($old) {
            Inertia::share($key, array_merge($old, [$data]));
        } else {
            Inertia::share($key, [$data]);
        }
    }

    /**
     * Retorna todas las notificaciones
     * 
     * @version 1.0.0
     */
    public function getNotifyMessages()
    {
        return Inertia::getShared('flash', []);
    }

    /**
     * Retorna un mensaje de error para fetch
     * 
     * Para aquellas peticiones realizadas por medio de la función fetch en javascript que
     * requieran retornar un error.
     * 
     * @version 1.0.0
     * 
     * @return \Illuminate\Http\JSONResponse
     */
    public function errorFetch($message = "Recurso no encontrado.")
    {
        return response()->json([
            'status' => 404,
            'message' => $message
        ], 404);
    }

    /**
     * Retorna un mensaje de error para fetch
     * 
     * Para aquellas peticiones realizadas por medio de la función fetch en javascript que
     * requieran retornar un error.
     * 
     * @version 1.0.0
     * 
     * @return \Illuminate\Http\JSONResponse
     */
    public function successFetch(array $data = []) : JsonResponse
    {
        return response()->json(array_merge([
            'status' => 200,
        ], $data));
    }
}
