<?php
namespace App\Services\Geolocation;

use Illuminate\Support\Facades\Facade;

class GeolocationFacade extends Facade
{

    /**
     * @method static array search(string $string)
     * @see Geolocation
     */
    protected static function getFacadeAccessor()
    {
        return Geolocation::class;
    }
}