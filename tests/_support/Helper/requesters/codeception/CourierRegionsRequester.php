<?php
/**
 * @description Requester class, witch make requests for courier regions delivery api
 */

namespace Helper\requesters\codeception;

use Helper\queries\CourierRegionsQuery;

class CourierRegionsRequester extends BaseRequesterCodeception
{
    public function makeCourierRegionsRequest(CourierRegionsQuery $queryObj)
    {
        $finalApiUrl = $queryObj->getRequestUrl();

        $this->apiTester->sendGET($finalApiUrl);
    }
}