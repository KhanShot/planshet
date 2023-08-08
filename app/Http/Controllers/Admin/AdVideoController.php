<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils;
use App\Models\AdVideo;
use App\Models\Setting;
use App\Models\View;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;

class AdVideoController extends Controller
{
    public function create(){
        return view('video.create');
    }

    public function detail($video_id){
        $video = AdVideo::query()->with('advertiser')

            ->find($video_id);
        if (!$video)
            return redirect()->route('campaigns')->with('error', Utils::$MESSAGE_DATA_NOT_FOUND);
        $price = Setting::query()->first();

        $views = View::query()->where('video_id', $video->id)->get();
        $data['tablet_count'] = $views->unique('tablet_id')->count();
        $data['views'] = $views->count();
        $data['price'] = $data['views'] * $price->price ?? 1;
        return view('video.detail', compact('video', 'data'));
    }

    public function update(Request $request, $video_id){
        $video = AdVideo::query()->find($video_id);
        if (!$video)
            return redirect()->route('campaigns')->with('error', Utils::$MESSAGE_DATA_NOT_FOUND);

        $video->order = $request->get('order');
        $video->save();
        return redirect()->route('campaigns')->with('success', Utils::$MESSAGE_SUCCESS_UPDATED);

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
