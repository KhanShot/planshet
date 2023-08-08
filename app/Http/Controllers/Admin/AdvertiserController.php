<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiserStoreRequest;
use App\Http\Traits\Utils;
use App\Models\Advertiser;
use App\Models\AdVideo;
use App\Models\Setting;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdvertiserController extends Controller
{
    public function index(){
        $advertisers = Advertiser::query()->with('user')->get();
        return view('advertisers.index', compact('advertisers'));
    }

    public function detail($adv_id){
        $advertiser = Advertiser::query()->with('user')

            ->find($adv_id);
        if (!$advertiser)
            return redirect()->route('advertisers')->with('error', Utils::$MESSAGE_DATA_NOT_FOUND);

        $videos = AdVideo::query()->where('advertiser_id', $advertiser->id)->pluck('id');

        $views = View::query()->whereIn('video_id',$videos)->count();
        $price = Setting::query()->first();
        $data['views'] = $views;
        $data['video_count'] = count($videos);

        $data['price'] = $views * $price->price ?? 1;
        return view('advertisers.detail', compact('advertiser','data'));
    }

    public function create(){
        return view('advertisers.create');
    }

    public function store(AdvertiserStoreRequest $request){

        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'type' => 'adv',
        ]);

        Advertiser::query()->create([
            'company_name' => $request->get('name'),
            'description' => $request->get('description'),
            'phone' => $request->get('phone'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('advertisers')->with('success', Utils::$MESSAGE_SUCCESS_ADDED);
    }

    public function edit( $advertiser_id){
        $adv = Advertiser::query()->with('user')->find($advertiser_id);
        if (!$adv){
            return redirect()->route('advertisers');
        }
        return view('advertisers.edit', compact('adv'));
    }

    public function update(Request $request, $advertiser_id){
        $adv = Advertiser::query()->find($advertiser_id);
        if (!$adv){
            return redirect()->route('advertisers');
        }

        $user = User::query()->find($adv->user_id);
        $userData = [
            'name' => $request->get('name'),
        ];
        if ($request->get('password')){
            $userData['password'] = Hash::make($request->get('password'));
        }

        $user->update($userData);

        $adv->update([
            'phone' => $request->get('phone'),
            'description' => $request->get('description'),
            'company_name' => $request->get('name'),
        ]);

        return redirect()->route('advertisers')->with('success', Utils::$MESSAGE_SUCCESS_UPDATED);
    }

    public function delete($advertiser_id){
        $adv = Advertiser::query()->find($advertiser_id);
        User::query()->find($adv->user_id)->delete();

        //TODO add delete videos
        $adv->delete();
        return redirect()->route('advertisers')->with('success', Utils::$MESSAGE_SUCCESS_DELETED);
    }

}
