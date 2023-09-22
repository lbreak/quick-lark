<?php

namespace lbreak\QuickLark\example;

use Exception;
use lbreak\QuickLark\Client;

class FolderTest extends BaseTest
{

    public function getRoot()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $root = $client->folder->getRoot();
            var_dump($root);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function getFiles()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $files = $client->folder->getFiles('nodlg3W5HFbL7x9bPedrdAOmbpg');
            var_dump($files);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}