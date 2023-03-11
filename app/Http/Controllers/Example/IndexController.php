<?php namespace App\Http\Controllers\Example;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use Notsoweb\Core\Http\Traits\Vue\Vuew;

/**
 * Controllador de la página de inicio de los ejemplos
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class IndexController extends Controller
{
    use Vuew;

    /**
     * Constructor
     */
    public function __construct() {
        $this->vueRoot('example');
    }

    /**
     * Página de inicio
     */
    public function index()
    {
        return $this->vuew('index');
    }
}
