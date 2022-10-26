<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if (!defined('NV_IS_MOD_MUSIC')) {
    die('Stop!!!');
}


require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];
$per_page = 10;
$page = $nv_Request->get_int('page', 'get', 1);
$page_url = $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$contents = '';
$allMusic = [];


if ($page > 1) {
    $page_url .= '&amp;' . NV_OP_VARIABLE . '=page-' . $page;

    /*
     * @link https://github.com/nukeviet/nukeviet/issues/2990
     * Một số kiểu hiển thị không được đánh page
     */
    if (in_array($viewcat, $no_generate, true)) {
        nv_redirect_location($base_url);
    }
}


$db_slave->sqlreset()
	->select('COUNT(*)')
	->from(NV_PREFIXLANG . '_' . $module_data.'_theloai' );
$num_items = $db_slave->query($db_slave->sql())->fetchColumn();
	
$db_slave->sqlreset()
	->from(NV_PREFIXLANG . '_' . $module_data . '_theloai') 
	->select('*')
	->order('idtheloai DESC')
	->limit($per_page)
	->offset(($page - 1) * $per_page);

$result = $db_slave->query($db_slave->sql());



while ($item = $result->fetch()) {
    $item['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'.'image/'. $item['image'];
    $item['add_time'] = nv_date('m/d/Y', $item['add_time']);
    $item['update_time'] = nv_date('m/d/Y', $item['update_time']);
    $item['link'] = $global_array_theloai[$item['idtheloai']]["link"]. $global_config['rewrite_exturl'];;
	$allMusic[] = $item;
}

 $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
$contents = call_user_func( 'viewcat_list_music',$allMusic, 0, ($page - 1) * $per_page, $generate_page);

if ($page > 1) {
    $page_title .= NV_TITLEBAR_DEFIS . $lang_global['page'] . ' ' . $page;
}
		
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';