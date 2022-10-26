<?php

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
$page_title = $lang_module['edit_singer_content'];
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$xtpl = new XTemplate('edit_singer.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

$id = $nv_Request->get_int('listid','get',0);
$edtSinger = showDataSinger($id);
$idSinger = $nv_Request->get_int('idInput','post',0);

foreach($edtSinger as $Singer) {
    $xtpl->assign('SINGER',$Singer);
}

$tencasi = $nv_Request->get_string('tencasi','post','');

if($idSinger != 0){
    editSinger($idSinger,$tencasi);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=add_singer');
}

$xtpl -> assign('LANG',$lang_module);
$xtpl -> assign('ACTION',$action);
$xtpl -> parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';

