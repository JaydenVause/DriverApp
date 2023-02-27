<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;


class AdminDashboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        
        if(!Gate::allows('access-secure-file', $user)){
            return abort(403);
        }

        return Inertia::render('Admin/Dashboard');
    }
}
