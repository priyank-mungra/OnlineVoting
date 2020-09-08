<?php
    session_start();
    include 'header.php';
?>
<?php
    if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
    {
        $_SESSION['invalidLoginCredentials'] = "please login first";
        header("location:index.php");
    }
    elseif( (!isset ($_SESSION['adminId'])) || empty ($_SESSION['adminId']) ){
        header("location:homeRedirect.php");
    }
    else{
        $verifyEntity = $_SESSION['verifyEntity'];
        $verification = $_POST['verification'];
        $phoneNumber = substr($verification, 8);
        $verifyStatus = substr($verification, 0, 6);
        $comments = 'comments'.$phoneNumber;
        if( $verifyStatus == 'verify'){
            $verifyStatus = 'verified';
        }
        elseif( $verifyStatus == 'reject' ){
            $verifyStatus = 'rejected';
        }
        $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if( $verifyEntity == 'voter' ){ 
            $sql = "update voter ".
                        "set verified= '".$verifyStatus."' ,comments='".$_POST[$comments]."'".
                        "where phoneNumber='".$phoneNumber."' ;";
        }
        elseif( $verifyEntity == 'candidate'){
            $sql = "update candidate ".
                        "set verified= '".$verifyStatus."' ,comments='".$_POST[$comments]."'".
                        "where phoneNumber='".$phoneNumber."' ;";
        }
        elseif( $verifyEntity == 'admin' ){
            $sql = "update admin ".
                        "set verified= '".$verifyStatus."' ,comments='".$_POST[$comments]."'".
                        "where phoneNumber='".$phoneNumber."' ;";
        }
        $dbhandler->query($sql);
        $_SESSION['message'] = "verification status updated successfully";
        header("location: verify.php");
    }
?>

