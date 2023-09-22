<?php

namespace lbreak\QuickLark\example;

use Exception;
use lbreak\QuickLark\Client;

class FileTest extends BaseTest
{


    public function del()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $files = $client->file->delete('BwyEbUMeeaDgUzsE3CFl2Jdpghf', 'bitable');
            var_dump($files);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}