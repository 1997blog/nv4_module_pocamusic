<?php

/**
 * @Project PocaMusic 4.x
 * @Author YASUOGOJUNGLE <huynhquocbao0188@gmail.com>
 * @Copyright (C) 2020 YASUOGOJUNGLE. All rights reserved
 * @Createdate 22/06/2020 09:47
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$module_version = array(
    'name' => 'Module Poca Music',
    'modfuncs' => 'main,viewcat',
    'is_sysmod' => 0,
    'virtual' => 1,
    'version' => '1.0.00',
    'date' => 'Monday, June 22, 2020 09:47:00 GMT+07:00',
    'author' => 'YASUOGOJUNGLE <huynhquocbao0188@gmail.com>',
    'note' => '',
    'uploads_dir' => array(
        $module_upload,
        $module_upload . '/music',
        $module_upload . '/image',
    ),
);
