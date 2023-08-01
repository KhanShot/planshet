<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils;
use App\Models\AdVideo;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;

class AdVideoController extends Controller
{
    public function create(){
        return view('video.create');
    }

    public function store(Request $request){
        $video = new GetId3(request()->file('video'));

        if ($request->hasFile("video")){

            $path = "/assets/videos";
            $request->file("video")->store('public'. $path);
            $name = $request->file("video")->hashName() ;
            $data['video'] = $path."/".$name;
        }

        AdVideo::query()->create([
            'duration' => $video->getPlaytimeSeconds(),
            'is_placeholder' => 1,
            'status' => 'active',
            'name' => $request->get('name') ?? '',
            'url' => $data['video'] ?? '',
        ]);

        return redirect()->route('campaigns')->with('success', Utils::$MESSAGE_SUCCESS_ADDED);
    }

}
