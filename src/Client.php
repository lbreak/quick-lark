<?php

namespace Shaobo\QuickLark;

use Exception;
use Shaobo\QuickLark\app\BaseApp;
use Shaobo\QuickLark\app\BiTable;
use Shaobo\QuickLark\app\File;
use Shaobo\QuickLark\app\Folder;
use Shaobo\QuickLark\map\AccessTokenMap;

/**
 * Class Client
 * @property Folder $folder
 * @property File $file
 * @property BiTable $biTable
 * @property string $access_token
 * @property int $access_token_expire
 */
class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    public $http_client;

    //app id
    private $app_id = '';
    //app secret  get by lark
    private $app_secret = '';

    private $access_token;

    private $access_token_expire;

    public const TYPE_APP = 1;//应用授权凭证

    public const TYPE_TENANT = 2;//租户授权凭证

    private const TYPE_APP_URL = '/open-apis/auth/v3/app_access_token';

    private const TYPE_TENANT_URL = '/open-apis/auth/v3/tenant_access_token';

    //授权凭证类型
    private $type = '';
    //响应数据token字段
    private $token_field = '';
    //是否内建应用
    private $is_internal = false;

    private static $_instance;


    /**
     * Client constructor.
     * @param int $type
     * @param string $app_id
     * @param string $app_secret
     * @param bool $is_internal
     * @throws Exception
     */
    private function __construct(int $type, string $app_id = '', string $app_secret = '', bool $is_internal = false)
    {
        switch ($type) {
            case self::TYPE_APP:
                $this->token_field = 'app_access_token';
                break;
            case self::TYPE_TENANT:
                $this->token_field = 'tenant_access_token';
                break;
            default:
                throw new Exception("token type is error");
        }
        $this->type = $type;
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
        $this->is_internal = $is_internal;
        $this->http_client = new \GuzzleHttp\Client([
            'base_uri' => 'https://open.larksuite.com/'
        ]);
    }

    /**
     * @param int $type
     * @param string $app_id
     * @param string $app_secret
     * @param bool $is_internal
     * @return Client
     * @throws Exception
     */
    public static function instance(int $type, string $app_id, string $app_secret, bool $is_internal = false): Client
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        }
        self::$_instance = new self($type, $app_id, $app_secret, $is_internal);

        return self::$_instance;
    }

    /**
     * @param $field
     * @return mixed
     * @throws Exception
     */
    public function __get($field)
    {
        $appClass = 'Shaobo\QuickLark\app\\' . ucfirst($field);
        if (isset($this->$field) && $this->$field instanceof $appClass) {
            return $this->$field;
        }
        if (class_exists($appClass)) {
            try {
                switch ($appClass) {
                    default:
                        if (is_subclass_of($appClass, BaseApp::class)) {
                            $this->$field = new $appClass($this->getBaseParams());
                        } else {
                            $this->$field = new $appClass();
                        }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $this->$field;
        }
        return isset($this->$field) ? $this->$field : null;
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getBaseParams(): array
    {

        if (($this->access_token_expire - time()) < 1800) {
            $this->getAccessToken();
        }
        return [
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'client' => self::$_instance,
            'access_token' => $this->access_token,
            'access_token_expire' => $this->access_token_expire
        ];
    }

    /**
     * @return AccessTokenMap
     * @throws Exception
     */
    public function getAccessToken(): AccessTokenMap
    {
        $uri = $this->type === self::TYPE_TENANT ? self::TYPE_TENANT_URL : self::TYPE_APP_URL;
        if ($this->is_internal) {
            $uri .= '/internal';
        }
        $response = $this->http_client->post($uri, [
            'headers' => ['Content-Type' => 'application/json; charset=utf-8'],
            'json' => [
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
            ]
        ]);
        if ($response->getStatusCode() != 200) {
            throw new Exception('get Lark access token is fail');
        }
        $body = $response->getBody()->getContents();
        $body = is_string($body) ? json_decode($body, true) : $body;
        if ($body['code'] != 0) {
            throw new Exception($body['msg']);
        }
        $accessTokenMap = AccessTokenMap::init(['access_token' => $body[$this->token_field], 'expire' => $body['expire']]);
        $this->access_token = $accessTokenMap->access_token;
        $this->access_token_expire = time() + $accessTokenMap->expire;
        return $accessTokenMap;
    }
}