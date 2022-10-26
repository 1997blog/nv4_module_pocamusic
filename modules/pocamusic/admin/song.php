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
$getAllSinger = getAllSinger();
$getAllCat = getAllCat();
$id = $nv_Request->get_int('id', 'post,get', 0);
$currentpath = NV_UPLOADS_DIR . '/' . $module_upload;
// Xác định và tạo các thư mục upload
$username_alias = change_alias($admin_info['username']);
$array_structure_image = [];
$array_structure_image[''] = $module_upload;
$array_structure_image['Y'] = $module_upload . '/image'.'/' . date('Y');
$array_structure_image['Ym'] = $module_upload . '/image'.'/' . date('Y_m');
$array_structure_image['Y_m'] = $module_upload . '/image'.'/' . date('Y/m');
$array_structure_image['Ym_d'] = $module_upload . '/image'.'/' . date('Y_m/d');
$array_structure_image['Y_m_d'] = $module_upload . '/image'.'/' . date('Y/m/d');
$array_structure_image['username'] = $module_upload . '/image'.'/' . $username_alias;

$array_structure_image['username_Y'] = $module_upload . '/image'.'/' . $username_alias . '/' . date('Y');
$array_structure_image['username_Ym'] = $module_upload . '/image'.'/' . $username_alias . '/' . date('Y_m');
$array_structure_image['username_Y_m'] = $module_upload . '/image'.'/' . $username_alias . '/' . date('Y/m');
$array_structure_image['username_Ym_d'] = $module_upload . '/image'.'/' . $username_alias . '/' . date('Y_m/d');
$array_structure_image['username_Y_m_d'] = $module_upload . '/image'.'/' . $username_alias . '/' . date('Y/m/d');

$structure_upload = isset($module_config[$module_name]['structure_upload']) ? $module_config[$module_name]['structure_upload'] : 'Ym';
$currentpath = isset($array_structure_image[$structure_upload]) ? $array_structure_image[$structure_upload] : '';

if (file_exists(NV_UPLOADS_REAL_DIR . '/' . $currentpath)) {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $currentpath;
} else {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $module_upload;
    $e = explode('/', $currentpath);
    if (!empty($e)) {
        $cp = '';
        foreach ($e as $p) {
            if (!empty($p) and !is_dir(NV_UPLOADS_REAL_DIR . '/' . $cp . $p)) {
                $mk = nv_mkdir(NV_UPLOADS_REAL_DIR . '/' . $cp, $p);
                if ($mk[0] > 0) {
                    $upload_real_dir_page = $mk[2];
                    try {
                        $db->query('INSERT INTO ' . NV_UPLOAD_GLOBALTABLE . "_dir (dirname, time) VALUES ('" . NV_UPLOADS_DIR . '/' . $cp . $p . "', 0)");
                    } catch (PDOException $e) {
                        trigger_error($e->getMessage());
                    }
                }
            } elseif (!empty($p)) {
                $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $cp . $p;
            }
            $cp .= $p . '/';
        }
    }
    $upload_real_dir_page = str_replace('\\', '/', $upload_real_dir_page);
}

$currentpath = str_replace(NV_ROOTDIR . '/', '', $upload_real_dir_page);
$uploads_dir_user = NV_UPLOADS_DIR . '/' . $module_upload;
if (!defined('NV_IS_SPADMIN') and str_contains($structure_upload, 'username')) {
    $array_currentpath = explode('/', $currentpath);
    if ($array_currentpath[2] == $username_alias) {
        $uploads_dir_user = NV_UPLOADS_DIR . '/' . $module_upload . '/' . $username_alias;
    }
}

if ($id) {
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_baihat  WHERE idbaihat=' . $id;
    $row = $db->query($sql)->fetch();

    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
    }
    $page_title = $lang_module['edit'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $id;
} else {
    $page_title = $lang_module['add'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
}
$is_save = $nv_Request->get_int('is_save', 'post', 0);

if(!empty($is_save)){
    $row['idcasi'] = $nv_Request->get_int('cars', 'post', 0);
    $row['idtheloai'] = $nv_Request->get_int('cars1', 'post', 0);
    $row['tenbaihat'] = nv_substr($nv_Request->get_title('tenbaihat', 'post', ''), 0, 250);
    $row['publish'] = $nv_Request->get_int('publish', 'post', 0);
    $image = $nv_Request->get_string('image', 'post', '');
    if (nv_is_file($image, NV_UPLOADS_DIR . '/' . $module_upload. '/image')) {
        $row['img'] = substr($image, strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'.'image/'));
    } else {
        $row['img'] = '';
    }
    if (isset($_FILES["media"])) {
        $file_name = $_FILES["media"]["name"];
        $file_type = $_FILES["media"]["type"];
        $tmp_name = $_FILES["media"]["tmp_name"];
        $file_size = $_FILES["media"]["size"];
    
        $ext = explode(".", $file_name);
        $file_ext = strtolower(end($ext));
    
        $array_ext = array("mp3");
        if (!in_array($file_ext, $array_ext)) {
            Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        } else {
            move_uploaded_file($tmp_name, NV_ROOTDIR . '/uploads/pocamusic/music/' . $file_name);
            $d = $row['part'] = $file_name;
        }
    }

    if ($id) {
        $_sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_baihat SET
        idcasi = :idcasi, idtheloai = :idtheloai, tenbaihat = :tenbaihat , part = :part, img = :img, publish = :publish,
        update_time = ' . NV_CURRENTTIME . ' WHERE idbaihat =' . $id;
    } else {

        $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_baihat (
            idcasi, idtheloai, tenbaihat,  part, img, publish, add_time, update_time
            ) VALUES (
            :idcasi, :idtheloai, :tenbaihat, :part, :img, :publish,' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ')';
    }
    
    try {
        $sth = $db->prepare($_sql);
        $sth->bindParam(':idcasi', $row['idcasi'], PDO::PARAM_STR);
        $sth->bindParam(':idtheloai', $row['idtheloai'], PDO::PARAM_STR);
        $sth->bindParam(':tenbaihat', $row['tenbaihat'], PDO::PARAM_STR);
        $sth->bindParam(':part', $row['part'], PDO::PARAM_STR);
        $sth->bindParam(':img', $row['img'], PDO::PARAM_STR);
        $sth->bindParam(':publish', $row['publish'], PDO::PARAM_STR);
        $sth->execute();

        if ($sth->rowCount()) {
            if ($id) {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit', 'idbaihat: ' . $id, $admin_info['userid']);
            } else {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Add', ' ', $admin_info['userid']);
            }

            $nv_Cache->delMod($module_name);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        } else {
            $error = $lang_module['errorsave'];
        }
    } catch (PDOException $e) {
        trigger_error(print_r($e, true));
        $error = $lang_module['errorsave'];
    }

}

$xtpl = new XTemplate('song.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$page_title = $lang_module['add_music_content'];
$xtpl->assign('UPLOAD_CURRENT', $currentpath);
$xtpl->assign('UPLOAD_PATH', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('CAPTION', $page_title);
$xtpl->assign('DATA', $row);
$xtpl->assign('UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('ACTION', $action);
$action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$xtpl->assign('NV_URL', NV_BASE_SITEURL . 'uploads/' . $module_file);

$showSong = showDataSong($id);
$number = 1;

foreach ($showSong as $song) {
    if ($song['PUBLISH'] != 0) {
        $xtpl->assign('CHECKED', 'checked');
    }
    if ($song['PUBLISH'] == 1) {
        $xtpl->assign('PUBLISH', 'Hiển thị');
    } else {
        $xtpl->assign('PUBLISH', 'Ẩn');
    }
    $xtpl->assign('SONG', $song);
}

foreach ($getAllSinger as $test) {
    $xtpl->assign('TEST', $test);
    $xtpl->parse('main.loop');
}

foreach ($getAllCat as $test) {
    $xtpl->assign('TEST1', $test);
    $xtpl->parse('main.loop1');
}


$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
