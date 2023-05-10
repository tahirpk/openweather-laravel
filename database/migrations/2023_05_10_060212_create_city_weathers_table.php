<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_weathers', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('coordinates')->nullable();
            $table->string('condition')->nullable();
            $table->string('temperature');
            $table->string('Feels')->nullable();
            $table->string('humidity');
            $table->string('wind_speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_weathers');
    }
}
