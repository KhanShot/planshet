<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdVideo;
use App\Models\Setting;
use App\Models\Tablet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['tablets'] = Tablet::query()->count();
        $data['video_count'] = AdVideo::query()->count();
        $data['video_duration_all'] = AdVideo::query()->sum('duration');
        $price = Setting::query()->first();
        $data['price_total'] = $data['video_duration_all'] * 1;
        if ($price){
            $data['price_total'] = $data['video_duration_all'] * $price->price;
        }
        return view('pages.dashboard', compact('data'));
    }
}
