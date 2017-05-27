<?php
/**
 * Created by PhpStorm.
 * User: IRINA
 * Date: 27.05.2017
 * Time: 20:11
 */
session_start();
require_once 'dbconfig.php';

if(isset($_POST['btn-signup']))
{
    $user_email     = trim($_POST['user_email']);
    $user_password  = trim($_POST['password']);
    $user_confirm_password  = trim($_POST['confirm_password']);

    if($user_password !== $user_confirm_password){
        echo "passwords are not the same."; // passwords are not the same
        exit;
    }

    $password       = md5($user_password);

    try
    {
        $stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
        $stmt->execute(array(":email"=>$user_email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            $stmt = $db_con->prepare("INSERT INTO tbl_users(user_email, user_password) VALUES (:email, :password)");
            $stmt->execute(array(
                ":email" => $user_email,
                ":password" => $password
            ));

            $_SESSION['user'] = [
                'user_id' => $db_con->lastInsertId(),
                'user_email' => $user_email,
                'user_password' => $password
            ];
            echo "ok"; // log in
            exit;
        }
        else{
            echo "this email is in use."; // wrong details
            exit;
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
}
?>
