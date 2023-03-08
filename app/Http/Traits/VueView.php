<?php namespace App\Http\Traits;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Inertia\Inertia;
use Inertia\Response;

 /**
 * Conjunto de funciones para automatizar el manejo de rutas de vistas de vue en los 
 * controladores asemejando la forma de llamar a las vistas a la de blade.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
trait Vuew
{
    /**
     * Datos que son agregados por otros operadores que seran enviados
     * a la vista de vue.
     */
    protected $otherData = [];

    /**
     * Retorna la vista con el formato requerido por vue.
     */
    public function vuew($view, $data = []) : Response
    {
        $route = (isset($this->vueView))
            ? $this->withRootRoute($view)
            : $this->stringToViewFormat($view);

        return Inertia::render(
            $route,
            array_merge($data, $this->getAllData())
        );
    }

    /**
     * Convierte los puntos y palabras en minusculas en diagonales
     * y palabras que comienzan su primer letra en mayuscula.
     */
    private function stringToViewFormat($string)
    {
        $elements = explode('.', $string);
        $route = [];

        foreach ($elements as $element) {
            $route[] = $this->toBladeFormat($element);
        }

        return implode('/', $route);
    }

    /**
     * Transforma las palabras con guiones segun el estandar de Blade
     * para vistas conformadas por varias palabras a palabras juntas
     * iniciando con mayusculas usadas en Vue.
     * 
     * @param string $string String a transformar
     * @return string
     */
    private function toBladeFormat($string) : string
    {
        $elements = explode('-', $string);
        $words = [];

        foreach ($elements as $element) {
            $words[] = ucfirst($element);
        }

        return implode('', $words);
    }

    /**
     * Con una ruta Raiz
     * 
     * Transforma la vista raíz y despues la añade a la vista.
     * 
     * @param string $view Vista a transformar
     * @return string
     */
    private function withRootRoute($view) : string
    {
        $root = $this->stringToViewFormat($this->vueView);

        return $root.'/'.$this->toBladeFormat($view);
    }

    /**
     * Agrega otros datos
     * 
     * Es usado cuando en multiples funciones envian recurrente un mismo dato
     * en el mismo controlador.
     * 
     * @param array $data Datos a enviar
     */
    protected function addOtherData(array $data)
    {
        $this->otherData += $data;
    }

    /**
     * Obtiene todos las datos independientemente desde donde se allan registrado
     */
    protected function getAllData()
    {
        if (method_exists($this, 'withOtherData'))
        {
            $this->otherData += $this->withOtherData();
        }

        return $this->otherData;
    }
}