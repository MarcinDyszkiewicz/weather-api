<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Weather
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $city_id
 * @property string $local_datetime
 * @property string|null $precip_type
 * @property float $precip_probability
 * @property float $precip_intensity
 * @property float $temperature
 * @property float $apparent_temperature
 * @property float $humidity
 * @property float $pressure
 * @property float $wind_speed
 * @property float $wind_gust
 * @property float $cloud_cover
 * @property float $uv_index
 * @property float $visibility
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereApparentTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereCloudCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereLocalDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather wherePrecipIntensity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather wherePrecipProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather wherePrecipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereUvIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereVisibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereWindGust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Weather whereWindSpeed($value)
 * @mixin \Eloquent
 */
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
