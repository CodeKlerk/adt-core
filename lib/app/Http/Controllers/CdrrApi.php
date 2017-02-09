<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CdrrApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    /**
     * Operation cdrrGet
     *
     * FACILITY CONSUMPTION DATA REPORT AND REQUEST.
     *
     *
     * @return Http response
     */
    public function cdrrget()
    {
        $input = Request::all();

        //path params validation


        //not path params validation
        $limit = $input['limit'];


        return response('How about implementing cdrrGet as a GET method ?');
    }
    /**
     * Operation cdrrCdrrIdGet
     *
     * Fetch all CDFF details specified by cdrrId.
     *
     * @param int $cdrr_id ID of commodity whose details needs to be fetched (required)
     *
     * @return Http response
     */
    public function cdrrByIdget($cdrr_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing cdrrCdrrIdGet as a GET method ?');
    }
    /**
     * Operation cdrrPost
     *
     * Add a new CDRR to the facility.
     *
     *
     * @return Http response
     */
    public function cdrrpost()
    {
        $input = Request::all();

        //path params validation


        //not path params validation
        $body = $input['body'];


        return response('How about implementing cdrrPost as a POST method ?');
    }

}