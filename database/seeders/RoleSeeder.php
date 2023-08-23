<?php namespace Database\Seeders;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Notsoweb\Core\Http\Traits\Seeders\RolePermission;

/**
 * Roles y permisos iniciales
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class RoleSeeder extends Seeder
{
    use RolePermission;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::withoutEvents(function () {
            // Permisos para gestionar roles del sistema
            [
                $rolesIndex,
                $rolesCreate,
                $rolesEdit,
                $rolesDestroy
            ] = $this->onCRUD('roles', 'Roles');

            // Permisos para acceder al historial del sistema
            $historiesIndex = $this->onIndex('histories', 'Historal global');

            // Permisos para usuarios
            [
                $usersIndex,
                $usersCreate,
                $usersEdit,
                $usersDestroy
            ] = $this->onCRUD('users', 'Usuarios:');

            $usersConfig = $this->onPermission('users.config', 'Usuarios: Configuraciones adicionales');

            /**
             * Roles con asignación de permisos
             */

            // Desarrollador
            Role::create([
                'name' => 'developer',
                'description' => 'Desarrollador del sistema, desbloquea opciones ocultas.'
            ])->givePermissionTo(Permission::all());

            // Role de administrador
            Role::create([
                'name' => 'admin',
                'description' => 'Administrador del sistema'
            ])->givePermissionTo(
                $historiesIndex,
                $usersIndex,
                $usersCreate,
                $usersEdit,
                $usersDestroy
            );

             // Role de supervisor (solo lectura)
             Role::create([
                'name' => 'supervisor',
                'description' => 'Supervisor: Solo lectura'
            ])->givePermissionTo(
                $historiesIndex,
                $rolesIndex,
                $usersIndex,
            );
        });
    }
}
