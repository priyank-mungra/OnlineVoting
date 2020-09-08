<?php

//    $dbhandler = new PDO("mysql:host=localhost;dbname=voting;charset=utf8" ,"user_priyank" ,'1234');
//    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $voteSql = "update candidate ".
//                        "set votes= votes + 1 ".
//                        "where candidateId=3";
//    $dbhandler->query($voteSql);
session_start();
foreach( $_SESSION as $index => $value ){
    echo "<pre>".$index.": ".$value."<br/>";
}
?>

