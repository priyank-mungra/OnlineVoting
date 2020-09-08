<?php
session_start();
//$_SESSION['currentPage'] = 'profile';
include 'header.php';
if( isset($_SESSION['profileUpdate'])){
    echo "<p style='color: green'>".$_SESSION['profileUpdate']."</p>";
    unset($_SESSION['profileUpdate']);
}
if( isset($_SESSION['passwordChange'])){
    echo $_SESSION['passwordChange']."<br/>";
    unset($_SESSION['passwordChange']);
}
?>
<html>
    <head>
        <title>Admin Profile</title>
    </head>
    <body>
        
        <?php
        if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
        {
            $_SESSION['invalidLoginCredentials'] = "please login first";
            header("location: index.php");
        }
        elseif( !( isset($_SESSION['adminId']) && !empty($_SESSION['adminId']) ) ){
            echo "you must be a admin in order to view this page";
        }
        else{
            
            $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234' );
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                    $sql = "select username ,fathersname ,gender ,dob ,phoneNumber ,email ,address ,voted , "
                       . "registrationDate from admin where adminid=".$_SESSION['adminId'];
                $query = $dbhandler->query($sql);
                $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
                echo "<div> adminId: a".$_SESSION['adminId']."<br/>";
                foreach($fetchedResult as $index => $value){
                    echo "<div>".$index. ": ". $value."<br/>";
                }
            }
            catch(PDOException $ex){
                echo $ex;
            }
        ?>
            <button onclick="location.href= 'adminUpdateProfile.php';" id="updateprofile">update profile</button>
        <?php
        }
        ?>
        
    </body>
    
</html>