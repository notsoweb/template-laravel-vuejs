<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Events\GlobalNotification;
use Illuminate\Console\Command;

/**
 * Lanza notificaciones a usuarios en linea
 * 
 * La notificación es única y no persistente.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class NotificationInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notsoweb:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instala las dependencias globales para las funciones adicionales';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo shell_exec('npm install -g @soketi/soketi');
        echo shell_exec('npm install -g pm2');
        
        return Command::SUCCESS;
    }
}
