<?php
/**
 * @description Requester class, making requests for questions api
 */

namespace Helper\requesters\guzzle;

use Helper\queries\QuestionsQuery;

class QuestionsRequester extends BaseRequesterGuzzle
{
    public function makeQuestionsRequest(QuestionsQuery $queryObj): array
    {
        $request = [
            'city' => $queryObj->getCity(),
            'type' => $queryObj->getType(),
            'question_comment' => $queryObj->getQuestionComment(),
            'email' => $queryObj->getEmail(),
            'name' => $queryObj->getName(),
            'question_text' => $queryObj->getQuestionText()
        ];

        $requestJson = json_encode($request);

        $questionUrl = $this->urlFromConfig . $queryObj->getApiUrl();

        $response = $this->guzzleClient->post($questionUrl, [
            'body' => $requestJson
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);
        if (!isset($resultArr)) {
            throw new \Exception("Question request with URL {$questionUrl} do not success");
        }
        return $resultArr;
    }
}