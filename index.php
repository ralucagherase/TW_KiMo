<?php
  session_start();
  if(isset($_SESSION['user'])!="")
  {
    header("Location: home.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>KidMonitor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">

</head>
<body>
<div class="container">
    <section class="signin-section row">
        <div class="col-md-12">
            <h2 class="form-signin-heading">Log In to KidMonitor</h2>
            <hr />
        </div>
    </section>
    <section class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="error"><!-- error will be shown here ! --></div>
            <div class="alert alert-info">
                <ul>
                    <li>useremail : tester@testing.test</li>
                    <li>password  : 12345678</li>
                </ul>
            </div>
            <form class="form-signin" method="post" id="login-form">
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
                    <a href="http://localhost/KiMo/signup.php" class="btn btn-link">Sign Up</a>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="assets/js/jquery-3.2.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/login-script.js"></script>
</body>
</html>