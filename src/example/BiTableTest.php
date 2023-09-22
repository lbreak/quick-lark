<?php

namespace Shaobo\QuickLark\example;

use Exception;
use Shaobo\QuickLark\Client;

class BiTableTest extends BaseTest
{

    public function createTable()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->createBase('shaobo_test_api', 'EdsKfluVFl5EqNd5etTlvbKcg9f');
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

}