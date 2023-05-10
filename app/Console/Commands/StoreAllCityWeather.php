<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\CityWeather;

class StoreAllCityWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:all-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All cities weather condition saved';

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

          $cities = DB::select('select name from cities');
          foreach($cities as $city) {
                $client = new Client(['http_errors' => false]);
                $apiKey = env("OPEN_WEATHER_API_KEY", '4c7f1f68689243332f5672f3f5d973e0');
                $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city->name . '&appid=' . $apiKey;
                $response = $client->get($url);
                sleep(1);
                if($response->getStatusCode()===200) {
                    $data = json_decode($response->getBody(), true);
                    $coord = $data['coord']['lon'].','.$data['coord']['lat'];
                    CityWeather::store(
                    [
                    'city'=>$city->name,
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


        return 'success';
    }
}
