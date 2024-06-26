<?php
    //MySQL details
    $host = "[REDACTED]";
    $dbname = "SneakerologyDB";

    //MySQL User Credentials
    $user = "[REDACTED]";
    $pass = "[REDACTED]";

    //MySQL connection attempt/error handing
    ini_set('display_errors', 0); // Hides all errors for security reasons

    $conn = null; // Initialize connection variable

    try {
        //Attempt a connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass); //Will handle connections 
    } catch (PDOException $error) {
        //Catch any errors
        print("<script> window.alert('Oops! Something went wrong. Please try again later or contact our support team for assistance.') </script>"); //Friendly error message
        print("<script> setTimeout(function(){ window.location.href='index.php'; }, 50); </script>"); //Wait a bit, then be redirected to the index page
    }

    // Function to close the connection
    function closeConnection() {
        global $conn;
        $conn = null;
    }
?>
