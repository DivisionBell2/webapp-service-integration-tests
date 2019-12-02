<?php
/**
 * @description Basic query typing check of hints and delivery response
 */

namespace delivery;

use Codeception\Util\Shared\Asserts;
use Helper\Arrays;
use Helper\queries\CourierRegionsQuery;
use Helper\queries\HintsQuery;
use Helper\requesters\codeception\CourierRegionsRequester;
use Helper\requesters\codeception\HintsRequester;

class CourierRegionsDeliveryResponseTypesCheckCest
{
    use Asserts;

    public function checkDeliveryHintsResponseTypes(\ApiTester $I)
    {
        $hintsQueryObj = (new HintsQuery());
        (new HintsRequester($I))->makeHintsRequest($hintsQueryObj);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $hints = $I->grabDataFromResponseByJsonPath('$.');
        Arrays::checkForEmptyArray($hints, 'Hints must be in response');

        foreach ($hints as $hintKey => $hintValue) {
            $hint = $I->grabDataFromResponseByJsonPath("$.[$hintKey]")[0];
            Arrays::checkForEmptyArray($hint, "Hint must be in {$hintKey}");
            $I->seeResponseMatchesJsonType([
                '_id' => 'string',
                'code' => 'string',
                'search_name' => 'string',
                'region_name' => 'string',
                'region' => 'string',
                'name' => 'string',
                'title' => 'string',
                'url' => 'string',
                'kladr_id' => 'integer:>0',
                'active' => 'boolean'
            ], "$.[$hintKey].");
        }
    }

    public function checkCourierRegionsDeliveryResponseTypes(\ApiTester $I)
    {
        $hintsQueryObj = (new HintsQuery());
        $cityHash = (new HintsRequester($I))->getIdHashForCity($hintsQueryObj);

        $regionsQuery = new CourierRegionsQuery($cityHash);
        (new CourierRegionsRequester($I))->makeCourierRegionsRequest($regionsQuery);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $courierRegionsDelivery = $I->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($courierRegionsDelivery, 'Delivery must be in response');

        foreach ($courierRegionsDelivery as $deliveryKey => $deliveryValue) {
            $delivery = $I->grabDataFromResponseByJsonPath("$.[$deliveryKey]")[0];
            Arrays::checkForEmptyArray($delivery, "Hint must be in {$deliveryKey}");

            if (isset($delivery['name']) && mb_strtolower($delivery['name']) == 'доставка до пункта выдачи') {
                $I->seeResponseMatchesJsonType([
                    'courier_service_type_id' => 'integer',
                    'name' => 'string',
                    'online_payment_message' => 'string',
                    'pickups' => 'array',
                    'delivery_from' => 'string',
                    'delivery_price' => 'string',
                    'addresses' => 'array',
                    'priority' => 'integer',
                ], "$.[$deliveryKey].");
                continue;
            }

            $I->seeResponseMatchesJsonType([
                'courier_service_id' => 'integer',
                'courier_service_type_id' => 'integer',
                'name' => 'string',
                'description' => 'string',
                'min_delivery_days' => 'array',
                'min_delivery_price' => 'integer',
                'delivery_dates' => 'array',
                'shelf_life' => 'string|null',
                'delivery_from' => 'string',
                'delivery_price' => 'string',
                'delivery_time_ranges' => 'array',
                'delivery_price_range' => 'array',
                'fitting' => 'boolean',
                'partial_order' => 'boolean',
                'items_limit' => 'integer',
                'price_limit' => 'integer',
                'payment_types' => 'array',
                'online_payment' => 'boolean',
                'online_payment_message' => 'string',
                'online_payment_price' => 'integer',
                'active' => 'boolean',
                'default' => 'boolean',
                'note' => 'string|null',
                'prices' => 'array',
                'priority' => 'integer',
                'show_order_contact_type' => 'boolean',
            ], "$.[$deliveryKey].");
        }
    }
}