<?php
require_once "../vendor/autoload.php";


$appId = 'cli_a4c0ee2a6138d02f';
$appSecret = 'nZ10A7zdJpacE05icBL3UewZfSd7AhXq';

//\Shaobo\QuickLark\example\BiTableTest::init($appId,$appSecret)->createTable();
//\Shaobo\QuickLark\example\FolderTest::init($appId,$appSecret)->getFiles();
\Shaobo\QuickLark\example\FileTest::init($appId,$appSecret)->del();