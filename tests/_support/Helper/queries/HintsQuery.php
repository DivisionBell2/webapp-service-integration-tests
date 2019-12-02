<?php
/**
 * @description Object of class with description of hints request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class HintsQuery
{
    private $apiUrl;
    private $city;

    public function __construct()
    {
        $this->setApiUrl(ApiUrls::HINTS);
        $this->setCity('москва');
    }

    public function setApiUrl(string $apiUrl): HintsQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setCity(string $city): HintsQuery
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
}