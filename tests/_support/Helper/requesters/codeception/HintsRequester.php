<?php
/**
 * @description Requester class, witch make requests for hints api
 */

namespace Helper\requesters\codeception;

use Helper\Arrays;
use Helper\queries\HintsQuery;

class HintsRequester extends BaseRequesterCodeception
{
    public function makeHintsRequest(HintsQuery $queryObj)
    {
        $queryParams = [];
        $queryParams['city'] = $queryObj->getCity();

        $this->apiTester->sendGET($queryObj->getApiUrl(), $queryParams);
    }

    public function getIdHashForCity(HintsQuery $queryObj): string
    {
        $this->makeHintsRequest($queryObj);
        $this->apiTester->seeResponseCodeIs(200);
        $this->apiTester->seeResponseIsJson();

        $hints = $this->apiTester->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($hints, 'Hints must be in response');

        return $hints[0]['_id'];
    }
}