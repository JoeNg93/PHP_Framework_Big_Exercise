<?php

namespace App\Entity;

class Location
{
    protected $address;
    protected $latitude;
    protected $longitude;
    protected $markerColor;
    protected $markerType;

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getMarkerColor()
    {
        return $this->markerColor;
    }

    /**
     * @param mixed $markerColor
     */
    public function setMarkerColor($markerColor): void
    {
        $this->markerColor = $markerColor;
    }

    /**
     * @return mixed
     */
    public function getMarkerType()
    {
        return $this->markerType;
    }

    /**
     * @param mixed $markerType
     */
    public function setMarkerType($markerType): void
    {
        $this->markerType = $markerType;
    }
}
