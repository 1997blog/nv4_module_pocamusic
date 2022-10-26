<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/31/2009 0:51
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}


function getAllMusic()
{
    global $module_data, $db, $module_upload;

    $data = array();

    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
        . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai ORDER BY idBaihat ASC';

    // die($sql);
  //  
    try {
        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
            $img = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'.'image/'.  $img;
           
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "image" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}

function getAllSinger()
{
    global $module_data, $db;

    $data = array();

    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';

    $sql = 'SELECT * FROM ' . $casi;
    try {
        $query = $db->query($sql);
        while (list($IdCasi, $TenCasi, $Add_time, $Update_time) = $query->fetch(3)) {
            $data[] = array(
                "IDCASI" => $IdCasi,
                "TENCASI" => $TenCasi,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $Add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $Update_time)
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}

function getAllCat()
{
    global $module_data, $db;

    $data = array();

    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

    $sql = 'SELECT 	* FROM ' . $theloai;
    try {
        $query = $db->query($sql);
        while (list($IdTheLoai, $tenTheLoai, $Add_time, $Update_time) = $query->fetch(3)) {
            $data[] = array(
                "IDTHELOAI" => $IdTheLoai,
                "TENTHELOAI" => $tenTheLoai
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}

function showDataSong($number)
{
    global $module_data, $db;



    $sql = 'SELECT bh.idBaihat, cs.TenCasi, tl.tenTheLoai, bh.tenBaihat,bh.add_time, bh.update_time, bh.part, bh.img, bh.publish  ' .
        'FROM ' . NV_PREFIXLANG . '_' . $module_data .'_baihat bh 
        INNER JOIN '.NV_PREFIXLANG . '_' . $module_data . '_casi cs ON bh.idCasi = cs.idCasi 
        INNER JOIN '.NV_PREFIXLANG . '_' . $module_data . '_theloai tl ON bh.idTheloai = tl.IdTheLoai 
        WHERE idBaihat = ' . $number . ' ORDER BY idBaihat ASC';
    
        $result = $db->query($sql);
    $data = [];

    try {
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $result->fetch(3)) {
            $add_time = gmdate("Y/m/d H:i:s", $add_time);
            $update_time= gmdate("Y/m/d H:i:s", $update_time);
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => $add_time,
                "UPDATETIME" =>   $update_time,
                "PART" => $part,
                "IMAGE" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}

function showDataSinger($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $data = array();
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $sql = 'SELECT * FROM ' . $casi . ' WHERE IdCasi = ' . $id;
    try {
        $query = $db->query($sql);
        while (list($IdCasi, $TenCasi, $Add_time, $Update_time) = $query->fetch(3)) {
            $data[] = array(
                "IDCASI" => $IdCasi,
                "TENCASI" => $TenCasi,
                "ADDTIME" => $Add_time,
                "UPDATETIME" => $Update_time
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
    return $data;
}

function showDataCat($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $data = array();
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';
    $sql = 'SELECT * FROM ' . $theloai . ' WHERE IdTheLoai = ' . $id;
    try {
        $query = $db->query($sql);
        while (list($IdTheLoai, $tenTheLoai, $Add_time, $Update_time) = $query->fetch(3)) {
            $data[] = array(
                "IDTHELOAI" => $IdTheLoai,
                "TENTHELOAI" => $tenTheLoai,
                "ADDTIME" => $Add_time,
                "UPDATETIME" => $Update_time
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
    return $data;
}


function showDataSearchShow($key)
{
    global $module_data, $db;

    $data = array();

    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
        . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai WHERE tenBaihat LIKE "%' . $key .'%" ORDER BY idBaihat ASC';

    try {
        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "IMAGE" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}

function insertSong($idcasi, $idtheloai, $tenbaihat, $part, $img, $publish)
{
    global $module_data, $db;
    $value['idcasi'] = $idcasi;
    $value['idtheloai'] = $idtheloai;
    $value['tenbaihat'] = $tenbaihat;
    $value['thoigianthem'] = Time();
    $value['thoigiancapnhat'] = Time();
    $value['part'] = $part;
    $value['img'] = $img;
    $value['publish'] = $publish;

    $baihat = NV_PREFIXLANG . "_" . $module_data . "_baihat";
    $sth = $db->prepare('INSERT INTO ' . $baihat . '(idCasi,idTheloai,tenBaihat,add_time,update_time,part,img,publish) VALUES(:a,:b,:c,:d,:e,:f,:g,:h)');
    $sth->bindParam(':a', $value['idcasi'], PDO::PARAM_INT);
    $sth->bindParam(':b', $value['idtheloai'], PDO::PARAM_INT);
    $sth->bindParam(':c', $value['tenbaihat'], PDO::PARAM_STR);
    $sth->bindParam(':d', $value['thoigianthem'], PDO::PARAM_INT);
    $sth->bindParam(':e', $value['thoigiancapnhat'], PDO::PARAM_INT);
    $sth->bindParam(':f', $value['part'], PDO::PARAM_STR);
    $sth->bindParam(':g', $value['img'], PDO::PARAM_STR);
    $sth->bindParam(':h', $value['publish'], PDO::PARAM_STR);
    $sth->execute();
    return true;
}

function insertSinger($tencasi)
{
    global $module_data, $db;
    $value['tencasi'] = $tencasi;
    $value['thoigianthem'] = Time();
    $value['thoigianupdate'] = Time();

    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';

    $sql = 'INSERT INTO ' . $casi . ' ( TenCasi, Add_time, Update_time ) VALUES ( :a, :b, :c )';
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $value['tencasi']);
    $sth->bindParam(':b', $value['thoigianthem']);
    $sth->bindParam(':c', $value['thoigianupdate']);
    $sth->execute();
}

function insertCat($tentheloai)
{
    global $module_data, $db;
    $value['tentheloai'] = $tentheloai;
    $value['thoigianthem'] = Time();
    $value['thoigianupdate'] = Time();

    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

    $sql = 'INSERT INTO ' . $theloai . ' ( tenTheLoai, Add_time, Update_time ) VALUES ( :a, :b, :c )';
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $value['tentheloai']);
    $sth->bindParam(':b', $value['thoigianthem']);
    $sth->bindParam(':c', $value['thoigianupdate']);
    $sth->execute();
    return true;
}

function editSong($id, $idtheloai, $idcasi, $tenbaihat, $part, $img, $publish)
{
    // die($id);
    global $module_data, $db;
    $value['idtheloai'] = $idtheloai;
    $value['idcasi'] = $idcasi;
    $value['tenbaihat'] = $tenbaihat;
    $value['thoigiancapnhat'] = Time();
    $value['part'] = $part;
    $value['image'] = $img;
    $value['publish'] = $publish;

    $baihat = NV_PREFIXLANG . "_" . $module_data . "_baihat";
    $sql = 'UPDATE ' . $baihat . ' SET idTheloai = :a, idCasi= :b, tenBaihat = :c, update_time = :d, part = :e , img = :f, publish = :g ' . ' WHERE idBaihat = ' . $id;
    // die($sql);
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $value['idtheloai']);
    $sth->bindParam(':b', $value['idcasi']);
    $sth->bindParam(':c', $value['tenbaihat']);
    $sth->bindParam(':d', $value['thoigiancapnhat']);
    $sth->bindParam(':e', $value['part']);
    $sth->bindParam(':f', $value['image']);
    $sth->bindParam(':g', $value['publish']);
    $sth->execute();
}


function editSinger($number, $tencasi)
{
    global $module_data, $db;
    $id = (int)$number;
    $value['tencasi'] = $tencasi;
    $value['thoigiancapnhat'] = Time();

    $casi = NV_PREFIXLANG . "_" . $module_data . "_casi";
    $sql = 'UPDATE ' . $casi . ' SET TenCasi = :a, Update_time = :b' . ' WHERE IdCasi = ' . $id;
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $value['tencasi']);
    $sth->bindParam(':b', $value['thoigiancapnhat']);
    $sth->execute();
}

function editCat($number, $tentheloai)
{
    global $module_data, $db;
    $id = (int)$number;
    $value['tentheloai'] = $tentheloai;
    $value['thoigiancapnhat'] = Time();

    $theloai = NV_PREFIXLANG . "_" . $module_data . "_theloai";
    $sql = 'UPDATE ' . $theloai . ' SET tenTheLoai = :a, Update_time = :b' . ' WHERE IdTheLoai = ' . $id;
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $value['tentheloai']);
    $sth->bindParam(':b', $value['thoigiancapnhat']);
    $sth->execute();
}

function deleteSong($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $baihat = NV_PREFIXLANG . "_" . $module_data . "_baihat";
    $sql = 'DELETE FROM ' . $baihat . ' WHERE ' . $baihat . '.idBaihat = ' . $id;
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $id);
    $sth->execute();
    return true;
}

function deleteSinger($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $sql = 'DELETE FROM ' . $casi . ' WHERE ' . $casi . '.IdCasi = :a';
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $id);
    $sth->execute();
    return true;
}

function deleteCat($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';
    $sql = 'DELETE FROM ' . $theloai . ' WHERE ' . $theloai . '.IdTheLoai  = :a';
    $sth = $db->prepare($sql);
    $sth->bindParam(':a', $id);
    $sth->execute();
    return true;
}

function getIdPublish($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';
    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
        . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai WHERE publish = ' . $id . ' ORDER BY idBaihat ASC';
    // die($sql);
    try {

        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "IMAGE" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
    return $data;
}

function getIdSinger($number)
{
    global $module_data, $db;
    $id = (int)$number;
    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';
    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
    . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai WHERE ' . $casi . '.idCasi = ' . $id . ' ORDER BY idBaihat ASC';
    // die($sql);
    try {
        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "IMAGE" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
    return $data;
}

function getIdSingerPublish($numberSinger, $numberPublish)
{
    global $module_data, $db;
    $idSinger = (int)$numberSinger;
    $idPublish = (int)$numberPublish;
    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';
    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
        . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai WHERE ' . $casi . '.idCasi = ' . $idSinger . ' and publish = ' . $idPublish . ' ORDER BY idBaihat ASC';
    try {

        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $publish) = $query->fetch(3)) {
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
    return $data;
}

function getIdPublishShow()
{
    global $module_data, $db;

    $data = array();

    $baihat = NV_PREFIXLANG . '_' . $module_data . '_baihat';
    $casi = NV_PREFIXLANG . '_' . $module_data . '_casi';
    $theloai = NV_PREFIXLANG . '_' . $module_data . '_theloai';

    $sql = 'SELECT ' . $baihat . '.idBaihat, ' . $casi . '.TenCasi, ' . $theloai . '.tenTheLoai, ' . $baihat . '.tenBaihat, '
        . $baihat . '.add_time, ' . $baihat . '.update_time, ' . $baihat . '.part, ' . $baihat . '.img, ' . $baihat . '.publish ' .
        'FROM ' . $baihat .
        ' INNER JOIN ' . $casi . ' ON ' . $baihat . '.idCasi = ' . $casi . '.idCasi ' .
        ' INNER JOIN ' . $theloai . ' ON ' . $baihat . '.idTheloai = ' . $theloai . '.IdTheLoai WHERE publish = 1 ORDER BY idBaihat ASC';

    // die($sql);

    try {
        $query = $db->query($sql);
        while (list($idBaihat, $TenCasi, $tenTheLoai, $tenBaihat, $add_time, $update_time, $part, $img, $publish) = $query->fetch(3)) {
            $data[] = array(
                "IDBAIHAT" => $idBaihat,
                "TENCASI" => $TenCasi,
                "TENTHELOAI" => $tenTheLoai,
                "TENBAIHAT" => $tenBaihat,
                "ADDTIME" => gmdate("Y/m/d H:i:s", $add_time),
                "UPDATETIME" =>  gmdate("Y/m/d H:i:s", $update_time),
                "PART" => $part,
                "IMAGE" => $img,
                "PUBLISH" => $publish
            );
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    return $data;
}


