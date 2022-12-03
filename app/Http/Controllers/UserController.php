<?php namespace App\Http\Controllers;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

/**
 * Controla los usuarios del sistema
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::whereNotIn('id', [1,2])->select([
                'id',
                'name',
                'paternal',
                'maternal',
                'email',
                'phone'
            ])->paginate(config('app.pagination')),
        ]);
    }

    /**
     * Configuraciones del usuario
     */
    public function settings(User $user)
    {
        return Inertia::render('User/Settings', [
            'user' => $user,
            'userRoles' => $user->roles,
            'roles'=> Role::orderBy('name', 'ASC')
                ->get(),
        ]);
    }

    /**
     * Actualiza la información de un usuario
     */
    public function update(UpdateUser $request, $user)
    {
        $data = $request->all();

        $model = User::find($user);
        $model->update($data);

        $this->reportUpdate('users', $model->toArray(), __('users.updated', [
            'user' => $model->fullName
        ]));
    }

    /**
     * Actualiza la contraseña de un usuario
     * 
     * @param Request $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $data = $this->validate($request, [
            'password' => ['required', 'string', 'min:8'],
            'user_id' => ['required'],
        ]);
        
        $user = User::find($data['user_id']);   
        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        $this->reportUpdate('users', $user->toArray(), __('users.password.updated', [
            'user' => $user->fullName
        ]));
    }

    /**
     * Sincroniza los roles de los usuarios para otorgar permisos
     * 
     * @param Request $request
     * @return void
     */
    public function syncRoles(Request $request)
    {
        $data = $this->validate($request, [
            'roles' => ['required'],
            'user_id' => ['required'],
        ]);

        $roles = [];

        foreach ($data['roles'] as $role) {
            $roles[] = $role['id'];
        }

        $user = User::find($data['user_id']);
        $user->syncRoles($roles);

        $this->reportUpdate('users', $user->toArray(), __('users.roles.updated', [
            'user' => $user->fullName
        ]));
    }

    /**
     * Elimina un usuario del sistema con todos sus registros vinculados
     */
    public function destroy($user)
    {
        try {
            $user = User::find($user);
            $user->delete();

            $this->reportDestroy('users', $user->toArray(),  __('users.deleted', [
                'user' => $user->fullName
            ]));
        } catch (\Throwable $th) {
            Log::channel('users')
                ->error($th->getMessage());
        }
    }
}
