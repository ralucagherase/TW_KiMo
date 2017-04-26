<?php
  session_start();
  if(isset($_SESSION['user_session'])!="")
  {
    header("Location: home.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KidMonitor</title>
</head>
<body><link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<section class="signin-section">
    <div class="signin-form">
        <div class="container">
            <form class="form-signin" method="post" id="login-form">
                <h2 class="form-signin-heading">Log In to KidMonitor</h2>
                <hr />
                <div id="error"><!-- error will be shown here ! --></div>
                <div class="alert alert-info">
                    <ul>
                        <li>useremail : tester@testing.test</li>
                        <li>password  : 12345678</li>
                    </ul>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                    <span id="check-e"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                </div>
                <hr />
                <div class="form-group">
                    <button id="btn-login" class="btn btn-default" type="submit" name="btn-login"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/validation.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/login-script.js"></script>
</body>
</html>