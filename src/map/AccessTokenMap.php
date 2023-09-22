<?php
declare(strict_types=1);

namespace lbreak\QuickLark\map;

/**
 * Class AccessTokenMap
 * @package lbreak\QuickLark\map
 */
class AccessTokenMap extends BaseMap
{

    public $access_token = "";

    //过期时间
    public $expire = 0;
}