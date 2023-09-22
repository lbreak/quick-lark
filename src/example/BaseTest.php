<?php

namespace Shaobo\QuickLark\example;

use Exception;
use Shaobo\QuickLark\Client;

class BaseTest
{
    protected static $appId;
    protected static $appSecret;

    private static $_instance = [];

    private function __construct($appId, $appSecret)
    {
        self::$appId = $appId;
        self::$appSecret = $appSecret;
    }

    /**
     * @param $appId
     * @param $appSecret
     * @return static
     */
    public static function init($appId, $appSecret): self
    {
        $key = $appId . '_' . $appSecret;
        if (isset(self::$_instance[$key]) && self::$_instance[$key] instanceof static) {
            return self::$_instance[$key];
        }
        self::$_instance[$key] = new static($appId, $appSecret);
        return self::$_instance[$key];
    }
}