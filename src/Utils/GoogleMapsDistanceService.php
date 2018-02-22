<?php

namespace App\Utils;

use GuzzleHttp\Client;

class GoogleMapsDistanceService
{
    public function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => ['origins' => $lat1. ',' . $lng1,
                'destinations' => $lat2. ',' . $lng2]
        ]);
        $data = json_decode($response->getBody());
        return $data->rows[0]->elements[0]->distance->value;
    }
}
