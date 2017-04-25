<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 25.04.2017
 * Time: 22:39
 */
session_start();
unset($_SESSION['user_session']);

if(session_destroy())
{
    header("Location: ../index.html");
}
?>
