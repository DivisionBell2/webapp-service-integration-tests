<?php
/**
 * @description Requester class, witch make requests for brands api
 */

namespace Helper\requesters\codeception;

use Helper\queries\BrandsQuery;

class BrandsRequester extends BaseRequesterCodeception
{
    public function makeCategoriesRequest(BrandsQuery $queryObj)
    {
        $finalApiUrl = $queryObj->getApiUrl();

        $this->apiTester->haveHttpHeader('uuid', '83d21a1c-f6ae-4ddd-a892-6f60ac6bab55');
        $this->apiTester->sendGET($finalApiUrl);
    }
}
