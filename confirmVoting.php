<?php
    session_start();
    $_SESSION['currentPage'] = 'confirmVoting';
    include 'header.php';
    if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) ){
        echo "login first in order to vote";   
    }
    else
    {
        $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $email= substr($_POST['vote'], 6);
        $voteSql = "update candidate ".
                        "set votes= votes + 1 ".
                        "where email='".$email."'";
        if( isset($_SESSION['voterId']) ){
            $validateVoted = "select voted ,verified from voter where voterId=".$_SESSION['voterId'];
            $query = $dbhandler->query($validateVoted);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            if( $fetchedResult['verified'] == 'verified'){
                if( $fetchedResult['voted'] == 'not voted'){
                    $sql = "update voter ".
                                "set voted= 'voted' ".
                                "where voterId=".$_SESSION['voterId'];
                    $dbhandler->query($sql);
                    $dbhandler->query($voteSql);
                    $_SESSION['message'] = "you have successfully voted";
                    header("location:votes.php");
                }
                else{
                    echo "you have already voted";
                }
            }else{
                echo " you are not eligible to vote your profile eligibility status is :<b style='color:red '>".$fetchedResult['verified']."</b><br/>";
            }
        }
        elseif (isset ($_SESSION['candidateId']) ) {
            $validateVoted = "select voted ,verified from candidate where candidateId=".$_SESSION['candidateId'];
            $query = $dbhandler->query($validateVoted);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            if( $fetchedResult['verified'] == 'verified'){
                if( $fetchedResult['voted'] == 'not voted'){
                    $sql = "update candidate ".
                                "set voted= 'voted' ".
                                "where candidateId=".$_SESSION['candidateId'];
                    $dbhandler->query($sql);
                    $dbhandler->query($voteSql);
                    $_SESSION['message'] = "you have successfully voted";
                    header("location:votes.php");
                }
                else{
                    echo "you have already voted";
                }
            }
            else{
                echo " you are not eligible to vote your profile eligibility status is :<b style='color:red '>".$fetchedResult['verified']."</b><br/>";
            }
        }
        elseif (isset ($_SESSION['adminId']) ) {
            $validateVoted = "select voted ,verified from admin where adminId=".$_SESSION['adminId'];
            $query = $dbhandler->query($validateVoted);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            if( $fetchedResult['verified'] == 'verified'){
                if( $fetchedResult['voted'] == 'not voted'){
                    $sql = "update admin ".
                                "set voted= 'voted' ".
                                "where adminId=".$_SESSION['adminId'];
                    $dbhandler->query($sql);
                    $dbhandler->query($voteSql);
                    $_SESSION['message'] = "you have successfully voted";
                    header("location:votes.php");
                }
                else{
                    echo "you have already voted";
                }
            }
            else{
                echo " you are not eligible to vote your profile eligibility status is :<b style='color:red '>".$fetchedResult['verified']."</b><br/>";
            }
        }
    }
?>

