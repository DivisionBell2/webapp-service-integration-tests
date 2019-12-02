<?php
/**
 * @description Base class of all requesters by Guzzle
 */

namespace Helper\requesters\guzzle;

use GuzzleHttp\Client;

abstract class BaseRequesterGuzzle
{
    protected $guzzleClient;
    protected $urlFromConfig;

    public function __construct(\ApiTester $I, Client $client = null)
    {
        $this->urlFromConfig = $I->getUrlFromConfig();

        if ($client) {
            $this->guzzleClient = $client;
        } else {
            $this->guzzleClient = new Client([
                'defaults' => ['verify' => false],
                'cookies' => true
            ]);
        }
    }
}