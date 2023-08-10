<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils;
use App\Models\Setting;
use App\Models\Tablet;
use App\Models\TabletWorkingTime;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index(){
        $tablets = Tablet::query()
            ->with('views.video')
            ->get();
        $settings = Setting::query()->first();
        $tablets = $tablets->transform(function ($item) use ($settings){
            $item->views_today = 0;
            $item->views_all = 0;

            foreach ($item->views as $view){

                $item->views_all = $item->views_all +  $view->video->duration ?? 0 ;

                if (Carbon::parse($view->created_at)->isToday()){
                    $item->views_today = $item->views_today +  $view->video->duration ?? 0;
                }

            }
            $item->views_budget = $settings->price * $item->views_all;
            return $item;
        });

        return view('pages.tablets', compact('tablets'));
    }



    public function update(Request $request, $tablet_id){
        $tablet = Tablet::query()->find($tablet_id);
        if (!$tablet)
            return redirect()->route('tablets')->with('error', Utils::$MESSAGE_DATA_NOT_FOUND);

        $tablet->name = $request->get('name');
        $tablet->save();

        return redirect()->route('tablets')->with('success', Utils::$MESSAGE_SUCCESS_UPDATED);
    }

    public function reset($tablet_id){
        $tablet = Tablet::query()->find($tablet_id);
        if (!$tablet)
            return redirect()->route('tablets')->with('error', Utils::$MESSAGE_DATA_NOT_FOUND);

        TabletWorkingTime::query()
            ->where('tablet_id', $tablet->id)->delete();
        View::query()
            ->where('tablet_id', $tablet->id)->delete();

        return redirect()->route('tablets')->with('success', Utils::$MESSAGE_SUCCESS_POST);
    }
}
