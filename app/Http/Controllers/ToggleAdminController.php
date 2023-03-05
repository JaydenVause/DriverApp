<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ToggleAdminController extends Controller
{
    public function on(){
        $user = Auth::user();
        $user->admin = true;
        $user->save();
    }

    public function off(){
        $user = Auth::user();
        $user->admin = false;
        $user->save();
    }
}
