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
$xtpl = new XTemplate('sort.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$page_title = $lang_module['add_music_content'];

$number = 1;

$allSinger = getAllSinger();

// // get value va show data vao table
$idPublish = $nv_Request->get_int('stype', 'post', 0); // idpublish

// // get value va show data vao table
$idSinger = $nv_Request->get_int('singer', 'post', 0); // idsinger

// // get data tu input search
$datasearch = $nv_Request->get_string('timkiem', 'post', '');


// ca 3 khong chon
if ($idPublish == 2 && $idSinger == 0 && $datasearch == '') {
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
}

//chon search
if ($idPublish == 2 && $idSinger == 0 && $datasearch != '') {
    $search = showDataSearchShow($datasearch);
    if ($datasearch == null) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    } else {
        foreach ($search as $searchAll) {
            $xtpl->assign('NUMBER', $number++);
            $xtpl->assign('SEARCH', $searchAll);
            $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_music&amp;listid=' . $publish['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_music&amp;listid=' . $publish['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $xtpl->assign('ROW', $link_delete);
            $xtpl->assign('ROW1', $link_edit);
            if ($publish['PUBLISH'] != 1) {
                $xtpl->assign('PUBLISH', ' Ẩn ');
            } else {
                $xtpl->assign('PUBLISH', ' Hiển thị ');
            }
            $xtpl->parse('main.searchSong');
        }
    }
}

//chon publish
if ($idPublish != 2 && $idSinger == 0 && $datasearch == '') {
    $getIdPublish = getIdPublish($idPublish);
    if ($getIdPublish == null) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    } else {
        foreach ($getIdPublish as $publish) {
            $xtpl->assign('NUMBER', $number++);
            $xtpl->assign('LISTPUBLISH', $publish);
            $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_music&amp;listid=' . $publish['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_music&amp;listid=' . $publish['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $xtpl->assign('ROW', $link_delete);
            $xtpl->assign('ROW1', $link_edit);
            if ($publish['PUBLISH'] != 1) {
                $xtpl->assign('PUBLISH', ' Ẩn ');
            } else {
                $xtpl->assign('PUBLISH', ' Hiển thị ');
            }
            $xtpl->parse('main.loopListPublish');
            $idSinger = 0;
        }
    }
}

//chon singer
if ($idSinger != 0 && $idPublish == 2 && $datasearch == '') {
    $getIdSinger = getIdSinger($idSinger);
    if ($getIdSinger == null) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    } else {
        foreach ($getIdSinger as $singer) {
            $xtpl->assign('NUMBER', $number++);
            $xtpl->assign('LISTSINGER', $singer);
            $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_music&amp;listid=' . $singer['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_music&amp;listid=' . $singer['IDBAIHAT'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
            $xtpl->assign('ROW', $link_delete);
            $xtpl->assign('ROW1', $link_edit);
            if ($singer['PUBLISH'] != 1) {
                $xtpl->assign('PUBLISH', ' Ẩn ');
            } else {
                $xtpl->assign('PUBLISH', ' Hiển thị ');
            }
            $xtpl->parse('main.loopListSinger');
        }
    }
}

//chon ca 2
if ($idSinger != 0 && $idPublish != 2) {
    $idSingerPublish = getIdSingerPublish($idSinger, $idPublish);
    if ($idSingerPublish == null) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    } else {
        foreach ($idSingerPublish as $idSP) {
            $xtpl->assign('NUMBER', $number++);
            if ($idSP['PUBLISH'] == 1) {
                $xtpl->assign('PUBLISH', 'Hiển thị');
            } else {
                $xtpl->assign('PUBLISH', 'Ẩn');
            }
            $xtpl->assign('SINGERPULISH', $idSP);
            $xtpl->parse('main.loopSingerPublish');
        }
    }
}

foreach ($allSinger as $singer) {
    $xtpl->assign('SINGER', $singer);
    $xtpl->parse('main.loopSinger');
}

$xtpl->assign('LANG', $lang_module);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
