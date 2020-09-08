<?php
//    $currentPage = '';
    if( isset( $_SESSION['currentPage'])){
        $currentPage = $_SESSION['currentPage'];
    }
    if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE )){
        echo '<a href= "index.php">login </a>';
        echo '<a href="votes.php">votes </a>';
    }
    elseif (isset($_SESSION['adminId']) && !empty ($_SESSION['adminId']) ){
//        echo '<a href= "index.php">login </a>';
        echo '<a href="homeRedirect.php">Home </a>';
        echo '<a href="profileRedirect.php">profile </a>';
        echo '<a href="votes.php">votes </a>';
        echo '<a href="verifyInterface.php">verifyRegistrations </a>';
        echo '<a href="logout.php">logout </a>';
    }
    elseif( $currentPage == "home"){
        echo '<a href="profileRedirect.php">profile </a>';
        echo '<a href="votes.php">votes </a>';
        echo '<a href="logout.php">logout </a>';
    }
    elseif( $currentPage == 'registeredSuccessfully' ){
        echo '<a href="homeRedirect.php">Home </a>';
        echo '<a href="../profileRedirect.php">profile </a>';
        echo '<a href="../votes.php">votes </a>';
        echo '<a href="../logout.php">logout </a>';
    }
    elseif( $currentPage == 'votes'){
        echo '<a href="homeRedirect.php">Home </a>';
        echo '<a href="profileRedirect.php">profile </a>';
        echo '<a href="logout.php">logout </a>';
    }
    elseif( $currentPage == 'confirmVoting' || $currentPage== 'updateProfile'){
        echo '<a href="homeRedirect.php">Home </a>';
        echo '<a href="profileRedirect.php">profile </a>';
        echo '<a href="votes.php">votes </a>';
        echo '<a href="logout.php">logout </a>';
    }
    elseif( $currentPage == 'logout'){
        echo '<a href= "index.php">login </a>';
        echo '<a href="votes.php">votes </a>';
    }
    elseif( $currentPage == 'profile' ){
        echo '<a href="homeRedirect.php">Home </a>';
        echo '<a href="votes.php">votes </a>';
        echo '<a href="logout.php">logout </a>';
    }
    elseif( $currentPage == 'registration'){ //not required but still kept for future use as it wont be logged in yet
        echo '<a href= "index.php">login </a>';
        echo '<a href="votes.php">votes </a>';
    }
//    echo '<a href= "index.php">login </a>';
//    echo '<a href="profileRedirect.php">profile </a>';
//    echo '<a href="votes.php">votes </a>';
//    echo '<a href="logout.php">logout </a>';
//    echo '<a href="homeRedirect.php">Home </a>';
    echo '<hr/>';
?>

