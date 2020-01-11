<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Forecast
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $city_id
 * @property string $date
 * @property string|null $precip_type
 * @property float $precip_probability
 * @property float $precip_intensity
 * @property float $temperature_min
 * @property float $temperature_max
 * @property float $apparent_temperature_min
 * @property float $apparent_temperature_max
 * @property float $humidity
 * @property float $pressure
 * @property float $wind_speed
 * @property float $wind_gust
 * @property float $cloud_cover
 * @property float $uv_index
 * @property float $visibility
 * @property string|null $sunrise_time
 * @property string|null $sunset_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereApparentTemperatureMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereApparentTemperatureMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereCloudCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast wherePrecipIntensity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast wherePrecipProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast wherePrecipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereSunriseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereSunsetTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereTemperatureMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereTemperatureMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereUvIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereVisibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereWindGust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Forecast whereWindSpeed($value)
 * @mixin \Eloquent
 */
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
