<?php
/**
 * @description Requester class, witch make requests for categories api
 */

namespace Helper\requesters\codeception;

use Helper\queries\CategoriesQuery;

class CategoriesRequester extends BaseRequesterCodeception
{
    public function makeCategoriesRequest(CategoriesQuery $queryObj)
    {
        $finalApiUrl = $queryObj->getApiUrl();

        if ($queryObj->getCategoryId()) {
            $finalApiUrl = $finalApiUrl . $queryObj->getCategoryId();
        }

        $this->apiTester->haveHttpHeader('uuid', '83d21a1c-f6ae-4ddd-a892-6f60ac6bab55');
        $this->apiTester->sendGET($finalApiUrl);
    }
}
