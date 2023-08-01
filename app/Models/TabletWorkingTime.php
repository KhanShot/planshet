<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabletWorkingTime extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'tablet_id', 'start_date', 'end_date',
    ];
}
