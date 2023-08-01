<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route("login");
});

Auth::routes();
Route::middleware('auth')->group(function (){
   Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('advertisers', [\App\Http\Controllers\Admin\AdvertiserController::class, 'index'])->name('advertisers');
    Route::get('advertisers/create', [\App\Http\Controllers\Admin\AdvertiserController::class, 'create'])->name('advertisers.create');
    Route::post('advertisers/store', [\App\Http\Controllers\Admin\AdvertiserController::class, 'store'])->name('advertisers.store');
    Route::delete('advertisers/delete/{adv_id}', [\App\Http\Controllers\Admin\AdvertiserController::class, 'delete'])->name('advertisers.delete');


    //campaign
    Route::get('campaigns', [\App\Http\Controllers\Admin\CampaignController::class, 'index'])->name('campaigns');
    Route::get('campaigns/create', [\App\Http\Controllers\Admin\CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('campaigns/store', [\App\Http\Controllers\Admin\CampaignController::class, 'store'])->name('campaigns.store');
    Route::delete('campaigns/delete', [\App\Http\Controllers\Admin\CampaignController::class, 'delete'])->name('campaigns.delete');

    //placeholder video
    Route::get('video/create', [\App\Http\Controllers\Admin\AdVideoController::class, 'create'])->name('video.create');
    Route::post('video/store', [\App\Http\Controllers\Admin\AdVideoController::class, 'store'])->name('video.store');

    //tablets
    Route::get('tablets',[\App\Http\Controllers\Admin\TabletController::class, 'index'])->name('tablets');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
