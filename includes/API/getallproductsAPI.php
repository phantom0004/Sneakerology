<?php
    ini_set('display_errors', '0'); //Hide all errors that the API may throw

     if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Initialize the 'page' session variable if it doesn't exist
    if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = 0;
    }

    $page = $_SESSION['page']; // Get the 'page' value from the session
    $sneakapiKey = 'cffe8e29e1mshe3c4ee5fb73cb02p117b74jsn4a695943b449';

    // Determine the limit based on the current page
    $limit = basename($_SERVER['PHP_SELF']) == 'index.php' ? 34 : 64;

    $sneakerurl = 'https://the-sneaker-database.p.rapidapi.com/sneakers?limit=' . $limit . '&page=' . $page;

    // Define the new cache directory path
    $cacheDirectory = 'allproducts_cache_memory/'; //ENSURE THIS IS GOOD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    // Update the cache file variable to include the new directory path
    $cacheFile = $cacheDirectory . 'cache_' . md5($sneakerurl) . '.json';
    $cacheTime = 3600; // Cache time in seconds

    // Ensure that the cache directory exists and create it if it doesn't
    if (!file_exists($cacheDirectory)) {
        mkdir($cacheDirectory, 0777, true); // Create the directory recursively with full permissions
    }

    // Check if cache file exists and is still valid
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - $cacheTime))) {
        $sneakerapiResponse = json_decode(file_get_contents($cacheFile), true);
    } else {
        // Fetch new data and cache it
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "X-RapidAPI-Key: $sneakapiKey\r\n" .
                            "X-RapidAPI-Host: the-sneaker-database.p.rapidapi.com\r\n"
            ]
        ]);

        $sneakerresponse = file_get_contents($sneakerurl, false, $context);

        if ($sneakerresponse !== false) {
            $sneakerapiResponse = json_decode($sneakerresponse, true);
            file_put_contents($cacheFile, $sneakerresponse); // Cache the response
        } else {
            echo "<script> window.alert('An error occurred. Please try reloading the page and ensure you have an internet connection');</script>";
            print("<script> setTimeout(function(){ window.location.href='index.php'; }, 50); </script>"); //Wait a bit, then be redirected to the index page
            exit;
        }
    }
?>
