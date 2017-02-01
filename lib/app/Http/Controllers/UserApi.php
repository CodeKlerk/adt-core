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
        $response = User::with('created_by', 'access_level')->get();
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
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'access_level_id' => $input['access_level_id'],
            'facility_id' => $input['facility_id'],
            'created_by_id' => $input['created_by_id'],
            'password' => app('hash')->make($input['password']),
            'remember_token' => str_random(10)
        ]);
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
        $user = User::findOrFail($users_id);
        return $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'access_level_id' => $input['access_level_id'],
            'facility_id' => $input['facility_id'],
            'created_by_id' => $input['created_by_id'],
            'password' => app('hash')->make($input['password']),
            'remember_token' => str_random(10)
        ]);
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
        User::destroy($users_id);
    }
    
}