<?php
/**
 * @description Make registration user
 */

namespace Helper\requesters\guzzle;

use Helper\queries\UserRegisterQuery;

class UserRegisterRequester extends BaseRequesterGuzzle
{
    public function makeUserRegisterRequest(UserRegisterQuery $queryObj): array
    {
        $userRegisterUrl = $this->urlFromConfig . $queryObj->getFinalApiUrl();
        $response = $this->guzzleClient->post($userRegisterUrl, [
            'form_params' => [
                'sms_subscribe' => $queryObj->getSmsSubscribe(),
                'subscribe' => $queryObj->getSubscribe(),
                'sex' => $queryObj->getSex(),
                'password' => $queryObj->getPassword(),
                'phone' => $queryObj->getPhone(),
                'email' => $queryObj->getEmail(),
                'name_entered' => $queryObj->getName(),
            ]
        ]);

        $bodyResponse = $response->getBody()->getContents();
        $resultArr = json_decode($bodyResponse, true);
        if (!isset($resultArr['user'])) {
            throw new \Exception("User with email " . $queryObj->getEmail() . " did't created");
        }

        return $resultArr;
    }
}