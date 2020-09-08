<?php
session_start();
?>

<html>
    <head>
        <title>
            voter successful
        </title>
    </head>
    <body>
        <form id="resend" method="POST" action="voterRegistration.php">
        <?php
            $username_flag = false ;
            $password_flag = false;
            if( isset($_POST['username']) && $_POST['username'] != NULL  )
            {   if( strlen( $_POST['username'] ) < 60 )
                {$username_flag = true ;
                }
                else{
                    echo "<input type='hidden' name='username_error' value='username must have length less than 60 characters' />";
                }
            }
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
        ?>
        </form>
            <?php
            if( $password_flag == true && $username_flag == true ){
                $dbhandler = new PDO("mysql:host=127.0.0.1;dbname=voting;charset=utf8" ,'user_priyank' ,'1234');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            ?>
            <b> you are successfully registered </b>
            <table border="1">
            <?php
                try{
$sql = "insert into voter (username ,fathersName, password ,gender ,dob ,phoneNumber ,email ,address ) ".
"values('".$_POST['username']."' ,'".$_POST['fathersname']."' ,'".$_POST['password']."' ,'" .$_POST['gender'] ."' ,'".$_POST['birth_date']."' ,'".$_POST['phoneNumber']."' ,'".$_POST['email'] ."' ,'".$_POST['address']."'); ";
                
                $dbhandler->query($sql);
                $sql = "select voterId from voter where phoneNumber='".$_POST['phoneNumber']."';";
                $myresult = $dbhandler->query($sql);
                $fetchedResult = $myresult->fetch(PDO::FETCH_ASSOC);
                $_SESSION['voterId']=$fetchedResult['voterId'] ;
                header("Location:./action/aVoterRegistration.php");
                }
                catch(PDOException $ex){
                    echo $ex->getMessage();
                }
                ?>
            </table>
            <?php
            }
            else{
                    session_destroy();
                ?>
            
            <script>
               document.getElementById("resend").submit();
            </script>
            <?php
            }
        ?>
    </body>
</html>