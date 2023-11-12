<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Coming soon!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/comingsoon.ico">

        <!-- Bootstrap HTML Links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>

            <!-- Link to CSS file -->
            <link rel="stylesheet" type="text/css" href="styles/comingsoon.css">

            <!-- Link to a script file -->
            <script src="scripts/comingsoon.js"></script>
        </header>

        <div class = "background-container">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 text-center">

                        <div class="content text-center">
                            <h2 class="text_shadows">COMING SOON</h2>
                        </div>
                        
                        <div class="container text-center">
                            <hr class="bg-primary w-25 mx-auto">
                        </div>

                        <div class = "font-monospace fw-bold h3 text-primary">
                            <p id="time"></p>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <p class = "lead">A new era in the Sneakerology community for both buyers and sellers</p>
                    </div>

                    <h1 class = "m-3 font-monospace">What will be released?</h1>

                    <p><span class = "fw-bold text-primary">Better User Accounts</span> - Users can create accounts with enabled features that lets them save their preferences and track their sneaker collections.</p>
                    <p><span class = "fw-bold text-primary">Seller Accounts</span> - Sellers can create accounts to list their sneakers for sale, manage inventory, and interact with potential buyers.</p>
                    <p><span class = "fw-bold text-primary">In-Depth Price Analysis</span> - We provide comprehensive price analysis tools to help users understand the market value of sneakers.</p>
                    <p><span class = "fw-bold text-primary">Advanced Search Filters</span> - Enhanced search functionality with filters for brand, size, condition, and more, to help users find the perfect pair.</p>

                    <p class = "lead text-muted">And more . . .</p>
                </div>
            </div>

        </div>

        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>
    </body>
</html>