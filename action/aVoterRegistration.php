<?php
    session_start();
    $_SESSION['currentPage']='registeredSuccessfully';
?>
<html>
    <head>
        <title>voter successfully Registered</title>
    </head>
    <body>
        <?php
            $_SESSION['loggedin'] = TRUE;
            include '../header.php';
        ?>
        <table>
            <tr>
                <td style="color: green"><b>you are successfully registered </b></td>
            </tr>
            <tr>
                <td>
                    your voter id is:
                    <?php
                        echo "v".$_SESSION['voterId'];
                    ?>
                </td>
            </tr>
            <!--<tr><td colspan="2"><a href='../index.php'>login</a></td></tr>-->
        </table>
    </body>
</html>
