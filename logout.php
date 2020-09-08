<?php
session_start();
$_SESSION['currentPage'] = 'logout';
?>
<html>
    <head>
        <title>logout</title>
    </head>
    <body>
        <?php
        include 'header.php';
        if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE ){
            ?>
<!--        <a href="index.php">login</a>
        <a href="votes.php">votes</a>
        <a href="logout.php">logout</a>
        <hr/>-->
            <?php
            echo "you are successfully logged out";
        }
        else{
//            include 'header.php';
            echo "you have not logged in yet";
        }
        ?>
    </body>
</html>
<?php
session_destroy();
?>

