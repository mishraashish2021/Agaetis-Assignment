<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WeatherController extends Controller
{
    public function index()
    {
        return view('forecast');
    }

    public function getWeather(Request $request)
    {
        // Validate the request
        $location = $request->input('location');
        $request->validate([
            'location' => 'required|string',
        ]);

        // Fetch weather data from an API based on the  location
        $apiKey = 'c05d4bbe3e8895495a8c42a093bbef18';
        $apiUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$location&appid=$apiKey&units=metric&cnt=7";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $weatherData = $response->json();
            return response()->json($weatherData);
        } else {
            return response()->json(['error' => 'Failed to fetch weather data'], $response->status());
        }
    }
}
