<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id', 'campaign_id', 'duration',
        'order', 'url', 'name', 'is_placeholder', 'status',
    ];

    public function advertiser(){
        return $this->belongsTo(Advertiser::class, 'advertiser_id');
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

}
