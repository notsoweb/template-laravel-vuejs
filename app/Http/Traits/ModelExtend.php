<?php namespace App\Http\Traits;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Extención de los modelos para funciones adicionales
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
trait ModelExtend
{
    /**
     * Retorna en un array los atributos rellenados que son rellenables.
     */
    public function fillableToArray() : array
    {
        if(count($this->fillable) > 0) {
            $data = [];
    
            foreach($this->fillable as $fillable) {
                if(!in_array($fillable, $this->hidden)){
                    $data[$fillable] = $this->$fillable;
                }
            }
    
            return $data;
        } else  {
            return $this->toArray();
        }
    }
}