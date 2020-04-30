<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Log;

class LogsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(500);
        }

        $logs = Log::all();

        return view('admin.logs.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = Log::find($id);
        $log->delete();
    }
}
