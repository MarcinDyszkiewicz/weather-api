<?php

use App\Models\City;
use App\Models\Country;
use App\Services\TimezoneMapper;
use Carbon\CarbonTimeZone;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    // csv line data indexes
    const COUNTRY = 0;
    const CITY = 1;
    const LATITUDE = 2;
    const LONGITUDE = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFiles = [
            $citiesListCsv = file(app()->basePath() . '/cities-list.csv'),
//            $myCitiesListCsv = file(app()->basePath() . '/my-cities-list.csv'),
        ];

        foreach ($csvFiles as $csvFile) {
            $this->createCitiesFromCsv($csvFile);
        }
    }

    /**
     * @param array $csvFile
     */
    private function createCitiesFromCsv(array $csvFile): void
    {
        foreach ($csvFile as $line) {
            /** @var array $lineData
             * 0 => "Abkhazia"     country
             * 1 => "Sukhumi"      city
             * 2 => "43.001525"    latitude
             * 3 => "41.023415"    longitude
             */
            $lineData = str_getcsv($line);
            $timezoneString = TimezoneMapper::latLngToTimezoneString(
                $lineData[self::LATITUDE],
                $lineData[self::LONGITUDE]
            );
            $carbonTimeZone = CarbonTimeZone::create($timezoneString);
            $timezoneOffset = $carbonTimeZone->toOffsetName();

            /** @var Country $country */
            $country = Country::firstOrCreate(['name' => $lineData[self::COUNTRY]]);
            $country->cities()->firstOrCreate(
                [
                    'name' => $lineData[self::CITY],
                ],
                [
                    'latitude' => $lineData[self::LATITUDE],
                    'longitude' => $lineData[self::LONGITUDE],
                    'timezone' => $carbonTimeZone,
                    'timezone_offset' => (int) $timezoneOffset
                ]
            );
        }
    }
}
