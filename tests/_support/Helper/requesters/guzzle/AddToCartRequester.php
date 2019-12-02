<?php
/**
 * @description Make add to cart request
 */

namespace Helper\requesters\guzzle;

use Helper\ApiUrls;

class AddToCartRequester extends BaseRequesterGuzzle
{
    public function makeAddToCartRequest(int $productVariationId): array
    {
        $requestArr = ['product_variation_id' => $productVariationId];
        $requestJson = json_encode($requestArr);

        $cartItemsUrl = $this->urlFromConfig . ApiUrls::CART_ITEMS;

        $response = $this->guzzleClient->post($cartItemsUrl, [
            'body' => $requestJson
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);

        if (!isset($resultArr['items']) && count($resultArr['items']) === 0) {
            throw new \Exception("Add to cart request with URL {$cartItemsUrl} do not success");
        }
        return $resultArr;
    }
}
