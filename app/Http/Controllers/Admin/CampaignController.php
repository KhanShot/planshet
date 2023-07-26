<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(){
        $campaigns = [];
        return view('campaigns.index', compact('campaigns'));
    }

    public function create(){
        return view('campaigns.create');
    }

    public function store(){

    }

    public function delete($campaign_id){

    }

}
