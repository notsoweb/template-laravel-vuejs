<?php namespace App\Console\Commands;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid as UuidUuid;

/**
 * Descripción
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class Uuid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:uuid {type=uuid1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Tipos permitidos
     */
    protected $types = [
        'uuid1',
        'uuid2',
        'uuid3',
        'uuid4',
        'uuid5',
        'uuid6',
        'uuid7',
        'uuid8',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');

        if(in_array($type, $this->types)) {
            echo "Type: $type \n";
            echo UuidUuid::$type();
            return Command::SUCCESS;
        }
        
        return Command::INVALID;
    }
}
