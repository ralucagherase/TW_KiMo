<?php
/**
 * Created by PhpStorm.
 * User: IRINA
 * Date: 27.05.2017
 * Time: 20:08
 */
session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>KidMonitor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
    <section class="signin-section row">
        <div class="col-md-12">
            <h2 class="form-signin-heading">Sign Up to KidMonitor</h2>
            <hr />
        </div>
    </section>
    <section class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="error"><!-- error will be shown here ! --></div>
            <form class="form-signin" method="post" id="signup-form">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                    <span id="check-e"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" />
                </div>
                <hr />
                <div class="form-group">
                    <a href="http://localhost/KiMo/index.php" class="btn btn-link"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</a>
                    <button id="btn-signup" class="btn btn-default" type="submit" name="btn-signup">Sign Up</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/signup-script.js"></script>
</body>
</html>