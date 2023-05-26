<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class ApiRestCountries extends Facade {
    protected static function getFacadeAccessor() {
        return 'rest-countries';
    }
}