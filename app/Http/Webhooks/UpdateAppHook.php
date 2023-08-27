<?php namespace App\Http\Webhooks;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Recibe los eventos de actualización de la aplicación
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.1
 */
class UpdateAppHook extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        Log::channel('hook:update-app')->info('update:', $data);
        Log::channel('app:update')->info('Init updating ...');

        if($data['ref'] == 'refs/heads/main') {
            if($data['before'] != $data['after']) {
                $return = shell_exec('cd ..; git pull origin main');

                Log::channel('app:update')->info($return);
                Log::channel('app:update')->info('Updated');

                foreach ($data['commits'] as $commit) {
                    Log::channel('app:update')->info($commit['message']);
                }
            } else {
                Log::channel('app:update')->info('No was updated');
            }
        } else {
            Log::channel('app:update')->info('Not is updatable');
        }

        Log::channel('app:update')->info('Exit updating');
    }
}