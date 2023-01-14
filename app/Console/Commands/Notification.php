<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Events\GlobalNotification;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid as UuidUuid;

/**
 * Genera un UUID en consola
 * 
 * Diseñado para generar un ID unico que necesitan ser generados en caliente
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:global {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $message = $this->argument('message');

        broadcast(new GlobalNotification(
            $message,
            "info"
        ));
        
        return Command::SUCCESS;
    }
}
