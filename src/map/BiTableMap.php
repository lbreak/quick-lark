<?php
declare(strict_types=1);

namespace lbreak\QuickLark\map;

/**
 * Class BiTableMap
 * @package lbreak\QuickLark\map
 */
class BiTableMap extends BaseMap {

    //表格app_token
    public $app_token = "";

    //表格名称
    public $name = 0;

    //文件夹token
    public $folder_token = '';

    //表格uri
    public $url = '';

    //默认table id
    public $default_table_id = '';
}