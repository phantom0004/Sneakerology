<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    $url = 'https://sneaker-database-stockx.p.rapidapi.com/mostpopular?limit=20';
    $apiKey = 'cffe8e29e1mshe3c4ee5fb73cb02p117b74jsn4a695943b449';

    // Define the new cache directory path (without "Sneakerology" in it)
    $cacheDirectory = 'cache_memory/';

    // Update the cache file variable to include the new directory path
    $cacheFile = 'C:/xampp/htdocs/Sneakerology/' . $cacheDirectory . 'cache_' . md5($url) . '.json';
    $cacheTime = 3600; // Cache time in seconds

    // Ensure that the cache directory exists and create it if it doesn't
    if (!file_exists($cacheDirectory)) {
        mkdir($cacheDirectory, 0777, true); // Create the directory recursively with full permissions
    }

    // Check if cache file exists and is still valid
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - $cacheTime))) {
        $apiResponse = json_decode(file_get_contents($cacheFile), true);
    } else {
        // Fetch new data and cache it
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "X-RapidAPI-Key: $apiKey\r\n" .
                            "X-RapidAPI-Host: sneaker-database-stockx.p.rapidapi.com\r\n"
            ]
        ]);

        $response = file_get_contents($url, false, $context);

        if ($response !== false) {
            $apiResponse = json_decode($response, true);
            file_put_contents($cacheFile, $response); // Cache the response
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo "<script> window.alert('An error occurred. Please try reloading the page and ensure you have an internet connection');</script>";
            exit;
        }
    }
?>