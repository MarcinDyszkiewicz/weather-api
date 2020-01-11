<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryNames = config('countries');

        foreach ($countryNames as $countryName) {
            Country::firstOrCreate(['name' => $countryName]);
        }
    }
}
