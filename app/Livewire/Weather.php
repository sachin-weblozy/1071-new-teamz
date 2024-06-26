<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class Weather extends Component
{
    public $data;
    public $day;
    public $locationType;

    public function mount()
    {
        $this->day = Carbon::now()->format('l');

        $url = $this->buildWeatherApiUrl();

        try {
            $client = new Client();
            $response = $client->get($url);
            $this->data = json_decode($response->getBody(), true);

            // Store weather data in session
            Session::put('weather_data', $this->data);
            Session::put('weather_data_expires_at', now()->addMinutes(30));
        } catch (\Exception $e) {
            // Handle the exception
            $this->data = null;
            // Log or report the error
            \Log::error('Failed to fetch weather data: ' . $e->getMessage());
        }
    }

    private function buildWeatherApiUrl()
    {
        $lat = null;
        $lon = null;

        // Fetch user's location using browser geolocation
        if (Request::hasHeader('latitude') && Request::hasHeader('longitude')) {
            $lat = Request::header('latitude');
            $lon = Request::header('longitude');
            $this->locationType = 'Location'; // Fetched via geolocation
        } else {
            // Fallback to IP address city name if geolocation not available
            $clientIP = request()->ip();
            if ($clientIP == "127.0.0.1") {
                $city = 'Guwahati';
            } else {
                $details = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}/json"));
                $city = $details->city;
            }
            $this->locationType = 'IP Address'; // Fetched via IP address
            return "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=5cdf8b35c413cdd46f31f7124efe3b00";
        }

        return "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=5cdf8b35c413cdd46f31f7124efe3b00";
    }

    public function degreesToCardinal($degrees)
    {
        $directions = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'];
        $index = ($degrees + 11.25) / 22.5;
        return $directions[$index % 16];
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
