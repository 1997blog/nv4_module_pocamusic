<?php

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$page_title = $lang_module['main_content'];
$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=sort';
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_URL', NV_BASE_SITEURL . 'uploads/' . $module_file);

$allMusic = getAllMusic();
$allSinger = getAllSinger();
$xtpl->assign('allMusic', $allMusic);
$number = 1;

//truyen id qua function deleteSong
$id = $nv_Request->get_int('listid', 'get', 0);
deleteSong($id);

if(!empty($allMusic)){
    foreach ($allMusic as $song) {
        $xtpl->assign('SONG', $song);
        $xtpl->assign('NUMBER', $number++);
        $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_music&amp;listid=' . $song['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
        $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=song&amp;id=' . $song['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
        $xtpl->assign('ROW', $link_delete);
        $xtpl->assign('ROW1', $link_edit);
        if ($song['PUBLISH'] == 1) {
            $xtpl->assign('PUBLISH', 'Hiển thị');
        } else {
            $xtpl->assign('PUBLISH', 'Ẩn');
        }
        $xtpl->parse('main.loopp');
    }
}else{
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=song');
}


foreach ($allSinger as $singer) {
    $xtpl->assign('SINGER', $singer);
    $xtpl->parse('main.loopSinger');
}

$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', $action);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
