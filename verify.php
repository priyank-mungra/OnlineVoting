<?php
    session_start();
    include 'header.php';
?>

<html>
    <head>
        <title>verify entity</title>
    </head>
    <body>
        
        <?php
//        if(!((isset($_POST['verifyEntity']) && (!empty($_POST['verifyEntity'])) )||(isset($_SESSION['verifyEntity']) && (!empty($_SESSION['verifyEntity'])) ) )){
//            header( "location: verifyInterface.php");
//        }
        if( isset($_SESSION['message']) ){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if( (!isset($_POST['verifyEntity'])) && (!isset($_SESSION['verifyEntity'])) ){
            header( "location: verifyInterface.php");
        }
        else{
            $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $voteSql = "select verified from admin where adminId=".$_SESSION['adminId'];
            $query = $dbhandler->query($voteSql);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            if( $fetchedResult['verified'] == 'verified' ){
                if( isset( $_POST['verifyEntity'] ) ){
                    $verifyEntity = $_POST['verifyEntity'] ;
                }
                elseif(isset ($_SESSION['verifyEntity']) ){
                    $verifyEntity = $_SESSION['verifyEntity'];
                }
                else {
                    $verifyEntity = 'verify Entity not yet setted: error';
                }
                $_SESSION['verifyEntity'] = $verifyEntity ;
                $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if( $verifyEntity == 'voter' ){
                    $sql = "select * from voter";
                }
                elseif( $verifyEntity == 'candidate' ){
                    $sql = "select * from candidate";  
                }
                elseif( $verifyEntity == 'admin' ){
                    $sql = "select * from admin";
                }
                $query = $dbhandler->query($sql);
                $fetchedResult = $query->fetchAll(PDO::FETCH_ASSOC);
                echo "<form action='verifyConfirm.php' method='post'>";
                foreach ($fetchedResult as $index => $value){
    //                $email = $value['email'];
                    $phoneNumber = $value['phoneNumber'];
                    if( (isset($value['adminId']) && $value['adminId'] != '1') || !isset($value['adminId']) ){
                    foreach ( $value as $i => $v){
                        if( $i != 'comments'){
                            echo "<pre>".$i.": ".$v."<br/>";
                        }
                        else{
                            $comments='comments'.$phoneNumber;
                            echo "<pre>".$i."<textarea name='$comments' rows='4' cols='50'>".$v."</textarea><br/>";
                        }
                    }
                    echo "<input type=submit name='verification' value='verify: $phoneNumber' />" ;
                    echo "<input type=submit name='verification' value='reject: $phoneNumber' />" ;
                    echo "<hr>";
                    }
                }
                echo "</form>";
            }
            else{
                $_SESSION['message'] = "you are not eligible to verify Registrations your profile eligibility status is :<b style='color:red '>".$fetchedResult['verified']."</b><br/>";
                header( "location: adminHome.php");
            }
        }
        ?>
    </body>
</html>
