<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiserStoreRequest;
use App\Http\Traits\Utils;
use App\Models\Advertiser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdvertiserController extends Controller
{
    public function index(){
        $advertisers = Advertiser::query()->with('user')->get();
        return view('advertisers.index', compact('advertisers'));
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
            'phone' => $request->get('description'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('advertisers')->with('success', Utils::$MESSAGE_SUCCESS_ADDED);
    }

    public function delete($advertiser_id){
        $adv = Advertiser::query()->find($advertiser_id);
        User::query()->find($adv->user_id)->delete();
        $adv->delete();
        return redirect()->route('advertisers')->with('success', Utils::$MESSAGE_SUCCESS_DELETED);
    }

}
