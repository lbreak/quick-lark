<?php
declare(strict_types=1);

namespace Shaobo\QuickLark\map;

/**
 * Class FolderMap
 * @package Shaobo\QuickLark\map
 */
class FolderMap extends BaseMap {

    //文件夹ID
    public $id = "";

    //文件夹名称
    public $name = 0;

    //文件夹token
    public $token = '';

    //创建人ID
    public $createUid = '';

    //编辑人 id
    public $editUid = '';

    //文件夹为个人文件夹时，为文件夹的所有者 id；文件夹为共享文件夹时，为文件夹树id
    public $ownUid = '';

    public $revision = '';
}