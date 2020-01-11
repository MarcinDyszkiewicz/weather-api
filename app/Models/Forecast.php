<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'city_id',
        'date',
        'precip_type',
        'precip_probability',
        'precip_intensity',
        'temperature_min',
        'temperature_max',
        'apparent_temperature_min',
        'apparent_temperature_max',
        'humidity',
        'pressure',
        'wind_speed',
        'wind_gust',
        'cloud_cover',
        'uv_index',
        'visibility',
        'sunrise_time',
        'sunset_time',
    ];
}
