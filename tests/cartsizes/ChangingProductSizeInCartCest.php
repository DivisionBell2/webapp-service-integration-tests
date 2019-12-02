<?php
/**
 * @description Changing product size in cart request
 */

namespace cartsizes;

use Codeception\Util\Shared\Asserts;
use Helper\Arrays;
use Helper\GuzzleClientHelper;
use Helper\queries\CartSizeQuery;
use Helper\queries\CatalogQuery;
use Helper\requesters\codeception\CatalogRequester;
use Helper\requesters\guzzle\AddToCartRequester;
use Helper\requesters\guzzle\CartSizeRequester;

class ChangingProductSizeInCartCest
{
    use Asserts;

    public function checkChangingProductSizeInCartCest(\APITester $I)
    {
        $client = (new GuzzleClientHelper())->getClient();

        $catalogQueryObj = (new CatalogQuery())->setQuery('юбка');
        $productVariationIds = (new CatalogRequester($I))->getProductVariationIds($catalogQueryObj);

        $baseProductVariationId = $productVariationIds[0];
        $productVariationIdToChange = $productVariationIds[1];
        (new AddToCartRequester($I, $client))->makeAddToCartRequest($baseProductVariationId);

        $cartSizeQuery = (new CartSizeQuery($baseProductVariationId, $productVariationIdToChange));
        $changeSizeResult = (new CartSizeRequester($I, $client))->makeCartSizeRequest($cartSizeQuery);

        $this->assertIsInt($changeSizeResult['product_id'], 'Not an integer');

        $this->assertIsString($changeSizeResult['sku'], 'Not a string');

        $this->assertIsInt($changeSizeResult['photobank_id'], 'Not an integer');

        $this->assertIsInt($changeSizeResult['category_id'], 'Not an integer');

        $this->assertIsString($changeSizeResult['name'], 'Not a string');

        $this->assertIsString($changeSizeResult['seo_name'], 'Not a string');

        $this->assertIsString($changeSizeResult['brand_name'], 'Not a string');

        $this->assertIsInt($changeSizeResult['original_price'], 'Not an integer');

        $this->assertIsInt($changeSizeResult['sale_price'], 'Not an integer');

        $this->assertIsString($changeSizeResult['url'], 'Not a string');

        $this->assertIsString($changeSizeResult['image'], 'Not a string');

        $sizes = $changeSizeResult['sizes'];

        $this->assertIsArray($sizes, 'Not an array');

        Arrays::checkForEmptyArray($sizes, 'Array "sizes" is empty');

        $this->assertIsArray($changeSizeResult['variations'], 'Not an array');

        $variationsSizes = $changeSizeResult['variations']['size'];

        $this->assertIsArray($variationsSizes, 'Not an array');

        Arrays::checkForEmptyArray($variationsSizes, 'Array "variation size" is empty');

        foreach ($variationsSizes as $variationSize) {
            $this->assertIsInt($variationSize['id'], 'Not an integer');

            $this->assertIsString($variationSize['value'], 'Not a string');

            $this->assertIsInt($variationSize['available_quantity'], 'Not an integer');
        }

        $variationsRusSizes = $changeSizeResult['variations']['rus_size'];

        $this->assertIsArray($variationsRusSizes, 'Not an array');

        Arrays::checkForEmptyArray($variationsRusSizes, 'Array "variation rus_size" is empty');

        foreach ($variationsRusSizes as $variationRusSize) {
            $this->assertIsInt($variationRusSize['id'], 'Not an integer');

            $this->assertIsString($variationRusSize['value'], 'Not a string');

            $this->assertIsInt($variationRusSize['available_quantity'], 'Not an integer');
        }

        $this->assertIsString($changeSizeResult['brand_url'], 'Not a string');

        $this->assertIsString($changeSizeResult['breadcrumbs'], 'Not a string');

        $this->assertIsBool($changeSizeResult['already_at_wishlist'], 'Not a bool');

        $this->assertIsInt($changeSizeResult['id'], 'Not an integer');

        $this->assertIsString($changeSizeResult['current_size'], 'Not a string');

        $this->assertIsString($changeSizeResult['main_size'], 'Not a string');

        $this->assertIsString($changeSizeResult['rus_size'], 'Not a string');

        $this->assertIsString($changeSizeResult['brand_size'], 'Not a string');

        $this->assertIsString($changeSizeResult['denim_size'], 'Not a string');

        $this->assertIsString($changeSizeResult['denim_height_str'], 'Not a string');

        $this->assertIsString($changeSizeResult['insole_lenght'], 'Not a string');

        $this->assertIsInt($changeSizeResult['available_quantity'], 'Not an integer');

        $this->assertIsInt($changeSizeResult['quantity'], 'Not an integer');

        $this->assertIsInt($changeSizeResult['price'], 'Not an integer');

        $this->assertIsInt($changeSizeResult['total_amount'], 'Not an integer');

        $discount = $changeSizeResult['discount'];

        $this->assertIsArray($discount, 'Not an array');

        Arrays::checkForEmptyArray($discount, 'Array "discount" is empty');
    }
}
