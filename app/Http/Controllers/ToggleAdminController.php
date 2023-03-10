<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ToggleAdminController extends Controller
{
    public function on(Request $request){
        $user = Auth::user();
        $user->admin = true;
        $user->save();
        $request->session()->flash('flash.success', "Admin mode enabled!");
    }

    public function off(Request $request){
        $user = Auth::user();
        $user->admin = false;
        $user->save();
        $request->session()->flash('flash.success', "Admin mode disabled!");
    }
}
