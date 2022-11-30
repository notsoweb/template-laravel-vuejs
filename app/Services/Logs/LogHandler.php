<?php namespace App\Services\Logs;

use App\Models\HistoryLog;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class LogHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    protected function write(array $record) :void
    {
       // Simple store implementation
       $log = new HistoryLog();
       $log->fill($record);
       $log->save();
    }
}