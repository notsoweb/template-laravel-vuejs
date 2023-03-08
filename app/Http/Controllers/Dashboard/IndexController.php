<?php namespace App\Http\Controllers\Dashboard;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use Notsoweb\Core\Http\Traits\Vue\Vuew;

/**
 * Controllador de la página de inicio del dashboard del usuario
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class IndexController extends Controller
{
    use Vuew;

    /**
     * Ruta Vista Padre
     */
    protected $vueView = 'dashboard';

    /**
     * Página de inicio
     */
    public function index()
    {
        return $this->vuew('index');
    }
}
