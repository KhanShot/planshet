<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Traits\Utils;
use App\Models\Advertiser;
use App\Models\AdVideo;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;

class CampaignController extends Controller
{
    public function index(){
//        $campaigns = Campaign::query()->with(['advertiser', 'video'])->get();

        $ad_videos = AdVideo::query()->with(['advertiser', 'campaign'])->orderBy('order', "ASC")->get();
        return view('campaigns.index', compact('ad_videos'));
    }

    public function create(){
        $advertisers = Advertiser::query()->get();
        return view('campaigns.create', compact('advertisers'));
    }

    public function store(CampaignStoreRequest $request){
        $video = new GetId3(request()->file('video'));

        $campaign = Campaign::query()->create([
            'budget' => $request->get('budget'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'advertiser_id' => $request->get('advertiser'),
        ]);

        if ($request->hasFile("video")){

            $path = "/assets/videos";
            $request->file("video")->store('public'. $path);
            $name = $request->file("video")->hashName() ;
            $data['video'] = $path."/".$name;
        }

        AdVideo::query()->create([
            'advertiser_id' => $request->get('advertiser'),
            'campaign_id' => $campaign->id,
            'duration' => $video->getPlaytimeSeconds(),
            'is_placeholder' => 0,
            'status' => 'active',
            'name' => $name ?? '',
            'url' => $data['video'] ?? '',
        ]);

        return redirect()->route('campaigns')->with('success', Utils::$MESSAGE_SUCCESS_ADDED);
    }

    public function delete($campaign_id){

    }

}
