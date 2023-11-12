<?php
    // Initialize the 'page' session variable if it doesn't exist
    if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = 0;
    }

    $page = $_SESSION['page']; // Get the 'page' value from the session

    $sneakapiKey = 'cffe8e29e1mshe3c4ee5fb73cb02p117b74jsn4a695943b449';

    // Determine the limit based on the current page
    if (basename($_SERVER['PHP_SELF']) == 'index.php') {
        $limit = 34; // Display fewer items on the index page only (faster loading times)
    } else {
        $limit = 64; // Display items on other pages (e.g., marketplace.php), needs to be divisable by 4 for a neater display
    }

    $curlch = curl_init();
    $sneakerurl = 'https://the-sneaker-database.p.rapidapi.com/sneakers?limit=' . $limit . '&page=' . $page;

    curl_setopt($curlch, CURLOPT_URL, $sneakerurl);
    curl_setopt($curlch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlch, CURLOPT_HTTPHEADER, [
        'X-RapidAPI-Key: ' . $sneakapiKey, 
        'X-RapidAPI-Host: the-sneaker-database.p.rapidapi.com'
    ]);

    $sneakerresponse = curl_exec($curlch);

    curl_close($curlch);

    if ($sneakerresponse !== false) {
        $sneakerapiResponse = json_decode($sneakerresponse, true);
    } else {
        print("<script> window.alert('An unforseen error has occured. Please try reload the page and ensure you have an internet connection');</script>");
    }
?>
