<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Lanza notificaciones a usuarios en linea
 * 
 * La notificación es única y no persistente.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class AppUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza la aplicación desde el repositorio por default';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $branch = config('app-repository.branch');
        $response = shell_exec("git pull origin {$branch}");

        Log::channel('app:update')->info($response);
        
        return Command::SUCCESS;
    }
}
