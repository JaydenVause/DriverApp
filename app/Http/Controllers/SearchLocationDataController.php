<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LocationData;


class SearchLocationDataController extends Controller
{
    public function search(Request $request){
        $validator = Validator::make($request->all(),[
            'query' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return abort(403);
        }

        return LocationData::select('id', 'suburb', 'postcode', 'state')
            ->where('postcode', $request->input('query'))
            ->orWhere('suburb','LIKE', '%' . strtoupper($request->input('query') . '%'))
            ->get();
    }
}
