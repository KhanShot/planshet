<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TabletsModeRequest;
use App\Http\Traits\TJsonResponse;
use App\Http\Traits\Utils;
use App\Models\Tablet;
use App\Models\TabletWorkingTime;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    use TJsonResponse;
    public function mode(TabletsModeRequest $request){
        $tablet = Tablet::query()->updateOrCreate(['mac_address' => $request->get('mac_address')],
            ['last_online' => now(), 'status' => $request->get('status')]);


        //TODO working time avg, all
//        TabletWorkingTime::query()->create([
//            'tablet_id' =>    $tablet->id,
//            'start_date' => now(),
//        ]);

        // TODO add views, all price

        return $this->successResponse(Utils::$MESSAGE_SUCCESS_POST);

    }

}
