<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Console\Command;

/**
 * Iniciar servicio de actualización automática
 * 
 * Test 3
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
    protected $description = 'Iniciar servicio de actualización automática.';

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
