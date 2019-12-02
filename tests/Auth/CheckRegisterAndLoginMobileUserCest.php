<?php
/**
 * @description Test check registration and mobile login user
 */

namespace auth;

use Codeception\Util\Shared\Asserts;
use Helper\GuzzleClientHelper;
use Helper\queries\UserLoginQuery;
use Helper\queries\UserRegisterQuery;
use Helper\requesters\guzzle\UserMobileLoginRequester;
use Helper\requesters\guzzle\UserRegisterRequester;

class CheckRegisterAndLoginMobileUserCest
{
    use Asserts;

    public function checkRegisterAndLoginUserByApi(\ApiTester $I)
    {
        $client = (new GuzzleClientHelper())->getClient();

        $queryObj = new UserRegisterQuery();
        $userArr = (new UserRegisterRequester($I, $client))->makeUserRegisterRequest($queryObj);

        $userIdFromRegistration = $userArr['user']['user_id'];

        $loginQuery = new UserLoginQuery($queryObj->getEmail(), $queryObj->getPassword());
        $userArrAfterLogin = (new UserMobileLoginRequester($I, $client))->makeUserMobileLoginRequest($loginQuery);

        $userIdFromLogin = $userArrAfterLogin['user']['user_id'];
        $emailAfterLogin = $userArrAfterLogin['user']['email'];

        $this->assertEquals(
            $userIdFromRegistration,
            $userIdFromLogin,
            'User_id after registration not match user_id after login'
        );

        $this->assertEquals(
            $queryObj->getEmail(),
            $emailAfterLogin,
            'Email after registration not match email after login'
        );
    }
}
