<?php
/**
 * @description Requester class, witch make requests for reset password api
 */

namespace _support\Helper\requesters\guzzle;

use _support\Helper\queries\ResetPasswordQuery;
use Helper\requesters\guzzle\BaseRequesterGuzzle;

class ResetPasswordRequester extends BaseRequesterGuzzle
{
    public function makeResetPasswordRequester(ResetPasswordQuery $queryObj): array
    {
        $requestArr = ['email' => $queryObj->getEmail()];
        $requestJson = json_encode($requestArr);
        $resetPasswordUrl = $this->urlFromConfig . $queryObj->getApiUrl();

        $response = $this->guzzleClient->post($resetPasswordUrl, [
            'body' => $requestJson
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);

        if (!isset($resultArr)) {
            throw new \Exception("Reset password request with URL {$resetPasswordUrl} do not success");
        }

        return $resultArr;
    }
}