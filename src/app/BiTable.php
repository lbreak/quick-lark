<?php

namespace Shaobo\QuickLark\app;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Shaobo\QuickLark\interfaces\BiTableInterface;
use Shaobo\QuickLark\map\BiTableMap;
use Shaobo\QuickLark\map\BiTableTableMap;
use Shaobo\QuickLark\map\FolderMap;

class BiTable extends BaseApp
{

    private const URL_CREATE_BI_TABLE = '/open-apis/bitable/v1/apps';
    private const URL_ADD_TABLE = '/open-apis/bitable/v1/apps/%s/tables';
    private const URL_ADD_RECORD = '/open-apis/bitable/v1/apps/%s/tables/%s/records';
    private const URL_BATCH_ADD_RECORD = '/open-apis/bitable/v1/apps/%s/tables/%s/records/batch_create';
    private const URL_DEL_RECORD = '/open-apis/bitable/v1/apps/%s/tables/%s/records/%s';
    private const URL_BATCH_DEL_RECORD = '/open-apis/bitable/v1/apps/%s/tables/%s/records/batch_delete';

    /**
     * @param $tableName
     * @param $folderToken
     * @return BiTableMap
     * @throws Exception
     */
    public function createBase($tableName, $folderToken): BiTableMap
    {
        $data = $this->httpPost(self::URL_CREATE_BI_TABLE, [
            'json' => [
                'name' => $tableName,
                'folder_token' => $folderToken
            ]
        ]);
        if ($data['code'] === 0) {
            return BiTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param $appToken
     * @param $tableName
     * @param string $defaultViewName
     * @param array $fields
     * @return BiTableTableMap
     * @throws Exception
     */
    public function addTable($appToken, $tableName, $defaultViewName = '', array $fields = []): BiTableTableMap
    {
        $data = $this->httpPost(sprintf(self::URL_ADD_TABLE, $appToken), [
            'json' => [
                'table' => [
                    'name' => $tableName,
                    'default_view_name' => $defaultViewName,
                    'fields' => $fields,
                ]
            ]
        ]);
        if ($data['code'] === 0) {
            return BiTableTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param $appToken
     * @param $tableId
     * @param array $record
     * @param string $userIdType
     * @param string $clientToken
     * @return BiTableTableMap
     * @throws Exception
     */
    public function addRecords($appToken, $tableId, array $record = [], $userIdType = '', $clientToken = ''): BiTableTableMap
    {
        $data = $this->httpPost(sprintf(self::URL_ADD_RECORD, $appToken, $tableId), [
            'json' => [
                'fields' => $record
            ],
            'query' => [
                'user_id_type' => $userIdType,
                'client_type' => $clientToken
            ]
        ]);
        if ($data['code'] === 0) {
            return BiTableTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param $appToken
     * @param $tableId
     * @param array $records
     * @param string $userIdType
     * @param string $clientToken
     * @return BiTableTableMap
     * @throws Exception
     */
    public function batchAddRecords($appToken, $tableId, array $records = [], $userIdType = '', $clientToken = ''): BiTableTableMap
    {
        $data = $this->httpPost(sprintf(self::URL_BATCH_ADD_RECORD, $appToken, $tableId), [
            'json' => [
                'records' => $records
            ],
            'query' => [
                'user_id_type' => $userIdType,
                'client_type' => $clientToken
            ]
        ]);
        if ($data['code'] === 0) {
            return BiTableTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param string $appToken
     * @param string $tableId
     * @param string $recordId
     * @return BiTableTableMap
     * @throws GuzzleException
     * @throws Exception
     */
    public function delRecords(string $appToken, string $tableId, string $recordId): BiTableTableMap
    {
        $data = $this->httpRequest('DELETE', sprintf(self::URL_DEL_RECORD, $appToken, $tableId, $recordId));
        if ($data['code'] === 0) {
            return BiTableTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }


    /**
     * @param string $appToken
     * @param string $tableId
     * @param array $records
     * @return BiTableTableMap
     * @throws GuzzleException
     * @throws Exception
     */
    public function batchDelRecord(string $appToken, string $tableId, array $records): BiTableTableMap
    {
        $data = $this->httpPost(sprintf(self::URL_BATCH_DEL_RECORD, $appToken, $tableId), [
            'json' => [
                'records' => $records
            ]
        ]);
        if ($data['code'] === 0) {
            return BiTableTableMap::init($data['data']);
        }
        throw new Exception($data['msg']);
    }
}