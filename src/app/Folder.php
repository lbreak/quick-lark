<?php

namespace Shaobo\QuickLark\app;

use Exception;
use Shaobo\QuickLark\interfaces\FolderInterface;
use Shaobo\QuickLark\map\FolderMap;

class Folder extends BaseApp
{

    private const URL_GET_ROOT_FOLDER = '/open-apis/drive/explorer/v2/root_folder/meta';

    private const URL_CREATE_FOLDER = "/open-apis/drive/explorer/v2/folder/%s";

    private const URL_GET_FILES = "/open-apis/drive/v1/files";

    /**
     * @return FolderMap
     * @throws Exception
     */
    public function getRoot(): FolderMap
    {
        $data = $this->httpGet(self::URL_GET_ROOT_FOLDER);
        if ($data['code'] === 0) {
            return FolderMap::init([
                'token' => $data['data']['token'],
                'id' => $data['data']['id'],
                'ownUid' => $data['data']['user_id']
            ]);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param $folderPathToken
     * @param $folderName
     * @return FolderMap
     * @throws Exception
     */
    public function create($folderPathToken, $folderName): FolderMap
    {
        $uri = sprintf(self::URL_CREATE_FOLDER, $folderPathToken);
        $data = $this->httpPost($uri, [
            'json' => ['title' => $folderName]
        ]);
        if ($data['code'] === 0) {
            return FolderMap::init([
                'token' => $data['data']['token'],
                'url' => $data['data']['url'],
                'revision' => $data['data']['revision']
            ]);
        }
        throw new Exception($data['msg']);
    }

    /**
     * @param string $folderPathToken
     * @param string $page
     * @param int $pageSize
     * @return array
     * @throws Exception
     */
    public function getFiles($folderPathToken = '', $page = '', $pageSize = 20): array {
        $query = [
            'page_size' => $pageSize,
        ];
        if($page) {
            $query['page'] = $page;
        }
        if($folderPathToken) {
            $query['folder_token'] = $folderPathToken;
        }
        $data = $this->httpGet(self::URL_GET_FILES, [
            'query' => $query
        ]);
        if ($data['code'] === 0) {
            return $data['data'];
        }
        throw new Exception($data['msg']);
    }
}