<?php
    //MySQL details
    $host = "localhost";
    $dbname = "SneakerologyDB";

    //MySQL User Credentials
    $user = "root";
    $pass = "root";

    //MySQL connection attempt/error handing
    ini_set('display_errors', 0); // Hides all errors for security reasons
    try{ //Attempt a connection
       $conn = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass); //Will handle connections 
    }
    catch(PDOException $error){ //Catch any errors
        print("<script> window.alert('Oops! Something went wrong. Please try again later or contact our support team for assistance.') </script>"); //Friendly error message
        print("<script> setTimeout(function(){ window.location.href='index.php'; }, 1000); </script>"); //Wait a bit, then be redirected to the index page
    }
?>