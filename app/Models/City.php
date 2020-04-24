<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $country_id
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 * @property string $timezone
 * @property int $timezone_offset
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Forecast[] $forecasts
 * @property-read int|null $forecasts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Weather[] $weathers
 * @property-read int|null $weathers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereTimezoneOffset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City findOrFail($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    const ONE_WEEK = 7;
    const TWO_WEEKS = 14;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function weathers()
    {
        return $this->hasMany(Weather::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forecasts()
    {
        return $this->hasMany(Forecast::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function twoWeeksWeathers()
    {
        return $this->weathers()->latest()->limit(self::TWO_WEEKS)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function weekForecasts()
    {
        return $this->forecasts()->latest()->limit(self::ONE_WEEK)->get();
    }

    /**
     * @param int $days
     * @return Collection
     */
    public function getWeatherForDays(int $days): Collection
    {
        return $this->weathers()->latest()->limit($days)->get();
    }

    /**
     * @param int $days
     * @return Collection
     */
    public function getHistoryForecasts(int $days): Collection
    {
        return $this->forecasts()->where('date', '<', Carbon::today())->latest()->limit($days)->get();
    }
}
