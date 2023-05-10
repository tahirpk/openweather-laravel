<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## OpenWeather API With Laravel

App will fetch the below data from the provided weather API and insert it into the database:

1. City
2. Coordinates
3. Weather condition (Clear, Cloudy, Rainy, etc...)
4. Temperature in Celsius
5. Feels like in Celsius
6. Humidity
7. Wind speed in km/hour

## For local Installation

-   git clone https://github.com/tahirpk/openweather-laravel.git
-   cd openweather-laravel/
-   composer install
-   rename .env.example to .env set the database name in it
-   php artisan migrate
-   php artisan serv
    -------------------------------------------------------------------------------------------- for every ten mints insertion run this command: php artisan schedule:work

## Contributing

Thank you for considering contributing to weather app

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
