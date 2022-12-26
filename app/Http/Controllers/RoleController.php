<?php namespace App\Http\Controllers;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

/**
 * Administra los roles del usuario
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class RoleController extends Controller
{
    /**
     * Lista los roles del sistema
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::orderBy('name', 'ASC')
                ->select([
                    'id', 
                    'name',
                    'description'
                ])
                ->paginate(config('app.pagination'))
        ]);
    }

    /**
     * Permite crear un nuevo role
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Roles/Create');
    }

    /**
     * Almacena un nuevo role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        $role = Role::create($data);

        $this->reportCreate('roles', $role->toArray(), __('roles.updated', [
            'role' => $role->name
        ]));

        return $this->index();
    }

    /**
     * Actualiz un role
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param Role $role Modelo del Role
     */
    public function update(Request $request, $role) : void
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        $model = Role::find($role);
        $model->update($data);

        $this->reportUpdate('roles', $model->toArray(), __('roles.updated', [
            'role' => $model->name
        ]));
    }

    /**
     * Elimina un role
     * 
     * Se debe de tener mucho cuidado en la eliminación de los roles ya que algunos de ellos
     * estan ligados a nivel codigo en el sistema, lo que podria limitar a los usuarios o
     * bloquear el sistema.
     *
     * @param Role $role Modelo del Role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) : void
    {
        $role->delete();
        $this->reportDestroy('roles', $role->toArray(), __('roles.deleted', [
            'role' => $role->name
        ]));
    }
}
