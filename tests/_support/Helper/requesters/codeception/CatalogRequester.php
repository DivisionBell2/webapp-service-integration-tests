<?php
/**
 * @description Requester class, witch make requests for catalog api
 */

namespace Helper\requesters\codeception;

use _support\Helper\queries\IdeasQuery;
use Helper\Arrays;
use Helper\queries\CatalogQuery;

class CatalogRequester extends BaseRequesterCodeception
{
    public function makeCatalogRequest(CatalogQuery $queryObj)
    {
        $queryParams = [];
        $queryParams['type'] = $queryObj->getType();
        $queryParams['category'] = $queryObj->getCategory();

        if ($queryObj->getQuery()) {
            $queryParams['query'] = $queryObj->getQuery();
        }

        $this->apiTester->sendGET($queryObj->getApiVersion(), $queryParams);
    }

    public function getProductVariationId(CatalogQuery $queryObj): int
    {
        $this->makeCatalogRequest($queryObj);
        $this->apiTester->seeResponseCodeIs(200);
        $this->apiTester->seeResponseIsJson();

        $products = $this->apiTester->grabDataFromResponseByJsonPath('$.products')[0];
        Arrays::checkForEmptyArray($products, 'Products must be in response');

        foreach ($products as $keyProduct => $product) {
            $productVariations = $this->apiTester->grabDataFromResponseByJsonPath("$.products[$keyProduct].product_variations")[0];
            if (count($productVariations) > 0) {
                $productVariationId = $productVariations[0]['id'];
                return $productVariationId;
            }
        }
        throw new \Exception('product_variations => id do not find in products');
    }

    public function getProductVariationIds(CatalogQuery $queryObj): array
    {
        $this->makeCatalogRequest($queryObj);
        $this->apiTester->seeResponseCodeIs(200);
        $this->apiTester->seeResponseIsJson();

        $productVariationIds = [];

        $products = $this->apiTester->grabDataFromResponseByJsonPath('$.products')[0];
        Arrays::checkForEmptyArray($products, 'Products must be in response');

        foreach ($products as $keyProduct => $product) {
            $productVariations = $this->apiTester->grabDataFromResponseByJsonPath("$.products[$keyProduct].product_variations")[0];
            if (count($productVariations) > 1) {
                for ($i = 0; $i < count($productVariations); $i++) {
                    $productVariationIds[$i] = $productVariations[$i]['id'];
                }
                Arrays::checkForEmptyArray($productVariationIds, 'There are no product variations for product in array');
                return $productVariationIds;
            }
        }
        throw new \Exception('product_variations => id do not find in products');
    }
}