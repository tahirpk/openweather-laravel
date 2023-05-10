<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\CityWeather;

class OpenWeatherController extends Controller
{

   /**
     * @var CityWeather
     */
    protected $CityWeather;


    /**
     *
     * @param CityWeather $CityWeather
     *
     */
    public function __construct(CityWeather $cityWeather)
    {

        $this->cityWeather = $cityWeather;
    }


    public function getWeather($city)
    {
        $client = new Client(['http_errors' => false]);
        $apiKey = env("OPEN_WEATHER_API_KEY", '4c7f1f68689243332f5672f3f5d973e0');
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $apiKey;

        $response = $client->get($url);
        if($response->getStatusCode()===200) {
            $data = json_decode($response->getBody(), true);
            $coord = $data['coord']['lon'].','.$data['coord']['lat'];
            $this->cityWeather->store(
            [
            'city'=>$city,
            'coordinates'=> $coord,
            'condition' => $data['weather'][0]['main'],
            'Feels' =>$data['weather'][0]['description'],
            'temperature'=>$data['main']['temp'],
            'humidity'=>$data['main']['humidity'],
            'wind_speed'=>$data['wind']['speed'],
            ]
            );
            return view('weather', ['data' => $data]);
        }
        dd($response->getStatusCode());

    }
}
