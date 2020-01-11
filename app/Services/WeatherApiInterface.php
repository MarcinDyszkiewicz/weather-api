<?php

namespace App\Services;

interface WeatherApiInterface
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     */
    public function call(float $latitude, float $longitude): ?array;
}
