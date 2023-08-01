<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;
    protected $fillable = [
        'mac_address', 'ip_address',
        'last_online', 'status',
    ];
}
