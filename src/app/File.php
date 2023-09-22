<?php

namespace lbreak\QuickLark\app;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use lbreak\QuickLark\interfaces\FolderInterface;
use lbreak\QuickLark\map\FolderMap;

class File extends BaseApp
{

    private const URL_DEL_FILE = '/open-apis/drive/v1/files/%s';

    /**
     * @param $fileToken
     * @param $type
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function delete($fileToken, $type): array
    {
        $data = $this->httpRequest('DELETE', sprintf(self::URL_DEL_FILE, $fileToken), ['query' => ['type' => $type]]);
        if ($data['code'] === 0) {
            return $data['data'];
        }
        throw new Exception($data['msg']);
    }
}