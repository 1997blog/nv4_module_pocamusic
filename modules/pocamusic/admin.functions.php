<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/31/2009 2:29
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) {
    die('Stop!!!');
}

define('NV_IS_FILE_ADMIN', true);

$allow_func = array(
    'main',
    'song',
    'alias',
    'edit_music',
    'delete_music',
    'add_singer',
    'edit_singer',
    'delete_singer',
    'cat',
    'delete_cat',
    'sort',

);

$submenu['song'] = $lang_module['add_music'];
$submenu['add_singer'] = $lang_module['add_singer'];
$submenu['cat'] = $lang_module['add_cat'];
// $submenu['edit_music'] = $lang_module['edit_music'];





