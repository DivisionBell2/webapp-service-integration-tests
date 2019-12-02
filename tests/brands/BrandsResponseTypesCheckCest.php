<?php
/**
 * @description Basic query typing check of brands response
 */

namespace brands;

use Helper\queries\BrandsQuery;
use Codeception\Util\Shared\Asserts;
use Helper\Arrays;
use Helper\requesters\codeception\BrandsRequester;

class BrandsResponseTypesCheckCest
{
    use Asserts;

    public function checkMainFieldsResponseTypeStructure(\ApiTester $I)
    {
        $queryObj = new BrandsQuery();
        (new BrandsRequester($I))->makeCategoriesRequest($queryObj);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $letters = $I->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($letters, 'Letters must be in response');

        foreach ($letters as $keyLetter => $letterBrands) {
            Arrays::checkForEmptyArray($letterBrands, 'Letter-Brands must be in response');
            foreach ($letterBrands as $keyBrand => $brand) {
                $I->seeResponseMatchesJsonType([
                    '_id' => 'integer:>0',
                    'name' => 'string',
                    'url_name' => 'string',
                ], "$.[\"$keyLetter\"].[\"$keyBrand\"]");
                // Forced quotes are needed for Cyrillic and dashes
            }
        }
    }
}
