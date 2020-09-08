<?php
    session_start();
    include 'header.php';
?>
<?php
    
    if( isset($_SESSION['message']) ){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
    }
    if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
    {
        $_SESSION['invalidLoginCredentials'] = "please login first";
        header("location:index.php");
    }
    elseif( (!isset ($_SESSION['adminId'])) || empty($_SESSION['adminId']) ){
        header("location:homeRedirect.php");
    }
    else{
        $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $voteSql = "select verified from admin where adminId=".$_SESSION['adminId'];
        $query = $dbhandler->query($voteSql);
        $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
        if( $fetchedResult['verified'] == 'verified' ){
        
?>
<html>
    <head>
        <title>verify interface</title>
    </head>
    <body>
            <form method="post" action="verify.php" />
        <table>
            <tr><td>verify entity</td>
                <td>
                <select name="verifyEntity" size="1">
                    <option>voter</option>
                    <option>candidate</option>
                    <option>admin</option>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="submit"/></td>
            </tr>
        </table>
        </form>
    </body>
</html>


<?php
        }
        else{
            $_SESSION['message'] = "you are not eligible to verify Registrations your profile eligibility status is :<b style='color:red '>".$fetchedResult['verified']."</b><br/>";
            header( "location: adminHome.php");
        }
    }
?>