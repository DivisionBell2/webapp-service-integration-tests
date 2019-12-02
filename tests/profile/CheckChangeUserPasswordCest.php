<?php
/**
 * @description Test check changing user password
 */

namespace profile;

use Helper\queries\ChangePasswordQuery;
use Helper\requesters\guzzle\ChangePasswordRequester;
use Codeception\Util\Shared\Asserts;
use Helper\GuzzleClientHelper;
use Helper\queries\UserRegisterQuery;
use Helper\requesters\guzzle\UserRegisterRequester;

class CheckChangeUserPasswordCest
{
    use Asserts;

    public function checkChangeUserPasswordCest(\ApiTester $I)
    {
        $client = (new GuzzleClientHelper())->getClient();

        $queryObj = new UserRegisterQuery();
        $user = (new UserRegisterRequester($I, $client))->makeUserRegisterRequest($queryObj);

        $registeredUser = $user['user'];

        $registeredUserID = $registeredUser['user_id'];
        $registeredUserIDMaster = $registeredUser['user_id_master'];
        $registeredUserEmail = $registeredUser['email'];
        $registeredUserPhone = $registeredUser['phone'];
        $registeredUserNameEntered = $registeredUser['name_entered'];
        $registeredUserSex = $registeredUser['sex'];

        $oldPassword = $queryObj->getPassword();

        $changePasswordQuery = (new ChangePasswordQuery($oldPassword));
        $changePasswordResult = (new ChangePasswordRequester($I, $client))->makeChangePasswordRequester($changePasswordQuery);

        $this->assertIsString($changePasswordResult['_id'], 'Not a string');

        $changePasswordUserID = $changePasswordResult['user_id'];

        $this->assertIsString($changePasswordUserID, 'Not a string');

        $this->assertEquals(
            $registeredUserID,
            $changePasswordUserID,
            "_id value from registered (authorized) user is not equals _id value from request for changing password"
        );

        $changePasswordUserIDMaster = $changePasswordResult['user_id_master'];

        $this->assertIsString($changePasswordUserIDMaster, 'Not a string');

        $this->assertEquals(
            $registeredUserIDMaster,
            $changePasswordUserIDMaster,
            "user_id_master value from registered (authorized) user is not equals user_id_master value from request for changing password"
        );

        $changePasswordEmail = $changePasswordResult['email'];

        $this->assertIsString($changePasswordEmail, 'Not a string');

        $this->assertEquals(
            $registeredUserEmail,
            $changePasswordEmail,
            "email value from registered (authorized) user is not equals email value from request for changing password"
        );

        $changePasswordPhone = $changePasswordResult['phone'];

        $this->assertIsInt($changePasswordPhone, 'Not an integer');

        $this->assertEquals(
            $registeredUserPhone,
            $changePasswordPhone,
            "phone value from registered (authorized) user is not equals phone value from request for changing password"
        );

        $changePasswordNameEntered = $changePasswordResult['name_entered'];

        $this->assertIsString($changePasswordNameEntered, 'Not a string');

        $this->assertEquals(
            $registeredUserNameEntered,
            $changePasswordNameEntered,
            "name_entered value from registered (authorized) user is not equals name_entered value from request for changing password"
        );

        $this->assertIsString($changePasswordResult['name'], 'Not a string');

        $this->assertNull($changePasswordResult['patronymic'], 'Not a null');

        $this->assertNull($changePasswordResult['surname'], 'Not a null');

        $this->assertNull($changePasswordResult['dob'], 'Not a null');

        $changePasswordSex = $changePasswordResult['sex'];

        $this->assertIsInt($changePasswordSex, 'Not an integer');

        $this->assertEquals(
            $registeredUserSex,
            $changePasswordSex,
            "sex value from registered (authorized) user is not equals sex value from request for changing password"
        );

        $this->assertIsInt($changePasswordResult['group_id'], 'Not an integer');

        $this->assertNull($changePasswordResult['city'], 'Not a null');

        $this->assertNull($changePasswordResult['region'], 'Not a null');

        $this->assertNull($changePasswordResult['card_number'], 'Not a null');

        $this->assertNull($changePasswordResult['card_block_date'], 'Not a null');

        $this->assertNull($changePasswordResult['vk_id'], 'Not a null');

        $this->assertNull($changePasswordResult['fb_id'], 'Not a null');

        $this->assertNull($changePasswordResult['ok_id'], 'Not a null');

        $this->assertNull($changePasswordResult['in_id'], 'Not a null');

        $this->assertNull($changePasswordResult['fs_id'], 'Not a null');

        $this->assertIsBool($changePasswordResult['delete_mark'], 'Not a bool');

        $this->assertIsBool($changePasswordResult['previously_ordered'], 'Not a bool');

        $this->assertIsBool($changePasswordResult['previously_ordered_moscow'], 'Not a bool');

        $this->assertIsInt($changePasswordResult['buyout_items_percent'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['buyout_cash_percent'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['purchase_count'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['purchase_amount'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['purchase_discount'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['personal_discount'], 'Not an integer');

        $this->assertIsArray($changePasswordResult['addresses'], 'Not an array');

        $this->assertIsBool($changePasswordResult['sms_subscribe'], 'Not a bool');

        $this->assertIsString($changePasswordResult['source'], 'Not a string');

        $this->assertIsInt($changePasswordResult['status'], 'Not an integer');

        $this->assertIsString($changePasswordResult['update_date'], 'Not a string');

        $this->assertIsBool($changePasswordResult['catalog_region_condition'], 'Not a bool');

        $this->assertIsInt($changePasswordResult['complete_orders'], 'Not an integer');

        $this->assertIsInt($changePasswordResult['purchase_average'], 'Not an integer');

        $this->assertIsString($changePasswordResult['esb_status'], 'Not a string');

        $this->assertIsString($changePasswordResult['updated_at'], 'Not a string');

        $this->assertIsString($changePasswordResult['created_at'], 'Not a string');
    }
}