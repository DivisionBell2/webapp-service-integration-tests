<?php
/**
 * @description Requester class, witch make requests for change size api
 */

namespace Helper\requesters\guzzle;

use Helper\queries\CartSizeQuery;

class CartSizeRequester extends BaseRequesterGuzzle
{
    public function makeCartSizeRequest(CartSizeQuery $queryObj)
    {
        $finalApiUrl = $this->urlFromConfig . $queryObj->getFinalUrl();

        $requestArr = [
            'product_variation_id' => $queryObj->getProductVariationIdToChange(),
            'quantity' => $queryObj->getQuantity()
        ];
        $requestJson = json_encode($requestArr);

        $response = $this->guzzleClient->put($finalApiUrl, [
            'body' => $requestJson
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);

        if (!isset($resultArr['product_variation_id']) && !isset($resultArr['quantity'])) {
            throw new \Exception("Add to cart with request {$requestArr} do not success");
        }

        return $resultArr;
    }
}
