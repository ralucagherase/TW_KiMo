<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 25.04.2017
 * Time: 22:39
 */
session_start();
session_unset();
session_destroy();
header("Location: /index.php");
exit
?>
