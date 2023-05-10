<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\CityWeather;

class StoreCityWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:city {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'store the city weather information in db';

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
     * @return int
     */
    public function handle()
    {
            $city = $this->argument('city')??'Dubai';
            $client = new Client(['http_errors' => false]);
            $apiKey = env("OPEN_WEATHER_API_KEY", '4c7f1f68689243332f5672f3f5d973e0');
            $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $apiKey;

            $response = $client->get($url);
            if($response->getStatusCode()===200) {
                $data = json_decode($response->getBody(), true);
                $coord = $data['coord']['lon'].','.$data['coord']['lat'];
                CityWeather::store(
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
        }
    }
}
