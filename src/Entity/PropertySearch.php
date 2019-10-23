<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class PropertySearch {

    private $maxPrice;

    /**
     * @Assert\Range(min=10, max=400)
     */
    private $minSurface;

    private $options;

    private $lat;

    private $lng;

    private $address;

    private $distance;

    public function __construct() {
        
        $this->options = new ArrayCollection();
    }

    /**
     * Getter for MaxPrice
     *
     * @return [type]
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * Setter for MaxPrice
     * @var [type] maxPrice
     *
     * @return self
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }


    /**
     * Getter for MinSurface
     *
     * @return [type]
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * Setter for MinSurface
     * @var [type] minSurface
     *
     * @return self
     */
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }


    /**
     * Getter for Options
     *
     * @return [type]
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * Setter for Options
     * @var [type] options
     *
     * @return self
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
        
    }

     /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * @return PropertySearch
     */
    public function setLat(?float $lat): PropertySearch
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     * @return PropertySearch
     */
    public function setLng(?float $lng): PropertySearch
    {
        $this->lng = $lng;
        return $this;
    }

        /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     * @return PropertySearch
     */
    public function setDistance(?int $distance): PropertySearch
    {
        $this->distance = $distance;
        return $this;
    }

        /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param null|string $address
     * @return PropertySearch
     */
    public function setAddress(?string $address): PropertySearch
    {
        $this->address = $address;
        return $this;
    }


}