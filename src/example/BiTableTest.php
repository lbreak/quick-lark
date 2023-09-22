<?php

namespace lbreak\QuickLark\example;

use Exception;
use lbreak\QuickLark\Client;

class BiTableTest extends BaseTest
{

    public function createTable()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->createBase('lbreak_test_api', 'EdsKfluVFl5EqNd5etTlvbKcg9f');
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

}