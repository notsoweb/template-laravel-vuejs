<?php namespace App\Http\Traits;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Inertia\Inertia;

 /**
 * Conjunto de funciones para automatizar el manejo de rutas de vistas de vue en los 
 * controladores asemejando la forma de llamar a las vistas a la de blade.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
trait VueView
{
    /**
     * Retorna la vista con el formato requerido por vue.
     */
    public function vuew($view, $data = [])
    {
        $route = (isset($this->vueView))
            ? $this->withRootRoute($view)
            : $this->stringToViewFormat($view);

        return Inertia::render(
            $route,
            $data
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
    private function withRootRoute($view)
    {
        $root = $this->stringToViewFormat($this->vueView);

        return $root.'/'.$this->toBladeFormat($view);
    }
}