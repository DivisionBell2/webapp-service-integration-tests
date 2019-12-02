<?php
/**
 * @description Object of class with description of catalog request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class CatalogQuery
{
    private $apiVersion;
    private $query;
    private $type;
    private $category;

    public function __construct()
    {
        $this->setApiVersion(ApiUrls::CATALOG_V4);
        $this->setType('catalog');
        $this->setCategory('zhenshchinam');
    }

    public function setApiVersion(string $apiVersion): CatalogQuery
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    public function setQuery(string $query): CatalogQuery
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setType(string $type): CatalogQuery
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setCategory(string $category): CatalogQuery
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }
}