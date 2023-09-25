<?php

namespace lbreak\QuickLark\example;

use Exception;
use lbreak\QuickLark\Client;
use lbreak\QuickLark\consts\BiTableConst;

class BiTableTest extends BaseTest
{

    public function createBase()
    {
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->createBase('lbreak_test_api', 'EdsKfluVFl5EqNd5etTlvbKcg9f');
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function addTable(){
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->addTable('VbpTboDK1anZzPsgkx8laZctgUh', '2023-09-28','sss', [
                [
                    'field_name' => '字段1',
                    'type' => BiTableConst::FIELD_TYPE_1,
                ],
                [
                    'field_name' => '字段2',
                    'type' => BiTableConst::FIELD_TYPE_2,
                ],
                [
                    'field_name' => '字段3',
                    'type' => BiTableConst::FIELD_TYPE_1,
                ],
            ]);
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function addRecord(){
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->addRecord('VbpTboDK1anZzPsgkx8laZctgUh', 'tbl48zGRs2gN7NTv', [
                '字段1' => 'fffss',
                '字段2' => 123123213,
                '字段3' => 'xxasaa',
            ]);
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function batchAddRecord(){
        try {
            $client = Client::instance(Client::TYPE_TENANT, self::$appId, self::$appSecret, true);
            $map = $client->biTable->batchAddRecords('VbpTboDK1anZzPsgkx8laZctgUh', 'tbl48zGRs2gN7NTv', [
                [
                    'fields' => [
                        '字段1' => 'fffss',
                        '字段2' => 123123213,
                        '字段3' => 'xxasaa',
                    ]
                ],
                [
                    'fields' => [
                        '字段1' => '111fffss',
                        '字段2' => 45646,
                        '字段3' => '222xxasaa'
                    ]
                ],
            ]);
            var_dump($map->toArray());
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}