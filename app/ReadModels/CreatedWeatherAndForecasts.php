<?php


namespace App\ReadModels;


class CreatedWeatherAndForecasts
{
    public int $created_weather_count;
    public int $created_forecasts_count;

    /**
     * CreatedWeatherAndForecasts constructor.
     * @param int $created_weather_count
     * @param int $created_forecasts_count
     */
    public function __construct(int $created_weather_count, int $created_forecasts_count)
    {
        $this->created_weather_count = $created_weather_count;
        $this->created_forecasts_count = $created_forecasts_count;
    }
}
