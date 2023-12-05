<?php
    ini_set('display_errors', '0'); //Hide all errors that the API may throw

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['discount-code'])) {
        $userInput = $_POST['discount-code'];

        $apiKey = 'cffe8e29e1mshe3c4ee5fb73cb02p117b74jsn4a695943b449';
        $url = 'https://get-promo-codes.p.rapidapi.com/data/get-coupons/?sort=update_time_desc';
        $headers = [
            'X-RapidAPI-Key: ' . $apiKey,
            'X-RapidAPI-Host: get-promo-codes.p.rapidapi.com'
        ];

        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Set custom headers
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification (not recommended for production)

        $response = curl_exec($ch);

        if ($response === false) {
            echo '<script> window.alert("Coupon codes are not available at the moment, please try at a later time"); </script>';
        } else {
            // Use API data and compare with $userInput
            $apiData = json_decode($response, true);

            // Initialize flags for code and title matches
            $codeFound = false;
            $titleFound = false;
            $percentage = '';

            foreach ($apiData['data'] as $item) {
                if (isset($item['code']) && $item['code'] === $userInput
                    && isset($item['title']) && preg_match('/(\d+)%/', $item['title'], $matches)) {
                    $codeFound = true;
                    $percentage = $matches[0];
                    $titleFound = true;
                    break; // Exit the loop when both code and title are found
                }
            }

            if ($codeFound && $titleFound) {          
                echo 'Congratulations! Coupon avaliable : ' . $userInput . ' for ' . $percentage . ' off! Have fun shopping!';
            } else {
                echo 'Oops! The discount code is incorrect. Please try again.';
            }
        }

        curl_close($ch);
    }
?>
