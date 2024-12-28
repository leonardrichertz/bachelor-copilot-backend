<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::withOptions(['verify' => false])->get("https://api.openweathermap.org/data/3.0/onecall", [
            'lat' => $lat,
            'lon' => $lon,
            'exclude' => 'minutely,hourly,daily,alerts',
            'appid' => $apiKey,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['message' => 'Failed to fetch weather data'], 500);
        }
    }
}