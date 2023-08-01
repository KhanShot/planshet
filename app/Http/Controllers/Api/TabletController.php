<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TabletsModeRequest;
use App\Models\Tablet;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function mode(TabletsModeRequest $request){
        Tablet::query()->updateOrCreate(['mac_address' => $request->get('mac_address')],
            ['last_online' => now(), 'status' => $request->get('status')]);

        //TODO working time avg, all
        // TODO add views, all price

        return $request->all();

    }

}
