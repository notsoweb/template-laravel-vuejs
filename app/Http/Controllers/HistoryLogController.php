<?php namespace App\Http\Controllers;

use App\Models\HistoryLog;
use Inertia\Inertia;

class HistoryLogController extends Controller
{
    /**
     * Display a listing of the resource.
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

        return Inertia::render('HistoryLog' , [
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
