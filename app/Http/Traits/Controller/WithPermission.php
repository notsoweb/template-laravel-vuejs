<?php namespace App\Http\Traits\Controller;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Contiene los permisos por default de un CRUD en base a un role
 * 
 * Es especialmente util para validar permisio por permiso en lso controladores por recursos
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
trait WithPermission
{
    /**
     * Solicita los permisos por default de un CRUD
     */
    public function WithCRUDPermission()
    {
        $this->middleware("permission:{$this->rolePermission}.index")
            ->only('index');

        $this->middleware("permission:{$this->rolePermission}.create")
            ->only([
                'create',
                'store'
            ]);

        $this->middleware("permission:{$this->rolePermission}.edit")
            ->only([
                'edit','update'
            ]);

        $this->middleware("permission:{$this->rolePermission}.destroy")
            ->only('destroy');
    }
}