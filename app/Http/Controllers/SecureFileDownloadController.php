<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class SecureFileDownloadController extends Controller
{
    /**
     * secure file download actions
     */
    public function download($file_name){

        $user = Auth::user();
        
        if(!Gate::allows('access-secure-file', $user)){
            return abort(403);
        }

        return Storage::disk('medicals')->download($file_name);
    }
}
