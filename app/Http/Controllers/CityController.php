<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(City::all());
    }

    public function show(Request $request)
    {
        $city = City::whereName($request->input('city_name'))
            ->with('weathers', 'forecasts')
            ->first();

        return response()->json($city);
    }

    public function listWeathers(int $cityId)
    {
        $city = City::findOrFail($cityId);

        $weathers = $city->twoWeeksWeathers();

        return response()->json($weathers);
    }

    public function listForecasts(int $cityId)
    {
        $city = City::findOrFail($cityId);

        $forecasts = $city->weekForecasts();

        return response()->json($forecasts);
    }
}
