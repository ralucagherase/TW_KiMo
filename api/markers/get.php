<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 28.05.2017
 * Time: 16:25
 */

require_once '../../database/dbconfig.php';

$markers = $db_con->prepare("SELECT * FROM tbl_markers WHERE user_id=:id");
$markers->execute([':id' => $_GET['id']]);
$array = $markers->fetchAll( PDO::FETCH_ASSOC );
$json = json_encode( $array );
echo $json;
exit;