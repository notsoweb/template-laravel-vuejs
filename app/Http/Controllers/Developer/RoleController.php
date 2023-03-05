<?php namespace App\Http\Controllers\Developer;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use App\Http\Traits\Controller\WithPermission;
use App\Http\Traits\VueView;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * Administra los roles del sistema
 * 
 * CRUD de los roles. Algunos roles estan implicitos en el código para dar permisos. Por lo que
 * es un controlador sensible.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class RoleController extends Controller
{
    use VueView, WithPermission;

    /**
     * Role base
     */
    public $rolePermission = 'roles';

    /**
     * Ruta Vista Padre
     */
    protected $vueView = 'developer.roles';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->WithCRUDPermission();
    }

    /**
     * Lista los roles del sistema
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->vuew('index', [
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
        return $this->vuew('create');
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
    }
}
