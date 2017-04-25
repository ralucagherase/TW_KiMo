<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 25.04.2017
 * Time: 22:02
 */
$db_host = "localhost";
$db_name = "kidmonitor_db";
$db_user = "root";
$db_pass = "root";

try{
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>
