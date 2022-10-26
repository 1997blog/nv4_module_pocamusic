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

$data = array();

$sql = 'SELECT 	* FROM '.NV_PREFIXLANG . '_' . $module_data . '_theloai';
$_rows = $db->query($sql)->fetchAll();

if ($id) {
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_theloai  WHERE idtheloai=' . $id;
    $row = $db->query($sql)->fetch();


    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
    }

    /*
     * Khi sao chép bài viết chuyển liên kết tĩnh thành không trùng
     * người đăng bài có trách nhiệm tự thay thế liên kết tĩnh khác
     */

    $page_title = $lang_module['edit'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $id;
} else {
    $page_title = $lang_module['add'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
}


$savecat = $nv_Request->get_int('save_cat', 'post', 0);
if(!empty($savecat)){

    $row['tentheloai'] = nv_substr($nv_Request->get_title('tentheloai', 'post', ''), 0, 250);
    $image = $nv_Request->get_string('image', 'post', '');
    if (nv_is_file($image, NV_UPLOADS_DIR . '/' . $module_upload. '/image')) {
        $row['image'] = substr($image, strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'.'image/'));
    } else {
        $row['image'] = '';
    }
    // Xử lý liên kết tĩnh
    $row['alias'] = $nv_Request->get_title('alias', 'post', '');
    $row['alias'] = empty($row['alias']) ? change_alias($row['tentheloai']) : change_alias($row['alias']);
    if (!empty($page_config['alias_lower'])) {
        $row['alias'] = strtolower($row['alias']);
    }
    $row['alias'] = nv_substr($row['alias'], 0, 250);
  
     // Kiểm tra trùng
     $sql = 'SELECT idtheloai FROM ' . NV_PREFIXLANG . '_' . $module_data . '_theloai WHERE alias=' . $db->quote($row['alias']);

     if ($id) {
         $sql .= ' AND idtheloai!=' . $id;
     }
     
     $is_exists = $db->query($sql)->fetchColumn();

    if (empty($row['tentheloai'])) {
        $error = $lang_module['empty_title'];
    } elseif ($is_exists) {
        $error = $lang_module['erroralias'];
    }

    if ($id) {
        $_sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_theloai SET
        tentheloai = :tentheloai, alias = :alias, image = :image,
        update_time = ' . NV_CURRENTTIME . ' WHERE idtheloai =' . $id;
    } else {

        $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_theloai (
            tentheloai, alias, image, add_time, update_time
            ) VALUES (
            :tentheloai, :alias, :image, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ')';
    }
    //var_dump($_sql);die;
    try {
        $sth = $db->prepare($_sql);
        $sth->bindParam(':tentheloai', $row['tentheloai'], PDO::PARAM_STR);
        $sth->bindParam(':alias', $row['alias'], PDO::PARAM_STR);
        $sth->bindParam(':image', $row['image'], PDO::PARAM_STR);
        $sth->execute();

        if ($sth->rowCount()) {
            if ($id) {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit', 'idtheloai: ' . $id, $admin_info['userid']);
            } else {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Add', ' ', $admin_info['userid']);
            }

            $nv_Cache->delMod($module_name);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name  . '&' . NV_OP_VARIABLE . '=' . $op);
        } else {
            $error = $lang_module['errorsave'];
        }
    } catch (PDOException $e) {
        trigger_error(print_r($e, true));
        $error = $lang_module['errorsave'];
    }

}
$xtpl = new XTemplate('cat.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('UPLOAD_CURRENT', $currentpath);
$xtpl->assign('UPLOAD_PATH', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('FORM_ACTION', $action);
$xtpl->assign('CAPTION', $page_title);
$xtpl->assign('DATA', $row);

$number = 0;
$CatName = array();
foreach ($_rows as $getCat) {
    $number += 1;
    $getCat['add_time'] = nv_date('m/d/Y H:i:s',  $getCat['add_time']);
    $getCat['update_time'] = nv_date('m/d/Y H:i:s',  $getCat['update_time']);
    $xtpl->assign('NUMBER', $number);
    $xtpl->assign('TEST1', $getCat);
    $link_delete = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_cat&amp;id=' . $getCat['idtheloai'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $link_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cat&amp;id=' . $getCat['idtheloai'] . '&amp;checkss=' . md5($global_config['sitekey'] . session_id());
    $xtpl->assign('ROW', $link_delete);
    $xtpl->assign('ROW1', $link_edit);
    $CatName[] = $getCat['tentheloai'];
    $xtpl->parse('main.loop1');
}

if (empty($row['alias'])) {
    $xtpl->parse('main.get_alias');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
