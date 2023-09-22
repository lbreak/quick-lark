<?php
declare(strict_types=1);

namespace Shaobo\QuickLark\map;

/**
 * Class AccessTokenMap
 * @package Shaobo\QuickLark\map
 */
class AccessTokenMap extends BaseMap
{

    public $access_token = "";

    //过期时间
    public $expire = 0;
}