<?php
    session_start();
    $_SESSION['currentPage'] = 'updateProfile';
    include 'header.php';
?>
<html>
    <head>
        <title>change password</title>
    </head>
    <body>
        <?php
        foreach ($_POST as $index => $value ){
            echo $index .":  ".$value ."<br/>";
        }
        ?>
        <form method="post" action="passwordChangeSuccessful.php">
            <table border="1">
                <tr>
                    <td style="color: green"><b>*Current Password:</b></td>
                    <td colspan="2"><input type="password" name="currentPassword" required  />
                </tr>
                <tr>
                    <td>*New Password:</td>
                    <td colspan="2"><input type="password" name="password" required/>
                </tr>
                <tr>
                    <td>*Reenter New Password:</td>
                    <td colspan="2"><input type="password" name="rpassword" required/>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="submit"/>
                    </td>
                    <td>
                        <button onclick="location.href= 'profileRedirect.php';" id="cancelUpdateprofile">Cancel</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
