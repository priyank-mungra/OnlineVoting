<?php
    session_start();
    $_SESSION['currentPage'] = "home";
    if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
    {
        $_SESSION['invalidLoginCredentials'] = "please login first";
        header("location:index.php");
    }
    else{
        include 'header.php';
        if( isset($_SESSION['message']) ){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
?>
<html>
    <head><title>admin home</title></head>
    <body>
        <table border="1">
<?php 
        echo "<tr><td>successfully logged in</tr></td>";
        // code to display user is verified or not
        $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,'user_priyank' ,'1234');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try{
            $sql = "select verified ,comments from admin where adminId=".$_SESSION['adminId'];
            $query = $dbhandler->query($sql);
            $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
            echo "<tr><td>";
            if( $fetchedResult['verified'] == 'verified'){
            echo "<p style='color: green'>verified status= verified</p>";
            }
            else{
                echo "<p style='color: red'>verified status=".$fetchedResult['verified']."</p>";
            }
            echo "</td></tr>";
            
            if( !empty($fetchedResult['comments'])){
                echo "<tr><td>";
                echo "comments by admin: <textarea name='address' rows='4' cols='50'>".$fetchedResult['comments']
                        ."</textarea>";
                echo "</td></tr>";
            }
        } catch (Exception $ex) {
            echo $ex;
        }
?>
    </table>
    </body>
</html>
        
<?php      
    }
?>

