<?php namespace App\Services\Logs;

class LogProcessor
{
    public function __invoke(array $record)
    {
        return array_merge($record, $record['context'], [
            'user_id' => auth()->user()->id
        ]);
    }
}