<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\CdrrModels\Cdrr;
use App\Models\CdrrModels\CdrrItem;
use App\Models\CdrrModels\CdrrLog;

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
     *
     * @return Http response
     */
    public function cdrrget()
    {
        return response()->json(Cdrr::all(), 200);
        // return response('Oops, it seems like there was a problem updating the indication');
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
        $response = Cdrr::findOrFail($cdrr_id);
        return response()->json($response, 200);
    }
    /**
     * Operation cdrrPost
     *
     * Add a new CDRR.
     *
     *
     * @return Http response
     */
    public function cdrrpost()
    {
        $input = Request::all();
        $new_cdrr = Cdrr::create($input);
        if($new_cdrr){
            return response()->json(['msg' => 'Added a new cdrr','data'=>$new_cdrr]);
        }else{
            return response('Oops, it seems like there was a problem adding the cdrr');
        }
    }
    /**
     * Operation cdrrput
     *
     * Update CDRR .
     *
     *
     * @return Http response
     */
    public function cdrrput($cdrr_id)
    {
        $input = Request::all();
        $cdrr = Cdrr::findOrFail($cdrr_id);
        $cdrr->update([
            'status' => $input['status'],
            'code' => $input['code'],
            'period_begin' => $input['period_begin'],
            'period_end' => $input['period_end'],
            'comments' => $input['comments'],
            'reports_expected' => $input['reports_expected'],
            'reports_actual' => $input['reports_actual'],
            'services' => $input['services'],
            'is_non_arv' => $input['is_non_arv'],
            'facility_id' => $input['facility_id'],
            'supporter_id' => $input['supporter_id']
        ]);
        if($cdrr->save()){
            return response()->json(['msg' => 'Update CDRR']);
        }else{
            return response('Oops, it seems like there was a problem updating the indication');
        }
    }
    /**
     * Operation cdrrput
     *
     * delete CDRR .
     *
     *
     * @return Http response
     */
    public function cdrrdelete($cdrr_id)
    {
        // delete
    }

    // cdrr logs

    /**
     * Operation cdrrLogget
     *
     * Fetch cdrrLog.
     *
     *
     * @return Http response
     */
    public function cdrrLogget($cdrr_id)
    {
        $response = cdrrLog::where('cdrr_id', $cdrr_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation cdrrLogById
     *
     * Fetch cdrrLog specified by cdrrLogid.
     *
     * @param int $cdrr_id ID of cdrrLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function cdrrLogByIdget($cdrr_id, $log_id)
    {
        $response = cdrrLog::where('cdrr_id', $cdrr_id)->where('id', $log_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation cdrrLogsPost
     *
     * create an cdrrLog.
     *
     *
     * @return Http response
     */
    public function cdrrLogpost($cdrr_id)
    {
        $input = Request::all();
        $new_map_log = cdrrLog::create([ 'status'=>$input['status'], 'cdrr_id'=>$cdrr_id, 'user_id'=>$input['user_id'] ]);
        if($new_map_log){
            return response()->json(['msg' => 'add a new cdrr log ' ,'data'=>$new_map_log]);
        }else{
            return response('Failed to create CDRR log');
        }
    }
    /**
     * Operation cdrrLogscdrrLogIdPut
     *
     * Update an existing cdrrLog.
     *
     * @param int $cdrr_id ID of cdrrLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function cdrrLogput($cdrr_id, $cdrr_id)
    {
        $input = Request::all();
        $log = cdrrLog::where('cdrr_id', $cdrr_id)
                        ->where('id', $log_id)
                        ->update([ 'status'=>$input['status'], 'user_id'=>$input['user_id'] ]);
        if($log){
            return response()->json(['msg' => 'updated cdrr log ','data'=>$log]);
        }else{
            return response('Failed to update map cdrr log');
        }
    }
    /**
     * Operation cdrrLogscdrrLogIdDelete
     *
     * Deletes an cdrrLog specified by cdrrLogId.
     *
     * @param int $cdrr_id ID of cdrrLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function cdrrLogsdelete($cdrr_id,$cdrr_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing cdrrLogscdrrLogIdDelete as a DELETE method ?');
    }   

}