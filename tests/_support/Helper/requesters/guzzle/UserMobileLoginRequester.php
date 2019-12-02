<?php
/**
 * @description Make mobile login request
 */

namespace Helper\requesters\guzzle;

use Helper\queries\UserLoginQuery;

class UserMobileLoginRequester extends BaseRequesterGuzzle
{
    public function makeUserMobileLoginRequest(UserLoginQuery $queryObj): array
    {
        $userRegisterUrl = $this->urlFromConfig . $queryObj->getFinalApiUrl();

        $response = $this->guzzleClient->post($userRegisterUrl, [
            'headers' => [
                'uuid' => '241325124134',
            ],
            'form_params' => [
                'password' => $queryObj->getPassword(),
                'email' => $queryObj->getEmail(),
            ],
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);
        if (!isset($resultArr['user']['user_id'])) {
            throw new \Exception("Cannot login user with email " . $queryObj->getEmail());
        }

        return $resultArr;
    }
}