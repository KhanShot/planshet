<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdVideo;
use App\Models\Setting;
use App\Models\Tablet;
use App\Models\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

        $tablet = Tablet::query();
        $video = AdVideo::query();
        $price = Setting::query()->first();
        $views = View::query()->with('video');

        if ($request->get('date_from')){
            $tablet->where('created_at', '>=', $request->get('date_from'));
            $video->where('created_at', '>=', $request->get('date_from'));
            $views->where('created_at', '>=', $request->get('date_from'));
        }
        if ($request->get('date_to')){
            $tablet->where('created_at', '<=', $request->get('date_to'));
            $video->where('created_at', '<=', $request->get('date_to'));
            $views->where('created_at', '<=', $request->get('date_to'));
        }

        $duration = 0;

        if ($views->count()){
            foreach ($views->get() as $value){
                $duration += $value->video->duration ?? 0;
            }
        }


        $data['tablets'] = $tablet->count();
        $data['video_count'] = $video->count();
        $data['video_duration_all'] = $video->sum('duration');


        $data['price_total'] = $data['video_duration_all'] * 1;
        $data['views_total'] = $views->count();
        $data['views_time_total'] = $duration;
        if ($price){
            $data['price_total'] = $duration * $price->price;
        }

//        dd($data);
        return view('pages.dashboard', compact('data'));
    }
}
