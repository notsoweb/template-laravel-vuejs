<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

/**
 * Controlador padre
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.1
 */
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
}
