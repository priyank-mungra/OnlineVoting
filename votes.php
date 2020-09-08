<?php
    session_start();
    $_SESSION['currentPage'] = 'votes';
?>
<html>
    <head>
        <title>live votes</title>
    </head>
    <body>
        <?php
            if( isset($_SESSION['message']) && !empty($_SESSION['message']) ){
                echo "<p  style='color:green;'>".$_SESSION['message']."<p/><br/>";
                unset($_SESSION['message']);
            }
            include 'header.php';
            $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            function voteFor($cid){
//                $voteSql = "update candidate ".
//                        "set votes= votes + 1 ".
//                        "where candidateId=".$cid;
//                $dbhand = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
//                $dbhand->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                $dbhand->query($voteSql);
//                echo "hello";
//                header("location: index.php");
//            }
            $sql = "select candidateId  ,username,gender ,partyName,email ,votes from candidate";
            $query = $dbhandler->query($sql);
            $fetchedResult = $query->fetchAll(PDO::FETCH_ASSOC);
            echo "<form action='confirmVoting.php' method='post'>";
            foreach ($fetchedResult as $index => $value){
                $cid = $value['candidateId'];
                $email = $value['email'];
                foreach ( $value as $i => $v){
                    if( $i != 'candidateId'){
                        echo "<pre>".$i.": ".$v."<br/>";
                    }
                }
                echo "<input type=submit name='vote' value='vote: $email' />" ;
                echo "<hr>";
            }
            echo "</form>";
        ?>
    </body>
</html>