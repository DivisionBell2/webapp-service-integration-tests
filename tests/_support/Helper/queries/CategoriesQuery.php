<?php
/**
 * @description Object of class with description of categories request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class CategoriesQuery
{
    private $apiUrl;
    private $categoryId;

    public function __construct()
    {
        $this->setApiUrl(ApiUrls::MOBILE_CATEGORIES);
    }

    public function setApiUrl(string $apiUrl): CategoriesQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setCategoryId(string $categoryID): CategoriesQuery
    {
        $this->categoryId = $categoryID;
        return $this;
    }

    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }
}
