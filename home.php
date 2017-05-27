<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
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
<section class="map">
    <div id="map"></div>
</section>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_KsHe3ZXqIKApA-LUAnzFeZPs1W_9P0Y&callback=initMap"
        async defer></script>
<script src="assets/js/main.js"></script>
</body>
</html>