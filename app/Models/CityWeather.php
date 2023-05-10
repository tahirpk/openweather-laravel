<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityWeather extends Model
{
    use HasFactory;

    protected $table = 'city_weathers';
    protected $guarded = [];

    /**
     * @param $data
     * @return bool
    */
    public function store($data)
    {

           return CityWeather::query()->create($data);

    }
}
