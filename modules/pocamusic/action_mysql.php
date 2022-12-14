<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */

if (! defined('NV_IS_FILE_MODULES')) {
    die('Stop!!!');
}

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_theloai;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_baihat;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_casi;";

$sql_create_module = $sql_drop_module;


$sql_create_module[] ="CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_baihat (
    idBaihat int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    idTheloai int(11) NOT NULL DEFAULT 0,
    idCasi int(11) NOT NULL DEFAULT 0,
    tenBaihat varchar(255) NOT NULL DEFAULT '',
    add_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    update_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    part varchar(255) NOT NULL DEFAULT '',
    img varchar(255) NOT NULL DEFAULT '',
    publish int(11) NOT NULL DEFAULT 1,
    PRIMARY KEY (idBaihat),
    KEY idTheloai (idTheloai)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql_create_module[] ="CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_casi (
    IdCasi int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    TenCasi varchar(255) NOT NULL DEFAULT '',
    Add_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    Update_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (IdCasi)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql_create_module[] ="CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_theloai (
    IdTheLoai int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    tentheloai varchar(255) NOT NULL DEFAULT '',
    alias varchar(250) NOT NULL,
    image varchar(255) DEFAULT '',
    add_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    update_time int(11) UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (IdTheLoai),
    UNIQUE (tentheloai),
	UNIQUE KEY alias (alias)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// CREATE TABLE `test`.`a` ( `Id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `tenTheLoai` VARCHAR(255) NOT NULL DEFAULT '' , 
// PRIMARY KEY (`Id`), UNIQUE (`tenTheLoai`)) ENGINE = MyISAM;

// Comments
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'perpagecomm', '5')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timeoutcomm', '360')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowattachcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'alloweditorcomm', '0')";
 
// T??? NukeViet 4.5.00 b??? sung
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha_area_comm', '1')";