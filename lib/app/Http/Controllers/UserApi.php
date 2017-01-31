<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\UserModels\User;

class UserApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    /**
     * Operation usersGet
     *
     * fetches a list of users at a facility.
     *
     *
     * @return Http response
     */
    public function usersget()
    {
        $response = User::all();
        return response()->json($response,200);
    }
    /**
     * Operation usersPost
     *
     * Add a new user to the facility.
     *
     *
     * @return Http response
     */
    public function userspost()
    {
        $input = Request::all();

        //path params validation


        //not path params validation
        $body = $input['body'];


        return response('How about implementing usersPost as a POST method ?');
    }

    /**
     * Operation usersUsersIdGet
     *
     * Find user by userId.
     *
     * @param int $users_id Particular user specified by the userID (required)
     *
     * @return Http response
     */
    public function usersByIdget($users_id)
    {
        $response = User::findOrFail($users_id);
        return response()->json($response,200);
    }
    /**
     * Operation usersUsersIdPut
     *
     * Update an existing user specified by the userId.
     *
     * @param int $users_id Particular user specified by the userID (required)
     *
     * @return Http response
     */
    public function usersput($users_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing usersUsersIdPut as a PUT method ?');
    }
    /**
     * Operation usersUsersIdDelete
     *
     * Deletes the user specified by the userId.
     *
     * @param int $users_id Particular user specified by the userID (required)
     *
     * @return Http response
     */
    public function usersdelete($users_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing usersUsersIdDelete as a DELETE method ?');
    }
    
}