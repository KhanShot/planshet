<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index(){
        $tablets = [];
        return view('pages.tablets', compact('tablets'));
    }
}
