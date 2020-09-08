<?php
session_start();
?>
<html>
    <head>
        <title>
            login confirmation
        </title>
    </head>
    <body>
        <?php
        
        $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,'user_priyank' ,'1234' );
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        if( (!isset($_POST['userid']) ) || (!isset($_POST['password'])) ) {
            $_SESSION['invalidLoginCredentials'] = "please enter userid and password in order to login<br/>";
            header("Location:index.php");
        }
        else{
            $userid = $_POST['userid'];
            echo $userid;
            if( $userid[0] == 'v' ) //case for user to be a voter
            {
                echo "<br/>user is a voter";
                $voterId = substr($userid, 1);
                try{
                    $sql = "select * from voter where voterId='".$voterId."';";
                    $result = $dbhandler->query($sql);
                    $fetchedResult = $result->fetch(PDO::FETCH_ASSOC);
                    if( empty($fetchedResult) ){
                        $_SESSION['invalidLoginCredentials'] = "userid does not exist";
                        header("location:index.php");
                    }
                    else{
                        $dbPassword = $fetchedResult['password'];
                        if( $_POST['password'] != $dbPassword ){
                            $_SESSION['invalidLoginCredentials'] = "incorrect password";
                            header("Location:index.php");
                        }
                        else{
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['voterId'] = $voterId;
                            header("location:voterHome.php");
                        }
                    }
                } catch (Exception $ex) {
                    $_SESSION['invalidLoginCredentials'] = "unknown issue occured";
                    echo $ex;
//                    header("Location:/login/index.php");
                }
            }
            elseif( $userid[0] == 'c' ) //case for user to be a voter
            {
                echo "<br/>user is a candidate";
                $candidateId = substr($userid, 1);
                try{
                    $sql = "select * from candidate where candidateId='".$candidateId."';";
                    $result = $dbhandler->query($sql);
                    $fetchedResult = $result->fetch(PDO::FETCH_ASSOC);
                    if( empty($fetchedResult) ){
                        $_SESSION['invalidLoginCredentials'] = "userid does not exist";
                        header("location:index.php");
                    }
                    else{
                        $dbPassword = $fetchedResult['password'];
                        if( $_POST['password'] != $dbPassword ){
                            $_SESSION['invalidLoginCredentials'] = "incorrect password";
                            header("Location:index.php");
                        }
                        else{
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['candidateId'] = $candidateId;
                            header("location:candidateHome.php");
                        }
                    }
                } catch (Exception $ex) {
                    $_SESSION['invalidLoginCredentials'] = "unknown issue occured";
                    echo $ex;
//                    header("Location:index.php");
                }
            }
            elseif( $userid[0] == 'a' ) //case for user to be a voter
            {
                echo "<br/>user is a admin";
                $adminId = substr($userid, 1);
                try{
                    $sql = "select * from admin where adminId='".$adminId."';";
                    $result = $dbhandler->query($sql);
                    $fetchedResult = $result->fetch(PDO::FETCH_ASSOC);
                    if( empty($fetchedResult) ){
                        $_SESSION['invalidLoginCredentials'] = "userid does not exist";
                        header("location:index.php");
                    }
                    else{
                        $dbPassword = $fetchedResult['password'];
                        if( $_POST['password'] != $dbPassword ){
                            $_SESSION['invalidLoginCredentials'] = "incorrect password";
                            header("Location:index.php");
                        }
                        else{
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['adminId'] = $adminId;
                            header("location:adminHome.php");
                        }
                    }
                } catch (Exception $ex) {
                    $_SESSION['invalidLoginCredentials'] = "unknown issue occured";
                    echo $ex;
//                    header("Location:index.php");
                }
            }
            else{
                $_SESSION['invalidLoginCredentials'] = "incorrect userId";
                header("Location:index.php");
            }
    //        $sql = "select * from voter where "
        }
        ?>
    </body>
</html>

