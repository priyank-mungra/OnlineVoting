<?php
    if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE )){
?>
<a href= "index.php">login </a>
<?php
    }
    else{
?>
<a href="profile.php">profile </a>
<?php
    }
?>
        <a href="votes.php">votes </a>
        <a href="logout.php">logout </a>
<hr/>

