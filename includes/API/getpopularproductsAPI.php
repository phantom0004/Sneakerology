<?php
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, 'https://sneaker-database-stockx.p.rapidapi.com/mostpopular?limit=20');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-RapidAPI-Key: cffe8e29e1mshe3c4ee5fb73cb02p117b74jsn4a695943b449',
        'X-RapidAPI-Host: sneaker-database-stockx.p.rapidapi.com'
    ]);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Close the cURL session
    curl_close($ch);

    // Check if the response is successful
    if ($response !== false) {
        $apiResponse = json_decode($response, true);

    } else {
        // Handle errors here
        header('HTTP/1.1 500 Internal Server Error');
    }
?>
