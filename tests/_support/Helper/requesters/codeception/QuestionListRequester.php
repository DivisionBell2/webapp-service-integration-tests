<?php
/**
 * @description Requester class, making requests for questions list api
 */

namespace Helper\requesters\codeception;

use Helper\queries\QuestionListQuery;

class QuestionListRequester extends BaseRequesterCodeception
{
    public function makeQuestionListRequest(QuestionListQuery $queryObj)
    {
        $finalApiUrl = $queryObj->getApiUrl();
        $this->apiTester->sendGET($finalApiUrl);
    }
}