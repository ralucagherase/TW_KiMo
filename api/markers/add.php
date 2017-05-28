<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 28.05.2017
 * Time: 16:31
 */
require_once '../../database/dbconfig.php';

$markers = $db_con->prepare("INSERT INTO tbl_markers(id, user_id, type, title, lat, lng, movable) VALUES(:id, :user_id, :type, :title, :lat, :lng, :movable)");
echo $markers->execute([
    ':id' => $_POST['id'],
    ':user_id' => $_POST['user_id'],
    ':type' => $_POST['marker_type'],
    ':title' => $_POST['title'],
    ':lat' => $_POST['lat'],
    ':lng' => $_POST['lng'],
    ':movable' => $_POST['marker_movable'],
]);
exit;