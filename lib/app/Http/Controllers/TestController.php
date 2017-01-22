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
        return response()->json($input);
    }
    
}