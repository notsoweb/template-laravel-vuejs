<?php namespace App\Http\Controllers\Dashboard;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use App\Http\Traits\VueView;
use App\Models\HistoryLog;

/**
 * Controla el historial de acciones de los usuarios
 * 
 * Permite ver los registros de las acciones de los usuarios.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * @version 1.0.0
 */
class HistoryLogController extends Controller
{
    use VueView;

    /**
     * Ruta Vista Padre
     */
    protected $vueView = 'dashboard';

    /**
     * Muestra el historial de acciones global
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historyEvent = request()->get('historyEvent');
        $dateStart = request()->get('dateStart');
        $dateEnd = request()->get('dateEnd');

        if($dateEnd) {
            $dateEnd = date('Y-m-d', strtotime("{$dateEnd} + 1 day"));
        }
        
        $searcher = HistoryLog::join('users', 'users.id', '=', 'history_logs.user_id')
            ->where('history_logs.action', 'LIKE', "%{$historyEvent}%");

        if($dateStart  && $dateEnd) {
            $searcher = $searcher->whereBetween('history_logs.created_at', [$dateStart, $dateEnd]);
        } elseif($dateStart && !$dateEnd) {
            $searcher = $searcher->where('history_logs.created_at', '>=', $dateStart);
        } elseif (!$dateStart && $dateEnd) {
            $searcher = $searcher->where('history_logs.created_at', '<=', $dateEnd);
        }

        return $this->vuew('history-log' , [
            'histories' => $searcher ->select([
                    'history_logs.*',
                    'users.name',
                    'users.paternal',
                ])
                ->orderBy('created_at', 'Desc')
                ->paginate(config('global.pagination'))
        ]);
    }
}
