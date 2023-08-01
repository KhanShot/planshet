<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdVideo;
use Illuminate\Http\Request;

class AdVideoController extends Controller
{
    public function getList(){
        $videos = AdVideo::query()->get();
        return $videos->transform(function ($item){
            $item->url = '/storage'.$item->url;
            return $item;
        });
    }

}
