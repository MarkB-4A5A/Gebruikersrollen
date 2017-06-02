<?php
    session_start();
    if(isset($_SESSION["logged_in"])) {
        session_destroy();
        echo "Succesfully logged out...";
        header("Location: index.php");
    } else {
        echo "You are not logged in...";
        header("Location: login.php");
    }

?>
