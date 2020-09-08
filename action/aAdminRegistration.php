<?php
    session_start();
    $_SESSION['currentPage']='registeredSuccessfully';
?>
<html>
    <head>
        <title>admin successfully Registered</title>
    </head>
    <body>
        <?php
            if( isset( $_SESSION['adminId'])){
                $_SESSION['loggedin'] = TRUE;
            }
            include '../header.php';
        ?>
        <table>
            <tr>
                <td style="color: green"><b>you are successfully registered </b></td>
            </tr>
            <tr>
                <td>
                    your admin id is:
                    <?php
                        echo "a".$_SESSION['adminId'];
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>
