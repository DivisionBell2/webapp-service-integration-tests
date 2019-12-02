<?php
/**
 * @description Guzzle Client generator
 */

namespace Helper;

use GuzzleHttp\Client;

class GuzzleClientHelper
{
    private $client;

    public function __construct()
    {
        $this->createClient();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    private function createClient()
    {
        $config = [
            'defaults' => ['verify' => false],
            'cookies' => true,
            'headers' => [
                'X-Request-ID' => '1bcdd77ea071619c83d84acf0bb7eb19',
                'Content-Type' => 'application/json',
            ]
        ];

        $this->client = new Client($config);
    }
}
