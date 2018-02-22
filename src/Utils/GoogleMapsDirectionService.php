<?php

namespace App\Utils;

use GuzzleHttp\Client;

class GoogleMapsDirectionService
{
    protected $API_KEY;

    public function __construct($API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function getDirection($lat1, $lng1, $lat2, $lng2)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/directions/json', [
            'query' => ['origin' => $lat1 . ',' . $lng1,
                'destination' => $lat2 . ',' . $lng2,
                'key' => $this->API_KEY]
        ]);
        $data = json_decode($response->getBody());
        return $data;
    }
}