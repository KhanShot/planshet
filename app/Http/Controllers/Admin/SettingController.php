<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::query()->first();
        return view('pages.settings', compact('settings'));
    }

    public function create(Request $request){
        Setting::query()->delete();
        Setting::query()->create(['price' => $request->get('price')]);
        return redirect()->back()->with('success', Utils::$MESSAGE_SUCCESS_UPDATED);
    }
}
