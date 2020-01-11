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

    public function listWeathers(City $city)
    {
        $weathers = $city->weathers()->latest()->limit(14)->get();

        return response()->json($weathers);
    }

    public function listForecasts(City $city)
    {
        $forecasts = $city->forecasts()->latest()->limit(7)->get();

        return response()->json($forecasts);
    }
}
