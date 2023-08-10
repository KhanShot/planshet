<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable = [
        'tablet_id', 'video_id',
    ];

    public function video(){
        return $this->belongsTo(AdVideo::class, 'video_id');
    }
}
