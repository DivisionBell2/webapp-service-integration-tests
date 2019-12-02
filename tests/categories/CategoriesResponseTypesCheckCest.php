<?php
/**
 * @description Basic query typing check of categories response
 */

namespace categories;

use Codeception\Util\Shared\Asserts;
use Helper\Arrays;
use Helper\queries\CategoriesQuery;
use Helper\requesters\codeception\CategoriesRequester;

class CategoriesResponseTypesCheckCest
{
    use Asserts;

    private $categories;

    public function _before(\ApiTester $I)
    {
        $queryObj = new CategoriesQuery();
        (new CategoriesRequester($I))->makeCategoriesRequest($queryObj);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $this->categories = $I->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($this->categories, 'categories must be in response');
    }

    public function checkMainFieldsResponseTypeStructure(\ApiTester $I)
    {
        foreach ($this->categories as $key => $category) {
            $I->seeResponseMatchesJsonType([
                '_id' => 'integer:>0',
                'name' => 'string',
                'params' => 'array',
                'subcategories' => 'array:>0'
            ], "$.[$key]");
        }
    }

    public function checkThreeLevelsSubcategoriesResponseTypeStructure(\ApiTester $I)
    {
        foreach ($this->categories as $keyCategory => $category) {
            $subcategoriesLevelOne = $I->grabDataFromResponseByJsonPath("$.[$keyCategory].subcategories")[0];
            Arrays::checkForEmptyArray($subcategoriesLevelOne, "subcategories must be in {$keyCategory}-category");

            $countSubcategoriesLevelTwoChecked = 0;
            $countSubcategoriesLevelThreeChecked = 0;

            foreach ($subcategoriesLevelOne as $keySubcategoryLevelOne => $subcategoryLevelOne) {
                if (isset($subcategoryLevelOne['name']) && mb_strtolower($subcategoryLevelOne['name']) == 'новинки') {
                    $I->seeResponseMatchesJsonType([
                        '_id' => 'integer:>0',
                        'params' => 'array:>0',
                        'route' => 'string',
                        'name' => 'string',
                        'url_name' => 'string:regex(~^https:\/\/~)',
                        'subcategories' => 'array',
                    ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne]");
                    continue;
                }

                if (mb_strtolower($subcategoryLevelOne['name']) == 'бренды') {
                    $I->seeResponseMatchesJsonType([
                        '_id' => 'integer:>0',
                        'name' => 'string',
                        'url_name' => 'string:regex(~^https:\/\/~)',
                        'subcategories' => 'array:>0',
                        'params' => 'array',
                    ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne]");
                    continue;
                }

                if (mb_strtolower($subcategoryLevelOne['name']) == 'sale') {
                    $I->seeResponseMatchesJsonType([
                        '_id' => 'integer:>0',
                        'params' => 'array:>0',
                        'route' => 'string',
                        'name' => 'string',
                        'url_name' => 'string:regex(~^https:\/\/~)',
                        'subcategories' => 'array:>0',
                    ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne]");

                    $this->assertEquals(
                        1,
                        $subcategoryLevelOne['params']['sale'],
                        'params => sale must be 1'
                    );
                    continue;
                }

                $I->seeResponseMatchesJsonType([
                    '_id' => 'integer:>0',
                    'name' => 'string',
                    'parent_id' => 'integer:>0',
                    'activation_datetime' => 'integer|null',
                    'deactivation_datetime' => 'integer|null',
                    'product_count' => 'integer:>0',
                    'sort_id' => 'integer:>0',
                    'url_name' => 'string:regex(~^https:\/\/~)',
                    'category_path' => 'string',
                    'name_all' => 'string|null',
                    'params' => 'array',
                    'subcategories' => 'array',
                    'visible' => 'boolean'
                ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne]");


                if (isset($subcategoryLevelOne['subcategories']) && count($subcategoryLevelOne['subcategories']) > 0) {
                    $subcategoriesLevelTwo = $subcategoryLevelOne['subcategories'];

                    foreach ($subcategoriesLevelTwo as $keySubcategoryLevelTwo => $subcategoryLevelTwo) {
                        $countSubcategoriesLevelTwoChecked++;

                        $I->seeResponseMatchesJsonType([
                            '_id' => 'integer:>0',
                            'name' => 'string',
                            'parent_id' => 'integer:>0',
                            'activation_datetime' => 'integer|null',
                            'deactivation_datetime' => 'integer|null',
                            'active' => 'boolean',
                            'product_count' => 'integer',
                            'sort_id' => 'integer:>0',
                            'url_name' => 'string:regex(~^https:\/\/~)',
                            'category_path' => 'string',
                            'name_all' => 'string|null',
                            'params' => 'array',
                            'visible' => 'boolean'
                        ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne].subcategories[$keySubcategoryLevelTwo]");

                        if (isset($subcategoryLevelTwo['subcategories']) && count($subcategoryLevelTwo['subcategories']) > 0) {
                            $subcategoriesLevelThree = $subcategoryLevelTwo['subcategories'];

                            foreach ($subcategoriesLevelThree as $keySubcategoryLevelThree => $subcategoryLevelThree) {
                                $countSubcategoriesLevelThreeChecked++;

                                $I->seeResponseMatchesJsonType([
                                    '_id' => 'integer:>0',
                                    'name' => 'string',
                                    'parent_id' => 'integer:>0',
                                    'activation_datetime' => 'integer|null',
                                    'deactivation_datetime' => 'integer|null',
                                    'active' => 'boolean',
                                    'product_count' => 'integer',
                                    'sort_id' => 'integer',
                                    'url_name' => 'string:regex(~^https:\/\/~)',
                                    'category_path' => 'string',
                                    'name_all' => 'string|null',
                                    'params' => 'array',
                                    'visible' => 'boolean'
                                ], "$.[$keyCategory].subcategories[$keySubcategoryLevelOne]" .
                                    ".subcategories[$keySubcategoryLevelTwo].subcategories[$keySubcategoryLevelThree]");
                            }
                        }
                    }
                }

                $minCheckedCountLevelTwo = 3;
                $this->assertGreaterOrEquals(
                    $minCheckedCountLevelTwo,
                    $countSubcategoriesLevelTwoChecked,
                    "In {$keyCategory}-category, in {$keySubcategoryLevelOne}-subcategory, " .
                    "subcategories level two must be checked " .
                    "more than {$minCheckedCountLevelTwo} count"
                );

                $minCheckedCountLevelTwo = 2;
                $this->assertGreaterOrEquals(
                    $minCheckedCountLevelTwo,
                    $countSubcategoriesLevelThreeChecked,
                    "In {$keyCategory}-category, in {$keySubcategoryLevelOne}-subcategory, " .
                    "subcategories level three must be checked " .
                    "more than {$minCheckedCountLevelTwo} count"
                );
            }
        }
    }
}
