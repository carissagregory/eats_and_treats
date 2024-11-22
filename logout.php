<?php
    //when the user clicks the log out button the session is unset and destroyed then they are sent to the home page
    //disconnect from the database 
    session_start();

    session_unset();    //remove session variables
    session_destroy();  //remove the session

    //disconnect from the database
    $conn = null;
    $stmt = null;

    //redirect to the home page/login page
    header("Location: login.php");
?>
