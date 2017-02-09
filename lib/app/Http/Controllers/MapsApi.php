<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class MapsApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    /**
     * Operation mapsget
     *
     * Fetch maps.
     *
     *
     * @return Http response
     */
    public function mapsget()
    {
        // get all
    }
    /**
     * Operation mapsById
     *
     * Fetch Maps specified by mapsid.
     *
     * @param int $maps_id ID of maps that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsById($maps_id)
    {
        $input = Request::all();

        // get one
    }
    /**
     * Operation mapssPost
     *
     * create an maps.
     *
     *
     * @return Http response
     */
    public function mapsspost()
    {
        $input = Request::all();
        // post maps
    }
    /**
     * Operation mapssmapsIdPut
     *
     * Update an existing maps.
     *
     * @param int $maps_id ID of maps that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapssput($maps_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing mapssmapsIdPut as a PUT method ?');
    }
    /**
     * Operation mapssmapsIdDelete
     *
     * Deletes an maps specified by mapsId.
     *
     * @param int $maps_id ID of maps that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapssdelete($maps_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing mapssmapsIdDelete as a DELETE method ?');
    }    

// maps log

    /**
     * Operation mapsLogget
     *
     * Fetch mapsLog.
     *
     *
     * @return Http response
     */
    public function mapsLogget()
    {
        // get all
    }
    /**
     * Operation mapsLogById
     *
     * Fetch mapsLog specified by mapsLogid.
     *
     * @param int $mapsLog_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogById($mapsLog_id)
    {
        $input = Request::all();

        // get one
    }
    /**
     * Operation mapsLogsPost
     *
     * create an mapsLog.
     *
     *
     * @return Http response
     */
    public function mapsLogspost()
    {
        $input = Request::all();
        // post mapsLog
    }
    /**
     * Operation mapsLogsmapsLogIdPut
     *
     * Update an existing mapsLog.
     *
     * @param int $mapsLog_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogsput($mapsLog_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing mapsLogsmapsLogIdPut as a PUT method ?');
    }
    /**
     * Operation mapsLogsmapsLogIdDelete
     *
     * Deletes an mapsLog specified by mapsLogId.
     *
     * @param int $mapsLog_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogsdelete($mapsLog_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing mapsLogsmapsLogIdDelete as a DELETE method ?');
    }   

}