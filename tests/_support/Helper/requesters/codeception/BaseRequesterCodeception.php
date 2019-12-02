<?php
/**
 * @description Base class of all requesters by Codeception
 */

namespace Helper\requesters\codeception;

abstract class BaseRequesterCodeception
{
    protected $apiTester;

    public function __construct(\ApiTester $I)
    {
        $this->apiTester = $I;
    }
}