<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 27.04.2017
 * Time: 00:15
 */
ession_start();
require_once 'dbconfig.php';

$nume       = $_POST['nume'];
$prenume    = $_POST['prenume'];
$zi_nastere = $_POST['zi_nastere'];
$user_email = $_POST['user_email'];

try {
    $sql = "UPDATE  `tbl_profiles`
            SET     `nume`=:nume,
                    `prenume`=:prenume,
                    `zi_nastere`=:zi_nastere
            WHERE   `user_email`=:user_email";
    $stmt = $db_con->prepare($sql);
    $stmt->execute(array(
        ":nume"=>$nume,
        ":prenume"=>$prenume,
        ":zi_nastere"=>$zi_nastere,
        ":user_email"=>$user_email
    ));
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
