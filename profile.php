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
            <li class="right"><a href="database/logout.php">Logout</a></li>
            <li class="right"><a href="notificari.php">Notificari</a></li>
        </ul>
    </nav>
</header>

<section class="profile-section">
    <div class="profile-section-wrap">
        <form class="form-profile" method="post" id="profile-form">
            <p>
                <label for="nume">Nume:</label>
                <input id="nume" type="text" name="nume" value="<?php echo $rowProfiles['nume']; ?>" />
            </p>
            <p>
                <label for="prenume">Prenume:</label>
                <input id="prenume" type="text" name="prenume" value="<?php echo $rowProfiles['prenume']; ?>" />
            </p>
            <p>
                <label for="zi_nastere">Zi de nastere:</label>
                <input id="zi_nastere" type="text" name="zi_nastere" value="<?php echo $rowProfiles['zi_nastere']; ?>" />
            </p>
            <p>
                <label for="copii_inregistrati">Copii inregistrati:</label>
                <!-- <input id="copii_inregistrati" type="text" name="copii_inregistrati" value="0" /> -->
            </p>
            <p>
                <label for="user_email">Email:</label>
                <input id="user_email" class="form-profile__email" type="email" name="user_email" value="<?php echo $rowProfiles['user_email']; ?>" />
            </p>
            <button id="btn-submit" class="btn btn-default" type="submit" name="btn-submit">Save</button>
        </form>
    </div>
</section>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/validation.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/profile-script.js"></script>
</body>
</html>
