<?php
    session_start();
    $_SESSION['currentPage'] = 'profile';
    include 'header.php';
    if( isset($_SESSION['profileUpdate'])){
    echo "<p style='color: green'>".$_SESSION['profileUpdate']."</p>";
    unset($_SESSION['profileUpdate']);
    }
?>
<html>
    <head>
        <title>Voter Profile</title>
    </head>
    <body>
        <?php
        if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
        {
            $_SESSION['invalidLoginCredentials'] = "please login first";
            header("location: index.php");
        }
        elseif( !( isset($_SESSION['voterId']) && !empty($_SESSION['voterId']) ) ){
            echo "you must be a voter in order to view this page";
        }
        else{
            foreach ($_POST as $index => $value ){
                echo $index .":  ".$value ."<br/>";
            }
            $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234' );
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                $sql = "select username ,fathersname ,gender ,dob ,phoneNumber ,email ,address ,voted ,"
                       . "registrationDate from voter where voterid=".$_SESSION['voterId'];
                $query = $dbhandler->query($sql);
                $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
                echo "<div> voterId: v".$_SESSION['voterId']."<br/>";
                foreach($fetchedResult as $index => $value){
                    echo "<div>".$index. ": ". $value."<br/>";
                }
            }
            catch(PDOException $ex){
                echo $ex;
            }
        ?>
        <button onclick="location.href= 'voterUpdateProfile.php';" id="updateprofile">update profile</button>
        <?php
        }
            ?>
    </body>
    
</html>


