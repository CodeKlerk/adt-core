<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\MapsModels\Maps;
use App\Models\MapsModels\MapsItem;
use App\Models\MapsModels\MapsLog;

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
        $response = Maps::all();
        return response()->json($response,200);
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
    public function mapsByIdget($maps_id)
    {
        $response = Maps::findOrFail($maps_id);
        return response()->json($response,200);
    }
    /**
     * Operation mapssPost
     *
     * create an maps.
     *
     *
     * @return Http response
     */
    public function mapspost()
    {
        $input = Request::all();
        $new_map = Maps::create($input);
        if($new_map){
            return response()->json(['msg' => 'add a new map']);
        }else{
            return response('nope');
        }
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
    public function mapsput($maps_id)
    {
        $input = Request::all();
        $map = Maps::findOrFail($maps_id);
        $map->update([
            'status' => $input['status'],
            'code' => $input['code'],
            'period_begin' => $input['period_begin'],
            'period_end' => $input['period_end'],
            'reports_expected' => $input['reports_expected'],
            'reports_actual' => $input['reports_actual'],
            'services' => $input['services'],
            'comments' => $input['comments'],
            'facility_id' => $input['facility_id'],
            'supporter_id' => $input['supporter_id'],
            ]);
        if($map->save()){
            return response()->json(['msg' => 'Update map']);
        }else{
            return response('Oops, it seems like there was a problem updating the map');
        } 
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
    public function mapsdelete($maps_id)
    {
      $deleted_map = Maps::destroy($maps_id);
      if($deleted_map){
        return response()->json(['msg' => 'Deleted Map']);
    }
}    


// maps item

    /**
     * Operation mapsItemget
     *
     * Fetch mapsItem.
     *
     *
     * @return Http response
     */
    public function mapsItemsget($maps_id)
    {
        $response = MapsItem::where('maps_id', $maps_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation mapsItemById
     *
     * Fetch mapsItem specified by mapsItemid.
     *
     * @param int $maps_id ID of mapsItem that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsItemsByIdget($maps_id, $item_id)
    {
        $response = MapsItem::where('maps_id', $maps_id)->where('id', $item_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation mapsItemsPost
     *
     * create an mapsItem.
     *
     *
     * @return Http response
     */
    public function mapsItemspost($maps_id)
    {

        $input = Request::all();
        $new_map_item = MapsItem::create([ 'total'=>$input['total'], 'maps_id'=>$maps_id, 'regimen_id'=>$input['regimen_id'] ]);
        if($new_map_item){
            return response()->json(['msg' => 'add a new map item ', 'data' => $new_map_item]);
        }else{
            return response('Failed to create Maps Item');
        }
    }
    /**
     * Operation mapsItemsmapsItemIdPut
     *
     * Update an existing mapsItem.
     *
     * @param int $maps_id ID of mapsItem that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsItemsput($maps_id, $item_id)
    {
        $input = Request::all();
        $updated_map_item = MapsItem::findOrFail($item_id);
        $updated_map_item->update([ 'total'=>$input['total'], 'maps_id'=>$maps_id, 'regimen_id'=>$input['regimen_id'] ]);
        if($updated_map_item->save()){
            return response()->json(['msg' => 'updated map item ', 'data' => $updated_map_item]);
        }else{
            return response('Failed to update Maps Item');
        }
    }
    /**
     * Operation mapsItemsmapsItemIdDelete
     *
     * Deletes an mapsItem specified by mapsItemId.
     *
     * @param int $maps_id ID of mapsItem that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsItemssdelete($maps_id,$item_id)
    {
        $deleted_map = MapsItem::destroy($item_id);
        if($deleted_map){
            return response()->json(['msg' => 'Deleted Map']);
        }else{
            return response('Failed to delete Maps Item');
        }
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
    public function mapsLogget($maps_id)
    {
        $response = MapsLog::where('maps_id', $maps_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation mapsLogById
     *
     * Fetch mapsLog specified by mapsLogid.
     *
     * @param int $maps_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogByIdget($maps_id, $log_id)
    {
        $response = MapsLog::where('maps_id', $maps_id)->where('id', $log_id)->get();
        return response()->json($response,200);
    }
    /**
     * Operation mapsLogsPost
     *
     * create an mapsLog.
     *
     *
     * @return Http response
     */
    public function mapsLogpost($maps_id)
    {
        $input = Request::all();
        $new_map_log = MapsLog::create([ 'status'=>$input['status'], 'maps_id'=>$maps_id, 'user_id'=>$input['user_id'] ]);
        if($new_map_log){
            return response()->json(['msg' => 'add a new map log ']);
        }else{
            return response('nope');
        }
    }
    /**
     * Operation mapsLogsmapsLogIdPut
     *
     * Update an existing mapsLog.
     *
     * @param int $maps_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogput($maps_id, $log_id)
    {
        $input = Request::all();
        $log = MapsLog::where('maps_id', $maps_id)
        ->where('id', $log_id)
        ->update([ 'status'=>$input['status'], 'user_id'=>$input['user_id'] ]);
        if($log){
            return response()->json(['msg' => 'updated map log ']);
        }else{
            return response('nope');
        }
    }
    /**
     * Operation mapsLogsmapsLogIdDelete
     *
     * Deletes an mapsLog specified by mapsLogId.
     *
     * @param int $maps_id ID of mapsLog that needs to be fetched (required)
     *
     * @return Http response
     */
    public function mapsLogsdelete($maps_id)
    {
        $deleted_map = Maps::destroy($maps_id);
        if($deleted_map){
            return response()->json(['msg' => 'Deleted Map']);
        }
    }   

}