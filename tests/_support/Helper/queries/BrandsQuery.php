<?php
/**
 * @description Object of class with description of Brands request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class BrandsQuery
{
    private $apiUrl;

    public function __construct()
    {
        $this->setApiUrl(ApiUrls::MOBILE_BRANDS);
    }

    public function setApiUrl(string $apiUrl): BrandsQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }
}
