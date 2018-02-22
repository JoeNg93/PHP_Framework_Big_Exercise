<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $address;

    /**
     * @ORM\Column(type="float")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float")
     */
    protected $longitude;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $markerColor;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $markerType;

    /**
     * @ORM\Column(type="string")
     */
    protected $info;

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

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info): void
    {
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
