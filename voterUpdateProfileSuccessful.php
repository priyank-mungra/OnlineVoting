<?php
    /*echo "welcome " . $_POST['username'] ."<br>";
    echo "your password is " . $_POST['password']. "<br/>";
    $input = $_SERVER['QUERY_STRING'];
    var_dump($input);
    exit();
     */
?>
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
        <form id="resend" method="POST" action="voterUpdateProfile.php">
        <?php
            $current_password_flag = false;
            $dbhandler = new PDO("mysql:host=127.0.0.1;dbname=voting;charset=utf8" ,'user_priyank' ,'1234');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
        ?>
        </form>
            <?php
            if( $current_password_flag == TRUE ){
            ?>
            <table border="1">
            <?php
                try{
$sql = "update voter set "
        . "username = '".$_POST['username']."' , fathersName = '".$_POST['fathersName'].
        "' ,gender ='".$_POST['gender'] ."' ,dob = '".$_POST['birth_date']."' ,phoneNumber = '".$_POST['phoneNumber'].
        "' ,email= '".$_POST['email']."' ,address= '".$_POST['address']."' where voterId=".$_SESSION['voterId'].";";
                
                $dbhandler->query($sql);
                $_SESSION['profileUpdate'] = 'profile updated successfully';
                header("Location: voterProfile.php");
                }
                catch(PDOException $ex){
                    echo $ex->getMessage();
//                    die();
                }
                ?>
                <!--<tr><td colspan="2"><a href='index.php'>login</a></td></tr>-->
            </table>
            <?php
            }
            else{
                ?>
            
            <script>
               
               document.getElementById("resend").submit();
            </script>
            <?php
            }
        ?>
    </body>
</html>