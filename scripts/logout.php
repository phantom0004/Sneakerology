<?php 
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../login.php");
    exit; //Prevents other code being executed
?>