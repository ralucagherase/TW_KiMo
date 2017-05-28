<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 28.05.2017
 * Time: 11:15
 */
session_start();
require_once 'dbconfig.php';

$tblChilds = $db_con->prepare("SELECT * FROM tbl_childs WHERE user_email='".$_SESSION['user_session_email']."'");
$tblChilds->execute();
$array = $tblChilds->fetchAll( PDO::FETCH_ASSOC );
$json = json_encode( $array );
echo $json;
?>