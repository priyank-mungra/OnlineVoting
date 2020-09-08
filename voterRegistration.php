

<html>
    <head>
        <title>
            Voter &nbsp;Registration &nbsp;Form
        </title>
            
        <meta charset="UTF-8">
        <style>
            table ,th ,td{
                border: 1px solid black;
                padding: 3px;
            }
            
            input[type=text], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
              }
        </style>
    </head>
    <body bgcolor="#e0e0e0">
        <?php
        include 'header.php';
        foreach ($_POST as $index => $value ){
            echo $index .":  ".$value ."<br/>";
        }
        ?>
        <form action="voterSuccessful.php" method="post">
            <table style="width:50%">
                <tr>
                    <th colspan="3" align="left">*Required field</th>
                </tr>
                <tr>
                    <td>*Name (first middle last):</td>
                    <td colspan="2"><input type="text" name="username" required/></td>
                </tr>
                <tr>
                    <td>*Fathers Name (first middle last):</td>
                    <td colspan="2"><input type="text" name="fathersname" required/></td>
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
                    <td colspan="3">*Male
                    <input type="radio" name="gender" value="male"  required/>
                    Female
                    <input type="radio" name="gender" value="female" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        *Birth date:
                        <input type="date" name="birth_date"  required>
                    </td>
                </tr>
                
                <tr>
                    <td >*Phone number:</td>
                    <td colspan="2">
                        <input type="text" name="phoneNumber" />
                    </td>
                </tr>
                <tr>
                    <td>*Email id</td>
                    <td colspan="2"><input type="text" name="email"/></td>
                </tr>
                <tr>
                    <td colspan="3">*Address</td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <textarea name="address" rows="4" cols="100%"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="submit" name="Submit"  />
                    </td>
                    <td>
                        <input type="reset" value="Reset" name="reset"/>
                    </td>
                    <td>
                        <a href="index.php" >Home</a>  
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>