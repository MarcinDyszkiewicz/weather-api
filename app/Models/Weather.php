<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'city_id',
        'local_datetime',
        'precip_type',
        'precip_probability',
        'precip_intensity',
        'temperature',
        'apparent_temperature',
        'humidity',
        'pressure',
        'wind_speed',
        'wind_gust',
        'cloud_cover',
        'uv_index',
        'visibility',
    ];
}
