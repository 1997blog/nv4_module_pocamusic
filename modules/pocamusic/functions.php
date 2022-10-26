<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 10/03/2010 10:51
 */

if (!defined('NV_SYSTEM')) {
    die('Stop!!!');
}

define('NV_IS_MOD_MUSIC', true);

$allow_func = array(
    'main',
);

// $submenu['listen'] = $lang_module['listen'];

// $submenu['listen'] = $lang_module['listen'];
// Loại sản phẩm

if (!in_array($op, ['viewcat', 'detail'], true)) {
    define('NV_IS_MOD_NEWS', true);
}

global $global_array_cat;
$global_array_cat = [];
$catid = 0;
$parentid = 0;

$alias_cat_url = isset($array_op[0]) ? $array_op[0] : '';
$array_mod_title = [];

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_theloai ORDER BY idtheloai ASC';
$list = $nv_Cache->db($sql, 'idtheloai', $module_name);
if (!empty($list)) {
    foreach ($list as $l) {
		$global_array_theloai[$l['idtheloai']] = $l;
        $global_array_theloai[$l['idtheloai']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
        if ($alias_cat_url == $l['alias']) {
            $catid = $l['idtheloai'];
        }
    }
}


$count_op = sizeof($array_op);

if (!empty($array_op) and $op == 'main') {
    if ($count_op == 1) {
        if ($catid == 0) {
            // Trang chủ
            $contents = $array_op[0];
        } else {
            // Xem chuyên mục
            $op = 'viewcat';
            if (isset($array_op[1])) {
                $page = (int) (substr($array_op[1], 5));
            }
        }
    }elseif ($count_op == 2) {
        $array_page = explode('-', $array_op[1]);
        $id = (int) (end($array_page));
        $number = strlen($id) + 1;
        $alias_url = substr($array_op[1], 0, -$number);
        if ($id > 0 and $alias_url != '') {
            if ($catid > 0) {
                $op = 'detail';
            } else {
                // Khi mất catID cũ (đổi alias chuyên mục, xóa chuyên mục) thì tìm ra catid mới để chuyển hướng
                $_row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_baihat WHERE idbaihat = ' . $id)->fetch();
                if (!empty($_row) and isset($global_array_cat[$_row['idbaihat']])) {

                }
            }
        }
    }
}




