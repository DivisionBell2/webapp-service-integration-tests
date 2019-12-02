<?php
/**
 * @description Test is checking reset password api
 */

namespace auth;

use _support\Helper\queries\ResetPasswordQuery;
use _support\Helper\requesters\guzzle\ResetPasswordRequester;
use Codeception\Util\Shared\Asserts;
use Helper\GuzzleClientHelper;
use Helper\queries\UserRegisterQuery;
use Helper\requesters\guzzle\UserRegisterRequester;

class CheckPasswordResetForRegisteredUserCest
{
    use Asserts;

    public function checkPasswordResetForRegisteredUserCest(\ApiTester $I)
    {
        $client = (new GuzzleClientHelper())->getClient();

        $userObj = new UserRegisterQuery();
        $user = (new UserRegisterRequester($I, $client))->makeUserRegisterRequest($userObj);
        $userEmail = $user['user']['email'];

        $resetPasswordQuery = (new ResetPasswordQuery($userEmail));
        $resetPassword = (new ResetPasswordRequester($I, $client))->makeResetPasswordRequester($resetPasswordQuery);
        $message = $resetPassword['message'];

        $this->assertIsString(
            $message,
            'Not a string'
        );

        $this->assertContains(
            $userEmail,
            $message,
            "{$userEmail} isn't existing in response message"
        );
    }
}