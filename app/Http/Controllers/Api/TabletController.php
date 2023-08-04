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
        if ($request->get('status') == 'on'){
            $twt = TabletWorkingTime::query()
                ->where('tablet_id', $tablet->id)
                ->whereNull('end_date')
                ->orderBy('start_date', 'DESC')->first();
            if ($twt)
                return $this->failedResponse('tablet is already on (планшет еще не был выключен!)', 400);
            TabletWorkingTime::query()->create([
                'tablet_id' =>    $tablet->id,
                'start_date' => $request->get('time'),
                'end_date' => null,
            ]);
        }else{
            $twt = TabletWorkingTime::query()
                ->where('tablet_id', $tablet->id)
                ->whereNull('end_date')
                ->orderBy('start_date', 'DESC')->first();
            if (!$twt)
                return 'no such sucks';
            $twt->end_date = $request->get('time');
            $twt->save();
        }

        // TODO add views, all price

        return $this->successResponse(Utils::$MESSAGE_SUCCESS_POST);

    }

}
