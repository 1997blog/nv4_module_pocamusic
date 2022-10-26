<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 04/18/2017 09:47
 */

if (!defined('NV_IS_MOD_MUSIC')) {
    die('Stop!!!');
}


$db_slave->sqlreset()
	->select('bh.tenBaihat, bh.part, bh.img, cs.tencasi, bh.idtheloai')
	->from(NV_PREFIXLANG . '_' . $module_data . '_baihat bh') 
	->join('INNER JOIN  '.NV_PREFIXLANG . '_' . $module_data . '_casi cs ON cs.idcasi = bh.idcasi')
	->where('bh.idtheloai='.$catid)
	->order('bh.idtheloai DESC');
$result = $db_slave->query($db_slave->sql());
$listMusic = [];
while ($item = $result->fetch()) {
	$item['img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/image/'. $item['img'];
	$item['part'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/music/'. $item['part'];
	$listMusic[] = $item;
}

// Kiểm tra module có sử dụng chức năng comment và module comment được kích hoạt
if (isset($site_mods['comment']) and isset($module_config[$module_name]['activecomm'])) {
    $id = $catid; // Chỉ ra ID của đối tượng được bình luận
    $area = $module_info['funcs'][$op]['func_id']; // Chỉ ra phạm vi (loại, vị trí...) của đối tượng bình luận
 
    define('NV_COMM_ID', $id); // Định nghĩa hằng này để module comment hiểu
    define('NV_COMM_AREA', $area); // Định nghĩa hằng này để module comment hiểu
 
    // Kiểm tra quyền bình luận
    $allowed = $module_config[$module_name]['allowed_comm'];
    if ($allowed == '-1') {
        // Quyền bình luận theo đối tượng
        //$allowed = $news_contents['allowed_comm'];
        $allowed = 4;
    }
    require_once NV_ROOTDIR . '/modules/comment/comment.php';
    $checkss = md5($module_name . '-' . $area . '-' . $id . '-' . $allowed . '-' . NV_CACHE_PREFIX);
 
    $content_comment = nv_comment_module($module_name, $checkss, $area, $id, $allowed, 1);
} else {
    $content_comment = '';
}

$contents = call_user_func( 'view_detail_cat_music',$listMusic, $content_comment);

if ($page > 1) {
    $page_title .= NV_TITLEBAR_DEFIS . $lang_global['page'] . ' ' . $page;
}
		
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';