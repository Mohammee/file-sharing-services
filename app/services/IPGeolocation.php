<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class IPGeolocation
{
    protected $baseUrl = 'https://api.ipgeolocation.io';

    private function getInfo($ip)
    {

        $response = Http::baseUrl($this->baseUrl)->get('ipgeo', [
            'apiKey' => config('services.geolocation.key'),
            'lang' => config('services.geolocation.lang'),
            'ip' => $ip,
        ]);

        return json_decode($response->body());
    }


    public static function __callStatic(string $name, array $arguments)
    {

       return (new self)->getInfo(...$arguments);
    }


}
