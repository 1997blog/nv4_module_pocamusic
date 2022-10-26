<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Jul 11, 2010 8:43:46 PM
 */

if (!defined('NV_IS_MOD_MUSIC')) {
    die('Stop!!!');
}

/**
 * viewcat_list_music()
 *
 * @param array  $allMusic
 * @param int    $catid
 * @param string $generate_page
 * @return string
 */
function viewcat_list_music($allMusic, $catid, $generate_page)
{
    global $site_mods, $module_name, $module_upload, $lang_module, $module_config, $module_info, $catid, $page;

    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
	$i = 1;
	foreach ($allMusic as $cat_song) {
		$cat_song['idtheloai'] = $i++;
		$xtpl->assign('CAT', $cat_song);
		$xtpl->parse('main.loop');
	}

    if (!empty($generate_page)) {
        $xtpl->assign('GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.generate_page');
    }

    $xtpl->parse('main');

    return $xtpl->text('main');
}

/**
 * view_detail_cat_music()
 *
 * @param array  $allMusic
 * @param int    $catid
 * @param string $generate_page
 * @return string
 */
function view_detail_cat_music($listMusic)
{
    global $site_mods, $module_name, $module_upload, $lang_module, $module_config, $module_info, $catid, $page;

    $xtpl = new XTemplate('viewcat.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
	$i = 1;
	
	
	$json_allMusic = json_encode($listMusic);
	
	$xtpl->assign('JSON', $json_allMusic);
	
	foreach ($listMusic as $list_song) {
	
		$list_song['idbaihat'] = $i++;
		$xtpl->assign('LISTSONG', $list_song);
		$xtpl->parse('main.loop');
	}
	
    $xtpl->parse('main');
    return $xtpl->text('main');
}