<?php namespace App\Services\Logs;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Models\HistoryLog;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

/**
 * Dispara el LOG
 * 
 * Almacena las acciones de los usuairos en la base de datos
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class LogHandler extends AbstractProcessingHandler
{
    /**
     * Constructor
     */
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    /**
     * Escribe el log recibido
     * 
     * @param array $record Array con la infomación a registrar
     */
    protected function write(LogRecord $record) :void
    {
       // Simple store implementation
       $log = new HistoryLog();
       $log->fill($record);
       $log->save();
    }
}