<?php

namespace App\Utils;

use App\Entity\Location;

class GoogleMapsGeocode
{
    protected $API_KEY;

    public function __construct($API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function getLatLng($address)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => ['address' => $address, 'key' => 'AIzaSyAmyYNlxuCGvftIhFlKACAqwRbBPDqtySI']
        ]);
        $data = json_decode($response->getBody());
        $location = new Location();
        $location->setAddress($data->results[0]->formatted_address);
        $location->setLatitude($data->results[0]->geometry->location->lat);
        $location->setLongitude($data->results[0]->geometry->location->lng);
        return $location;
    }
}