<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoEndRequest;
use App\Http\Traits\TJsonResponse;
use App\Http\Traits\Utils;
use App\Models\AdVideo;
use App\Models\Tablet;
use App\Models\View;
use Illuminate\Http\Request;

class AdVideoController extends Controller
{
    use TJsonResponse;
    public function getList(){
        $videos = AdVideo::query()->get();
        return $videos->transform(function ($item){
            $item->url = '/storage'.$item->url;
            return $item;
        });
    }

    public function videoEnd(VideoEndRequest $request)
    {
        $tablet = Tablet::query()->where('mac_address', $request->get('mac_address'))->first();
        $video = AdVideo::query()->where('name', $request->get('video_name'))->first();

        $data = [
            'tablet_id' => $tablet->id,
            'video_id' => $video->id,
        ];

        View::query()->create($data);
        return $this->successResponse(Utils::$MESSAGE_SUCCESS_POST);
    }
}
