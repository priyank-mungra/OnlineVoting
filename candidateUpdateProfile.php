<?php
session_start();
$_SESSION['currentPage'] = 'updateProfile';
?>
<html>
    <head>
        <title>
            Candidate update Form
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
        
        if( !(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) )
        {
            $_SESSION['invalidLoginCredentials'] = "please login first";
            header("location: index.php");
        }
        elseif( !( isset($_SESSION['candidateId']) && !empty($_SESSION['candidateId']) ) ){
            echo "you must be a voter in order to view this page";
        }
        else{
            $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234' );
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                $sql = "select username ,fathersName ,gender ,dob ,phoneNumber ,email ,address ,voted ,"
                       . "partyName ,registrationDate from candidate where candidateId=".$_SESSION['candidateId'];
                $query = $dbhandler->query($sql);
                $fetchedResult = $query->fetch(PDO::FETCH_ASSOC);
//                echo "<div> voterId: v".$_SESSION['voterId']."<br/>";

            }
            catch(PDOException $ex){
                echo $ex;
            }
//            foreach($fetchedResult as $index => $value){
//                echo "<div>".$index. ": ". $value."<br/>";
//            }
        
        ?>
        <form action="candidateUpdateProfileSuccessful.php" method="post">
            <table style="width:50%">
                <tr>
                    <th colspan="3" align="left">*Required field</th>
                </tr>
                <tr>
                    <td style="color: green"><b>*Current Password:</b></td>
                    <td colspan="2"><input type="password" name="currentPassword" required  />
                </tr>
                <tr>
                    <td>*Name (first middle last):</td>
                    <td colspan="2"><input type="text" name="username" required value="<?php echo $fetchedResult['username']; ?>"   /></td>
                </tr>
                <tr>
                    <td>*Fathers Name (first middle last):</td>
                    <td colspan="2"><input type="text" name="fathersName" required value="<?php echo $fetchedResult['fathersName']; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="3">*Male
                    <input type="radio" name="gender" value="male" <?php if( $fetchedResult['gender'] == 'male'){ echo 'checked'; }?> required/>
                    Female
                    <input type="radio" name="gender" value="female" <?php if( $fetchedResult['gender'] == 'female'){ echo 'checked'; }?> required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        *Birth date:
                        <input type="date" name="birth_date"  value="<?php echo $fetchedResult['dob']; ?>" required>
                    </td>
                </tr>
                
                <tr>
                    <td >*Phone number:</td>
                    <td colspan="2">
                        <input type="text" name="phoneNumber" value="<?php echo $fetchedResult['phoneNumber']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>*Email id</td>
                    <td colspan="2"><input type="text" name="email" value="<?php echo $fetchedResult['email']; ?>"/></td>
                </tr>
                <tr>
                    <td colspan="3">*Address</td>
                </tr>
                <tr>
                    <td>party name</td>
                    <td><input type="text" name="partyName"  value="<?php echo $fetchedResult['partyName']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <textarea name="address" rows="4" cols="100%"><?php echo $fetchedResult['address']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button onclick="location.href= 'changePassword.php';" id="changePassword"><b>Change Password</b></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="update" name="update"  />
                    </td>
                    <td colspan="2">
                        <button onclick="location.href= 'voterProfile.php';" id="cancelUpdateprofile">Cancel</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        }
        ?>
    </body>
</html>