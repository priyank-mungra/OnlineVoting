<?php
    session_start();
    if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
    {
        $_SESSION['invalidLoginCredentials'] = "please login first";
        header("location: index.php");
    }
    else{    
        if( isset($_SESSION['voterId']) && !empty($_SESSION['voterId'] )){
            header("location: voterProfile.php");
        }
        elseif (isset($_SESSION['candidateId']) && !empty($_SESSION['candidateId'] ) ) {
            header("location: candidateProfile.php");
        }
        elseif (isset($_SESSION['adminId']) && !empty ($_SESSION['adminId']) ){
            header("location: adminProfile.php");
        }
    }
?>

