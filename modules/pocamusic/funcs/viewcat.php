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

$contents = call_user_func( 'view_detail_cat_music',$listMusic);

if ($page > 1) {
    $page_title .= NV_TITLEBAR_DEFIS . $lang_global['page'] . ' ' . $page;
}
		
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';