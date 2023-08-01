<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'budget', 'advertiser_id', 'start_date',
        'end_date', 'status'
    ];

    public function advertiser(){
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }

    public function video(){
        return $this->hasOne(AdVideo::class, 'campaign_id');
    }

}
