<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE ){
    header("location: homeRedirect.php");
}
$endSession = FALSE;
if( !empty($_SESSION)){
//    echo $_SESSION['invalidLoginCredentials'];
    foreach ($_SESSION as $index => $value){
        if( $index == 'invalidLoginCredentials'){
            echo $index ."=>".$value."<br/>";
            $endSession = TRUE;
            unset($_SESSION[$index]);
        }
    }
    if( $endSession == TRUE){
        session_destroy();
        session_start();
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <?php
            include 'header.php';
        ?>
        <form action="confirmLogin.php" method="POST">
            <table style="width:50">
                <tr>
                    <td>userid:</td>
                    <td><input type="text" name="userid"></td>
                </tr>
                <tr>
                    <td>password:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td><input type="submit"  name="submit" value="Login!"/></td>
                    <td><a href="registration.php">register new user</a>
                </tr>
            </table>
        </form>
    </body>
</html>
