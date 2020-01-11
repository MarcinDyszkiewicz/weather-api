<?php

namespace App\Services;

use App\Models\City;
use App\ReadModels\CreatedWeatherAndForecasts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WeatherService
{
    /**
     * @var WeatherApiInterface
     */
    private WeatherApiInterface $weatherApi;

    /**
     * WeatherService constructor.
     * @param WeatherApiInterface $weatherApi
     */
    public function __construct(WeatherApiInterface $weatherApi)
    {
        $this->weatherApi = $weatherApi;
    }

    /**
     * @param City $city
     * @return CreatedWeatherAndForecasts
     */
    public function create(City $city): CreatedWeatherAndForecasts
    {
        /**
         * currently => [
         * "time" => 1578602011
         * "summary" => "Possible Light Rain"
         * "icon" => "rain"
         * "precipIntensity" => 0.5622
         * "precipProbability" => 0.57
         * "precipType" => "rain"
         * "temperature" => 5.5
         * "apparentTemperature" => 2.31
         * "dewPoint" => 4.29
         * "humidity" => 0.92
         * "pressure" => 1016.5
         * "windSpeed" => 15.47
         * "windGust" => 35.3
         * "windBearing" => 194
         * "cloudCover" => 0.98
         * "uvIndex" => 0
         * "visibility" => 11.418
         * "ozone" => 291.8
         * ]
         */
        $weatherApiResponse = $this->weatherApi->call($city->latitude, $city->longitude);

        $createdWeatherCount = $this->createWeather($city, $weatherApiResponse['currently']);
        $createdForecastCount = $this->createForecasts($city, $weatherApiResponse['daily']['data']);

        return new CreatedWeatherAndForecasts($createdWeatherCount, $createdForecastCount);
    }

    /**
     * @param City $city
     * @param array $weatherApiResponse
     * @return int
     */
    private function createWeather(City $city, array $weatherApiResponse): int
    {
        $createdWeatherCount = 0;
        $currentWeatherData = $this->convertKeysToSnakeCase($weatherApiResponse);
        Arr::forget($currentWeatherData, ['time', 'summary', 'icon']);
        $localTime = Carbon::now($city->timezone)->startOfHour();
        $weather = $city->weathers()->updateOrCreate(
            ['local_datetime' => $localTime],
            $currentWeatherData
        );
        if ($weather->wasRecentlyCreated) {
            $createdWeatherCount++;
        }

        return $createdWeatherCount;
    }

    /**
     * @param City $city
     * @param array $weatherApiResponse
     * @return int
     */
    private function createForecasts(City $city, array $weatherApiResponse): int
    {
        $createdForecastCount = 0;
        $forecastsData = $this->getForecastsData($weatherApiResponse);
        foreach ($forecastsData as $forecastData) {
            $forecast = $this->createForecast($city, $forecastData);
            if ($forecast->wasRecentlyCreated) {
                $createdForecastCount++;
            }
        }
        return $createdForecastCount;
    }

    /**
     * @param array $daysData
     * @return array
     */
    private function getForecastsData(array $daysData): array
    {
        $forecasts = [];
        foreach ($daysData as $day) {
            $time = Carbon::createFromTimestamp($day['time']);
            if ($time->startOfDay() > Carbon::now()->startOfDay()) {
                array_push($forecasts, $day);
            }
        }

        return $forecasts;
    }

    /**
     * @param City $city
     * @param array $forecastData
     * @return Model
     */
    private function createForecast(City $city, array $forecastData): Model
    {
        $forecastData = $this->convertKeysToSnakeCase($forecastData);
        if (!empty($forecastData['sunrise_time'])) {
            $forecastData['sunrise_time'] = Carbon::createFromTimestamp($forecastData['sunrise_time'], $city->timezone);
        }
        if (!empty($forecastData['sunset_time'])) {
            $forecastData['sunset_time'] = Carbon::createFromTimestamp($forecastData['sunset_time'], $city->timezone);
        }
        $forecastDate = Carbon::createFromTimestamp($forecastData['time'])->toDate();
        $forecast = $city->forecasts()->updateOrCreate(
            ['date' => $forecastDate],
            $forecastData
        );

        return $forecast;
    }

    /**
     * @param array $weatherData
     * @return array
     */
    private function convertKeysToSnakeCase(array $weatherData): array
    {
        $newArray = [];
        foreach ($weatherData as $key => $value) {
            $newKey = Str::snake($key);
            $newArray[$newKey] = $value;
        }

        return $newArray;
    }
}
