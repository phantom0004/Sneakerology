<?php
    session_start(); // Start the session

    if (isset($_GET['page'])) {
        $_SESSION['page'] = intval($_GET['page']);
    }
?>
