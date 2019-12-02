<?php
/**
 * @description Requester class, witch make requests for change password api
 */

namespace Helper\requesters\guzzle;

use Helper\queries\ChangePasswordQuery;

class ChangePasswordRequester extends BaseRequesterGuzzle
{
    public function makeChangePasswordRequester(ChangePasswordQuery $queryObj): array
    {
        $requestArr = [
            'new_password' => $queryObj->getNewPassword(),
            'old_password' => $queryObj->getOldPassword()
        ];

        $requestJson = json_encode($requestArr);
        $resetPasswordUrl = $this->urlFromConfig . $queryObj->getApiUrl();

        $response = $this->guzzleClient->put($resetPasswordUrl, [
            'body' => $requestJson
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);

        if (!isset($resultArr)) {
            throw new \Exception("Change password request with URL {$resetPasswordUrl} do not success");
        }

        return $resultArr;
    }
}