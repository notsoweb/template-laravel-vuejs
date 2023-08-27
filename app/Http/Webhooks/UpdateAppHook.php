<?php namespace App\Http\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateAppHook extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        Log::channel('hook:update-app')->info('update:', $data);
    }
}