<?php
    session_start();
?>
<html>
    <head>
        <title>
            password change successful
        </title>
    </head>
    <body>
        <form id="resend" method="POST" action="changePassword.php">
<?php
    if( isset( $_SESSION['loggedin'] ) && $_SESSION['loggedin'] == TRUE ){
        $password_flag = FALSE;
        $current_password_flag = FALSE;
        if( isSet($_POST['password']) && isSet($_POST['rpassword']) && $_POST['password'] != NULL && $_POST['rpassword'] != NULL){
            $password_length = strlen($_POST['password']);
            if( $_POST['password'] != $_POST['rpassword'] ){
                echo "<input type='hidden' name='password_match_error' value='password and re-enter password must have same value' />";
            }
            elseif ($password_length < 6 || $password_length > 10 ) {
                echo "<input type='hidden' name='password_length_error' value='password length must be between 6 and 10' />";
            }
            else{
                $password_flag = true ;
            }
        }
        $dbhandler = new PDO("mysql:host=127.0.0.1;dbname=voting;charset=utf8" ,'user_priyank' ,'1234');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        if( isset($_SESSION['voterId']) && !empty($_SESSION['voterId'] ) ){
            $sql = "select password from voter where voterId=".$_SESSION['voterId'];
            $query = $dbhandler->query($sql);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            $current_password = $fetchedResult['password'];
            if( $current_password == $_POST['currentPassword'] ){
                $current_password_flag = TRUE;
            }
            else{
                echo "<input type='hidden' name='incorrect current password' value='current password is invalid' />";
            }
        }
        elseif(isset ($_SESSION['candidateId']) && !empty( $_SESSION['candidateId']) ){
            $sql = "select password from candidate where candidateId=".$_SESSION['candidateId'];
            $query = $dbhandler->query($sql);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            $current_password = $fetchedResult['password'];
            if( $current_password == $_POST['currentPassword'] ){
                $current_password_flag = TRUE;
            }
            else{
                echo "<input type='hidden' name='incorrect current password' value='current password is invalid' />";
            }
        }
        elseif( isset($_SESSION['adminId']) && !empty($_SESSION['adminId'] ) ){
            $sql = "select password from admin where adminId=".$_SESSION['adminId'];
            $query = $dbhandler->query($sql);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            $current_password = $fetchedResult['password'];
            if( $current_password == $_POST['currentPassword'] ){
                $current_password_flag = TRUE;
            }
            else{
                echo "<input type='hidden' name='incorrect current password' value='current password is invalid' />";
            }
        }
    }
    else{
        $_SESSION['invalidLoginCredentials'] = "please login first";
        header("location:index.php");
    }
?>
        </form>
        
<?php
    if( $current_password_flag == TRUE && $password_flag == TRUE ){
        if( isset($_SESSION['voterId']) && !empty($_SESSION['voterId'] ) ){
            try{
                $sql = "update voter set "
                        . "password= '".$_POST['password'] ."' where voterId=".$_SESSION['voterId'].";";
                $dbhandler->query($sql);
                $_SESSION['passwordChange'] = 'password changed successfully'; 
                header("Location: voterProfile.php");
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }
        elseif( isset($_SESSION['candidateId']) && !empty($_SESSION['candidateId'] ) ){
            try{
                $sql = "update candidate set "
                        ." password= '".$_POST['password']."' where candidateId=" .$_SESSION['candidateId'].";" ;
                $dbhandler->query($sql);
                $_SESSION['passwordChange'] = 'password changed successfully'; 
                header("Location: candidateProfile.php");
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }
        elseif( isset($_SESSION['adminId']) && !empty($_SESSION['adminId'] ) ){
            try{
                $sql = "update admin set "
                        . "password= '".$_POST['password'] ."' where adminId=".$_SESSION['adminId'].";";
                $dbhandler->query($sql);
                $_SESSION['passwordChange'] = 'password changed successfully'; 
                header("Location: adminProfile.php");
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }
    }
    else{
    ?>
        
    <script>
       document.getElementById("resend").submit();
    </script>
    <?php
    }
?>
        