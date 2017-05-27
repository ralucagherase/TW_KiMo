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
    <a href="index.php"><h1>KidMonitor</h1></a>
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
            <li class="right"><a href="logout.php">Logout</a></li>
            <li class="right"><a href="notificari.php">Notificari</a></li>
        </ul>
    </nav>
</header>

<section class="profile-section">
    <div class="profile-section-wrap">
        <h2>Adauga un Copil</h2>
        <form class="form-add-child" method="post" id="add-child-form">
            <p>
                <label for="nume_copil">Nume:</label>
                <input id="nume_copil" type="text" name="nume_copil" value="" />
            </p>
            <p>
                <label for="prenume_copil">Prenume:</label>
                <input id="prenume_copil" type="text" name="prenume_copil" value="" />
            </p>
            <p>
                <label for="zi_nastere_copil">Zi de nastere:</label>
                <input id="zi_nastere" type="text" name="zi_nastere" value="" />
            </p>
            <p>
                <label for="prenume_mama">Numele mamei:</label>
                <input id="prenume_mama" type="text" name="prenume_mama" value="" />
            </p>
            <p>
                <label for="prenume_tata">Numele tatalui:</label>
                <input id="prenume_tata" type="text" name="prenume_tata" value="" />
            </p>
            <p>Locatia Copilului</p>
            <p>
                <label for="latitudine">Lat.:</label>
                <input id="latitudine" type="text" name="latitudine" value="" />
            </p>
            <p>
                <label for="longitudine">Lon.:</label>
                <input id="longitudine" type="text" name="longitudine" value="" />
            </p>
            <button id="btn-add-child" class="btn btn-default" type="submit" name="btn-add-child">Save</button>
        </form>
    </div>
</section>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>