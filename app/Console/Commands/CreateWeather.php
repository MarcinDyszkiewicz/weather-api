<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CreateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:create {--city= : city name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param WeatherService $weatherService
     * @return mixed
     */
    public function handle(WeatherService $weatherService)
    {
        try {
            $created_weather_count = 0;
            $created_forecasts_count = 0;

            if ($cityName = $this->option('city')) {
                $city = City::whereName($cityName)->firstOrFail();
                $created = $weatherService->create($city);
                $created_weather_count = $created->created_weather_count;
                $created_forecasts_count = $created->created_forecasts_count;
            } else {
                $cities = $this->getCities();

                foreach ($cities as $city) {
                    $created = $weatherService->create($city);
                    $created_weather_count += $created->created_weather_count;
                    $created_forecasts_count += $created->created_forecasts_count;
                }
            }

            $returnInfo = sprintf(
                '%s weather and %s forecasts created',
                $created_weather_count,
                $created_forecasts_count
            );

            $this->info($returnInfo);
            Log::channel('weatherapi')->info($returnInfo);
        } catch (\Exception $e) {
            $this->error($e);
            Log::channel('error-weatherapi')->error(
                'Exception',
                [
                    'e' => $e
                ]
            );
        }
    }

    /**
     * @return Collection
     */
    private function getCities(): Collection
    {
        $myOffset = Carbon::now()->offsetHours;
        $now = Carbon::now()->startOfHour()->hour;
        $utc0Hour = $now - $myOffset;
        $middayOffset = 12 - $utc0Hour;
        $sevenPmOffset = 19 - $utc0Hour;

        $cities = City::where('timezone_offset', $middayOffset)
            ->orWhere('timezone_offset', $sevenPmOffset)
            ->get();

        return $cities;
    }
}
