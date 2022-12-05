<?php namespace Database\Seeders;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Roles y permisos iniciales
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'description' => 'Administrador del sistema'
        ]);
        
        $developer = Role::create([
            'name' => 'developer',
            'description' => 'Desarrollador del sistema, desbloquea opciones ocultas.'
        ]);

        $basic = Role::create([
            'name' => 'basic',
            'description' => 'Identifica un usuario sin privilegios'
        ]);
    }
}
