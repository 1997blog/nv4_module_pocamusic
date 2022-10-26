<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 24-06-2011 10:35
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$page_title = $lang_module['add_singer_content'];
$xtpl = new XTemplate('add_singer.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

$number = 0;
$getAllSinger = getAllSinger();

foreach($getAllSinger as $getSinger){
    $number += 1;
    $xtpl->assign('NUMBER',$number);
    $xtpl -> assign('TEST',$getSinger);
    $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_singer&amp;listid=' . $getSinger['IDCASI'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_singer&amp;listid=' . $getSinger['IDCASI'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $xtpl->assign('ROW', $link_delete);
    $xtpl->assign('ROW1', $link_edit);
    $xtpl -> parse('main.loop');
}

$a = $value['tencasi'] = $nv_Request->get_string('tencasi','post',''); 

if($value['tencasi'] != null){
    insertSinger($a);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' .$op);
}

$xtpl -> assign('LANG',$lang_module);
$xtpl -> assign('ACTION',$action);
$xtpl -> parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
