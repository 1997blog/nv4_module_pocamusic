<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_theloai';
$result = $db->query($sql);
while ($row = $result->fetch()) {
    $array_item[$row['idtheloai']] = [
        'key' => $row['idtheloai'],
        'title' => $row['tentheloai'],
        'alias' => $row['alias']
    ];
}
