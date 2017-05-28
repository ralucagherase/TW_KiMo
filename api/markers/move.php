<?php
/**
 * Created by PhpStorm.
 * User: IRINA
 * Date: 28.05.2017
 * Time: 17:21
 */
require_once '../../database/dbconfig.php';

$deltaLat = rand(1, 10)/1000000;
$deltaLng = rand(1, 10)/1000000;

$sign = rand(0, 1);
if($sign == 1){
    $deltaLat = (-1) * $deltaLat;
}
$sign = rand(0, 1);
if($sign == 1){
    $deltaLng = (-1) * $deltaLng;
}

$lat = floatval($_POST['lat']) + $deltaLat;
$lng = floatval($_POST['lng']) + $deltaLng;

$markers = $db_con->prepare("UPDATE tbl_markers SET lat=:lat, lng=:lng WHERE id=:id");
$res = $markers->execute([
    ':id' => $_POST['id'],
    ':lat' => $lat,
    ':lng' => $lng
]);

if($res){
    $response = [
        'lat' => $lat,
        'lng' => $lng
    ];
}else{
    $response = [
        'lat' => $_POST['lat'],
        'lng' => $_POST['lng']
    ];
}

echo json_encode($response);
exit;