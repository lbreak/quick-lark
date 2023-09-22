<?php
declare(strict_types=1);

namespace lbreak\QuickLark\map;

/**
 * Class BiTableTableMap
 * @package lbreak\QuickLark\map
 */
class BiTableTableMap extends BaseMap {

    //多维表格数据表的唯一标识符
    public $table_id = "";

    //默认表格视图的id，该字段仅在请求参数中填写了default_view_name或fields才会返回
    public $default_view_id = '';

    //数据表初始字段的id列表，该字段仅在请求参数中填写了fields才会返回
    public $field_id_list = '';
}