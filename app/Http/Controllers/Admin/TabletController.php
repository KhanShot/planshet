<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Tablet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index(){
        $tablets = Tablet::query()->with('working_time')
            ->withCount('views')
            ->get();
        $settings = Setting::query()->first();
        $tablets = $tablets->transform(function ($item) use ($settings){
            $item->working_today = 0;
            $item->working_all = 0;

            foreach ($item->working_time as $time){
                if (!is_null($time->end_date)){


                    $item->working_all = $item->working_all + Carbon::create($time->end_date)
                        ->diffInSeconds(Carbon::create($time->start_date));

                    if (Carbon::parse($time->start_date)->isToday()){
                        $item->working_today = $item->working_today +  Carbon::create($time->end_date)
                                ->diffInSeconds(Carbon::create($time->start_date));
                    }
                }else {
                    $item->working_all = $item->working_all + Carbon::create(now())
                            ->diffInSeconds(Carbon::create($time->start_date));

                    if (Carbon::parse($time->start_date)->isToday()) {
                        $item->working_today = $item->working_today + Carbon::create(now())
                                ->diffInSeconds(Carbon::create($time->start_date));
                    }
                }
            }
            $item->views_budget = $settings->price * $item->working_all;
            return $item;
        });

        return view('pages.tablets', compact('tablets'));
    }
}
