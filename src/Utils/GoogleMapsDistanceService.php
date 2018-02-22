<?php

namespace App\Utils;

use GuzzleHttp\Client;

class GoogleMapsDistanceService
{
    protected $API_KEY;

    public function __construct($API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => ['origins' => $lat1 . ',' . $lng1,
                'destinations' => $lat2 . ',' . $lng2,
                'key' => $this->API_KEY]
        ]);
        $data = json_decode($response->getBody());
        return $data->rows[0]->elements[0]->distance->value;
    }
}
