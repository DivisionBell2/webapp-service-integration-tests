<?php
/**
 * @description  Query typing check of categories response
 */

namespace categories;

use Codeception\Example;
use Codeception\Util\Shared\Asserts;
use Helper\Arrays;
use Helper\queries\CategoriesQuery;
use Helper\requesters\codeception\CategoriesRequester;

class CategoriesNumbersResponseTypesCheckCest
{
    use Asserts;

    /**
     * @dataProvider getCategoryNumbers
     */
    public function checkMainFieldsResponseTypeStructure(\ApiTester $I, Example $example)
    {
        $expectedCategoryID = $example['categoryID'];
        $queryObj = (new CategoriesQuery())->setCategoryId($expectedCategoryID);
        (new CategoriesRequester($I))->makeCategoriesRequest($queryObj);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $categories = $I->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($categories, 'categories must be in response');

        $this->assertCount(
            1,
            $categories,
            "response must to contain more than 1 categories"
        );

        foreach ($categories as $key => $category) {
            $I->seeResponseMatchesJsonType([
                '_id' => 'integer:>0',
                'name' => 'string',
                'params' => 'array',
                'subcategories' => 'array:>0'
            ], "$.[$key]");

            $this->assertEquals(
                $expectedCategoryID,
                $category['_id'],
                $expectedCategoryID. ' is not equals with id from response - ' . $category['_id']
            );
        }
    }

    protected function getCategoryNumbers(): array
    {
        return [
            ['categoryID' => '4'],
            ['categoryID' => '5'],
            ['categoryID' => '9'],
            ['categoryID' => '128'],
            ['categoryID' => '179'],
            ['categoryID' => '197'],
            ['categoryID' => '239'],
            ['categoryID' => '316'],
            ['categoryID' => '334'],
            ['categoryID' => '352']
        ];
    }
}