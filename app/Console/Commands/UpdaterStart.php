<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Console\Command;

/**
 * Inicia un demonio que esta a la escucha del evento de actualización enviado por el repositorio
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class UpdaterStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updater:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite iniciar el demonio del actualizador.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        shell_exec("pm2 start --name updater \"node updater.js\"");
        
        return Command::SUCCESS;
    }
}
