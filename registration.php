<?php
    session_start();
    $_SESSION['currentPage'] = 'registration';
?>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
       <?php
            include 'header.php';
       ?>
        <a href='voterRegistration.php'>voter Registration </a><br/>
        <a href="candidateRegistraion.php">candidate Registration</a><br/>
        <a href='adminRegistration.php'>admin registration</a><br/>
    </body>
</html>
