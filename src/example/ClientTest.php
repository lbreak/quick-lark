<?php

namespace lbreak\QuickLark\example;

use Exception;
use lbreak\QuickLark\Client;

class ClientTest extends BaseTest
{

    public function getAccessToken()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $token = $client->getAccessToken();
            var_dump($token);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}