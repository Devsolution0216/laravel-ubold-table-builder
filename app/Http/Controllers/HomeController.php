<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Template;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $permission = DB::table('model_has_roles')
                    ->leftJoin('role_has_permissions', 'model_has_roles.role_id', '=', 'role_has_permissions.role_id')
                    ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->where('model_has_roles.model_id', '=', $user_id)
                    ->pluck('name')[0];

        if ($permission == "users_manage") {
            return redirect(url('/admin/templates'));
        } else {
            return redirect(url('/datas'));
        }
    }
}
