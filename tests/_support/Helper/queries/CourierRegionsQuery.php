<?php
/**
 * @description Object of class with description of categories request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class CourierRegionsQuery
{
    private $cityHash;

    public function __construct(string $cityHash)
    {
        $this->setCityHash($cityHash);
    }

    public function getRequestUrl(): string
    {
        return ApiUrls::COURIER_REGIONS . $this->getCityHash() . '/' . ApiUrls::DELIVERY;
    }

    public function setCityHash(string $cityHash): CourierRegionsQuery
    {
        $this->cityHash = $cityHash;
        return $this;
    }

    public function getCityHash(): string
    {
        return $this->cityHash;
    }
}