<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tablet;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index(){
        $tablets = Tablet::query()->get();
        return view('pages.tablets', compact('tablets'));
    }
}
