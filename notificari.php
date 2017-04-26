<?php
/**
 * Created by PhpStorm.
 * User: IRINA
 * Date: 25.04.2017
 * Time: 19:31
 */
session_start();
if(!isset($_SESSION['user_session']))
{
    header("Location: index.php");
}
include_once 'database/dbconfig.php';
$tblUsers = $db_con->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$tblUsers->execute(array(":uid"=>$_SESSION['user_session']));
$rowUsers = $tblUsers->fetch(PDO::FETCH_ASSOC);

$tblProfiles = $db_con->prepare("SELECT * FROM tbl_profiles WHERE user_email='".$rowUsers['user_email']."'");
$tblProfiles->execute();
$rowProfiles = $tblProfiles->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>KidMonitor</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <a href="index.html"><h1>KidMonitor</h1></a>
    <strong>
        Hello
        <?php
        if($rowProfiles['prenume']) {
            echo $rowProfiles['prenume'];
        }else{
            echo $rowUsers['user_email'];
        }
        ?>
    </strong>
    <nav>
        <ul>
            <li><a href="profile.php">Profilul meu</a></li>
            <li><a href="vezi-copilul.php">Vezi Copilul</a></li>
            <li><a href="adauga-copil.php">Adauga un Copil</a></li>
            <li class="right"><a href="database/logout.php">Logout</a></li>
            <li class="right"><a href="notificari.php">Notificari</a></li>
        </ul>
    </nav>
</header>

<section class="profile-section">
    <div class="profile-section-wrap">
        <h2>Notificari</h2>
        <h4>Copil 1</h4>
        <p>Nume:</p>
        <p>Prenume:</p>
        <p>Vezi Locatia Copilului</p>
        <hr />
        <h4>Copil 2</h4>
        <p>Nume:</p>
        <p>Prenume:</p>
        <p>Vezi Locatia Copilului</p>
        <hr />
    </div>
</section>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
