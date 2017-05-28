<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 28.05.2017
 * Time: 10:35
 */
session_start();
require_once 'dbconfig.php';

$nume_copil       = $_POST['nume_copil'];
$prenume_copil    = $_POST['prenume_copil'];
$zi_nastere_copil = $_POST['zi_nastere_copil'];
$prenume_mama     = $_POST['prenume_mama'];
$prenume_tata     = $_POST['prenume_tata'];
$latitudine       = $_POST['latitudine'];
$longitudine      = $_POST['longitudine'];
$user_email       = $_SESSION['user_session_email'];

try {
    $sql = "INSERT INTO tbl_childs(
                          nume_copil,
                          prenume_copil,
                          zi_nastere_copil,
                          prenume_mama,
                          prenume_tata,
                          latitudine,
                          longitudine,
                          user_email)
            VALUES(:nume_copil,
                  :prenume_copil,
                  :zi_nastere_copil,
                  :prenume_mama,
                  :prenume_tata,
                  :latitudine,
                  :longitudine,
                  :user_email)
    ";
    $stmt = $db_con->prepare($sql);
    $stmt->execute(array(
        ":nume_copil"=>$nume_copil,
        ":prenume_copil"=>$prenume_copil,
        ":zi_nastere_copil"=>$zi_nastere_copil,
        ":prenume_mama"=>$prenume_mama,
        ":prenume_tata"=>$prenume_tata,
        ":latitudine"=>$latitudine,
        ":longitudine"=>$longitudine,
        ":user_email"=>$user_email
    ));
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
