<?php
/**
 * @description Make get cart request
 */

namespace Helper\requesters\guzzle;

use Helper\ApiUrls;

class CartRequester extends BaseRequesterGuzzle
{
    public function makeCartRequest(): array
    {
        $cartUrl = $this->urlFromConfig . ApiUrls::CART;
        $response = $this->guzzleClient->get($cartUrl);
        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);

        if (!isset($resultArr['items']) && count($resultArr['items']) === 0) {
            throw new \Exception("Cart request with URL {$cartUrl} do not success");
        }

        return $resultArr;
    }
}
