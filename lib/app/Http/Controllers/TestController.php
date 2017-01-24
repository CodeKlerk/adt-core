<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class TestController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function post_test()
    {
        $input = Request::all();
        if(!array_key_exists('illnesses', $input)){
            return response('can not read the illnesses');
        }else{
            return response('Illnesses are present');
        }
        // return response()->json($input, 200);
    }
    
}