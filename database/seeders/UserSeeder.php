<?php namespace Database\Seeders;
/**
 * @copyright Copyright (c) 2022 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\User;
use App\Support\Notsoweb\NotLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Siembra usuarios de forma segura
 * 
 * Siembra usuarios sin la necesidad de escribir una contraseña que quede registrada en el codigo.
 * El usuario será generado con una contraseña que puede ser consultado en el log. Esto permite
 * evitar el escribir las contraseñas en codigo. Esto permite que los usuarios de prueba sean seguros
 * y de proyecto en proyecto no sea una brecha de seguridad tener contraseñas dentro del codigo en caso
 * de que este pueda llegar a ser vulnerado.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuario desarrollador
        [$developerEmail, $developerPass] = NotLog::NewUser('developer@notsoweb.com');

        $user = User::create([
            'name' => 'Developer',
            'last_name' => 'Notsoweb',
            'email' => $developerEmail,
            'phone' => '5631809090',
            'password' => $developerPass,
        ]);

        $user->assignRole(['developer']);
        
        // Usuario administrador
        [$adminEmail, $adminPass] = NotLog::NewUser('admin@notsoweb.com');

        User::create([
            'name' => 'Administrador',
            'last_name' => 'Notsoweb',
            'email' => $adminEmail,
            'password' => $adminPass
        ])->assignRole('admin');

        // Usuario de prueba
        User::create([
            'name' => 'Demo',
            'last_name' => 'Notsoweb',
            'email' => 'demo@notsoweb.com',
            'password' => Hash::make('Demo')
        ]);
    }
}
