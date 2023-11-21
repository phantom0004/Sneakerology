<?php
    require_once 'vendor/autoload.php';

    // Initialize the Twig FilesystemLoader with the path
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__."/twig");

    // Create a Twig Environment instance
    $twig = new \Twig\Environment($loader);

    // Define the template file you want to render
    $templateFile = '404.twig'; 

    // Load the template
    $template = $twig->load($templateFile);

    // Render the template
    echo $template->render([]); //No variable input needed
?>
