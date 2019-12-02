<?php
/**
 * @description Object of class with description of chang size in cart request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class CartSizeQuery
{
    private $baseProductVariationId;
    private $productVariationIdToChange;
    private $quantity;

    public function __construct(int $baseProductVariation, int $toChangeProductVariationId)
    {
        $this->setBaseProductVariationId($baseProductVariation);
        $this->setProductVariationIdToChange($toChangeProductVariationId);
        $this->setQuantity(1);
    }

    public function getFinalUrl()
    {
        $baseProductVariationId = $this->getBaseProductVariationId();
        return ApiUrls::CART_ITEMS . $baseProductVariationId . '/' . ApiUrls::CHANGE_VARIATION;
    }

    public function setBaseProductVariationId(int $productVariationIDBefore): CartSizeQuery
    {
        $this->baseProductVariationId = $productVariationIDBefore;
        return $this;
    }

    public function getBaseProductVariationId(): int
    {
        return $this->baseProductVariationId;
    }

    public function setProductVariationIdToChange(int $productVariationIdToChange): CartSizeQuery
    {
        $this->productVariationIdToChange = $productVariationIdToChange;
        return $this;
    }

    public function getProductVariationIdToChange(): int
    {
        return $this->productVariationIdToChange;
    }

    public function setQuantity(int $quantity): CartSizeQuery
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
