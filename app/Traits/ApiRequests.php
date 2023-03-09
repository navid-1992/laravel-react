<?php

namespace App\Traits;

use App\Models\ApiData;
use App\Models\ApiRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ApiRequests
{
    function populateData($forceRefresh = false){
        if($this->checkIfCanRequest() || $forceRefresh){
            try{
                $res = $this->http->get('https://cspf-dev-challenge.herokuapp.com');

                if($res->getStatusCode() == 200){
                    $result = $res->getBody()->getContents();
                    $result = json_decode($result,true);
                    if(sizeof($result['data']) > 0)
                    {
                        $data = $result['data']['rows'];
                        try{
                            DB::table('api_data')->truncate();
                            ApiData::insert($data);
                            ApiRequest::updateOrInsert(
                                ['id'=>1],
                                ['api_called'=>1,'api_called_time'=>date('Y-m-d H:i:s')]
                            );
                        }catch (\Exception $e){dd($e->getMessage());}

                    }
                }
            }catch (\Exception $e){dd($e->getMessage());}
        }
    }

    function checkIfCanRequest(): bool
    {
        $request_api = ApiRequest::find(1);
        if(!empty($request_api)){
            if($request_api->api_called){
                $diff = Carbon::now()->diffInHours($request_api->api_called_time);
                if($diff >= 1)
                    return true;
                return false;
            }
        }
        return true;
    }
}
