<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Marketplace</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/marketplace.ico">

        <!-- Bootstrap HTML Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>

            <!-- Handles API connections-->
            <?php require 'includes/API/getpopularproductsAPI.php'; ?> <!-- Gets popular products across many vendors -->
            <?php require 'includes/API/getallproductsAPI.php'; ?> <!-- Another API that gets a list of a multitude of products to view (non-popular and also popular) -->

            <!-- Handles functions for the search bar and sort function -->
            <script src="scripts/searchandsortfunction.js"></script>

            <!-- Link to CSS file -->
            <link rel="stylesheet" type="text/css" href="styles/marketplace.css">
        </header>

        <h1 class = "display-6 fw-bold text-center m-3 font-monospace">Browse the <span class = "animate-charcter">infinite</span> variety of the most popular products</h1>

        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center ms-5">
                <div class="input-group rounded">
                    <span class="input-group-text border-0 bg-white" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                    <div class="inputbox">
                        <input type="text" id="searchbar" required>
                        <span>Find a shoe or a brand</span>
                        <i></i>
                    </div>
                    <button id="searchButton" class="btn bg-white text-primary fw-bold font-monospace">Search</button>
                </div>
            </div>

            <div class="btn-group me-5"> 
                <button type="button" class="btn btn-sm border-0">Sort by</button>
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split border-0" data-bs-toggle="dropdown" aria-expanded="false"></button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item fw-bold" href="#" id="sortByDefault"><i class="fas fa-sync text-primary"></i> View original</a></li>
                    <li><a class="dropdown-item fw-bold" href="#" id="sortByHighestPrice"><i class="fas fa-arrow-up text-primary"></i> Highest price</a></li>
                    <li><a class="dropdown-item fw-bold" href="#" id="sortByLowestPrice"><i class="fas fa-arrow-down text-primary"></i> Lowest price</a></li>
                </ul>

            </div>
        </div>

        <div class="h1 no-products-found-error fw-bold text-danger text-center mt-3" id="no-products-found-error"></div>

        <h2 class = "font-monospace lead fw-bold text-center" id = "title1">See whats currently popular in the market</h2>

        <!-- POPULAR PRODUCTS API PRODUCTS -->
        <div class="container mt-4 popular-products">
            <div class="d-flex justify-content-center flex-wrap">
                <?php
                    $sneakerCount = count($apiResponse);
                    shuffle($apiResponse);

                    for ($i = 0; $i < $sneakerCount; $i++) {
                        $sneaker = $apiResponse[$i];
                        $imageURL = $sneaker['thumbnail'];
                        $shoeName = $sneaker['shoeName'];
                        $retailPrice = $sneaker['retailPrice'];
                        $description = $sneaker['description']; // Assuming 'description' holds the story

                        echo '<div class="card card-product-grid m-4" style="width: 250px;">
                                <a href="#" class="img-wrap" data-bs-toggle="modal" data-bs-target="#sneakerModal' . $i . '">
                                    <img src="' . $imageURL . '" alt="productImage" class="card-img-top">
                                </a>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold font-monospace">' . $shoeName . '</h5>
                                    <p class = "fw-bold">Current Retail Price : <span class = "text-primary"> $' . $retailPrice . '</span></p>
                                </div>
                            </div>';

                        // Modal for each sneaker
                        echo '<div class="modal fade" id="sneakerModal' . $i . '" tabindex="-1" aria-labelledby="sneakerModalLabel' . $i . '" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-monospace fw-bold" id="sneakerModalLabel' . $i . '">' . $shoeName . '</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="' . $imageURL . '" alt="productImage" class="img-fluid mb-2">
                                            <p class="lead">' . (!empty($description) ? $description : 'No product story available') . '</p>
                                            <form action="marketplace.php" method="POST">
                                                <input type="hidden" name="shoeName" value="' . htmlspecialchars($shoeName) . '">
                                                <input type="hidden" name="retailPrice" value="' . htmlspecialchars($retailPrice) . '">
                                                <button type="submit" name="submit" class="btn btn-outline-primary w-100">Add item to basket</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>

        <h2 class = "font-monospace lead fw-bold text-center mt-3" id = "title2">Browse all sneakers</h2>

        <?php
            // Basket logic
            if (isset($_POST["submit"])) {
                // Append the new item to the basketItems session array
                if (!isset($_SESSION['basketItems'])) {
                    $_SESSION['basketItems'] = [];
                }

                $newItem = [
                    'shoeName' => $_POST['shoeName'],
                    'retailPrice' => $_POST['retailPrice']
                ];

                // Check if the item is already in the basket
                $alreadyInBasket = false;
                foreach ($_SESSION['basketItems'] as $item) {
                    if ($item['shoeName'] == $newItem['shoeName']) {
                        $alreadyInBasket = true;
                        break;
                    }
                }

                if (!$alreadyInBasket) {
                    $_SESSION['basketItems'][] = $newItem;
                    $_SESSION['basketMessage'] = '';
                } else {
                    echo "<script> window.alert('Item already added to basket'); </script>";
                }
            }
        ?>

        <!-- ALL PRODUCTS API PRODUCTS -->
        <div class="container mt-4">
            <div class="d-flex justify-content-center flex-wrap">
                <?php
                    $sneakerData = $sneakerapiResponse['results'];

                    foreach ($sneakerData as $index => $sneaker) {
                        $imageURL = $sneaker['image']['original'];
                        if (!empty($imageURL)){ // Check if image URL is not blank or empty and is a valid image
                            $shoeName = $sneaker['name'];
                            $retailPrice = $sneaker['retailPrice'];
                            $description = $sneaker['colorway'];
                            $story = $sneaker['story'];

                            echo '<div class="card card-product-grid border border-2 shadow m-4" style="width: 250px;">
                                <a href="#" class="img-wrap" data-bs-toggle="modal" data-bs-target="#sneakerModal' . $index . '1">
                                    <img src="' . $imageURL . '" alt="Product Image" class="card-img-top productImage">
                                </a>

                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold font-monospace">' . $shoeName . '</h5>
                                    <p class="fw-bold">Current Retail Price: <span class="text-primary">$' . $retailPrice . '</span></p>
                                    <p class="fw-bold">Colorway: ' . $description . '</p>

                                </div>
                            </div>';

                            //DATA FROM ALL SNEAKERS API
                            echo '<div class="modal fade" id="sneakerModal' . $index . '1" tabindex="-1" aria-labelledby="sneakerModalLabel' . $index . '1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-monospace fw-bold" id="sneakerModalLabel' . $index . '1">' . $shoeName . '</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="' . $imageURL . '" alt="Product image" class="img-fluid mb-2 productImage">';
                                            // Check if the 'story' array is not blank
                                            if (!empty($story)) {
                                                // Output the story
                                                echo '<p class = "lead">' . $story . '</p>';
                                            } else {
                                                // Output another message if the 'story' array is blank
                                                echo '<p class = "lead fw-bold">No product story available</p>';
                                                echo '<p class = "lead">For more product information check : <a href = "https://stockx.com/">StockX</a> </p>';
                                            }

                                            echo '<hr class="bg-primary w-25 mx-auto mt-4">';

                                            echo '<p class = "lead fw-bold text-center">Select your shoe size</p>';

                                            echo '<div class="container mt-4">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>EU Size</th>
                                                                <th>Male</th>
                                                                <th>Female</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';

                                                        // Assuming EU sizes for both male and female
                                                        for ($size = 35; $size <= 45; $size++) {
                                                            echo '<tr>
                                                                    <td><a href="#" class = "text-decoration-none fw-bold">' . $size . '</a></td>
                                                                    <td>' . ($size + 1) . '</td>
                                                                    <td>' . ($size - 1) . '</td>
                                                                </tr>';
                                                        }

                                            echo '</tbody>
                                                </table>
                                            </div>';
                                            
                                            echo '<form action="marketplace.php" method="POST" id="submit-form">
                                                <input type="hidden" name="shoeName" value="' . htmlspecialchars($shoeName) . '">
                                                <input type="hidden" name="retailPrice" value="' . htmlspecialchars($retailPrice) . '">
                                                <button type="submit" name="submit" class="btn btn-outline-primary w-100">Add item to basket</button>
                                            </form>
                                                                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>';                                                                                  
                        }   
                    }   
                ?>
            </div>
        </div>

        <!-- If the product image is not found this script will load and replace the product image with a friendly image -->
        <script>
            var productImages = document.getElementsByClassName('productImage');

            // Function to handle image error
            function handleImageError(image) {
                // Replace the image source with the friendly image
                image.src = 'https://crm.tu.org/eweb/images/DEMO1/notavailable.jpg';
            }

            // Loop through all elements with class 'productImage'
            for (var i = 0; i < productImages.length; i++) {
                // Attach the error event listener to each image
                productImages[i].onerror = function() {
                    handleImageError(this);
                };
            }
        </script>
        
        <p class="h4 fw-bold lead text-muted text-center mt-4">Page <?php echo $_SESSION['page'] + 1; ?> out of 1478</p>

        <div class="d-flex justify-content-between mt-4">
            <?php if ($_SESSION['page'] != 0): ?>
                <button type="button" class="btn text-primary fw-bold border-none font-monospace" id="prev-page-btn"><<< Previous Page</button>
            <?php else: ?>
                <button type="button" class="btn text-muted fw-bold border-none font-monospace disabled" id="prev-page-btn" style = "border : none;"><<< Previous Page</button>
            <?php endif; ?>

            <button type="button" class="btn text-primary fw-bold border-none font-monospace" id="next-page-btn">Next Page >>></button>
        </div>

        <script>
            document.getElementById('prev-page-btn').addEventListener('click', function() {
                // Decrement the session 'page' value if "Previous Page" is clicked (and page > 0)
                var page = <?php echo $_SESSION['page']; ?>;
                if (page > 0) {
                    page--;
                    // Update the session 'page' value using an AJAX request
                    updatePageInSession(page);
                }
            });

            document.getElementById('next-page-btn').addEventListener('click', function() {
                // Increment the session 'page' value if "Next Page" is clicked
                var page = <?php echo $_SESSION['page']; ?>;
                page++;
                // Update the session 'page' value using an AJAX request
                updatePageInSession(page);
            });

            function updatePageInSession(page) {
                // Send an AJAX request to update the session 'page' value
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'scripts/updatepage.php?page=' + page, true);
                xhr.send();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Page updated in the session
                        location.reload(); // Reload the page to reflect the updated session value
                    }
                };
            }
        </script>

        <hr class="w-25 mx-auto my-5">

        <h1 class="display-6 fw-bold text-center m-3 font-monospace pb-4">Brands that are currently <span class="fire-text">trending</span></h1>
        
        <div class="container-xxl p-0">
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <!-- Images -->
                <div class="carousel-inner"  style="height: 450px; display: flex; align-items: center;">
                    <div class="carousel-item active">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Supreme_Logo.svg/800px-Supreme_Logo.svg.png" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product1">
                    </div>

                    <div class="carousel-item">
                        <img src="https://conceptdrop.com/wp-content/uploads/2013/10/nike-swoosh.jpg" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product2">
                    </div>

                    <div class="carousel-item">
                        <img src="https://ddtstore.com/cdn/shop/collections/KAWS_HK_Webbanner_plushb_final_1600x550_75e9daed-7e44-4a2f-8bbc-2b4908113338.jpg?v=1637142132" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product3">
                    </div>

                    <div class="carousel-item">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/873f6616482709.562ad21b4d24f.jpg" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product3">
                    </div>

                    <div class="carousel-item">
                        <img src="https://www.ppgroupthailand.com/media/cms_block/about_brands/off-white-l-banner.jpg" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product3">
                    </div>

                    <div class="carousel-item">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/hd/b0d349124648079.6108bfc67cc77.jpg" class="d-block w-100 rounded img-fluid" alt="trending brands" id="banner_product3">
                    </div>

                    <!-- Add Carousel Controls -->
                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    
                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <hr class="w-25 mx-auto my-5">
        <h1 class="display-6 fw-bold text-center m-3 font-monospace pb-4">Access our sneakerology stocks statistics</h1>
        
        <!-- Widget for real time stock viewing - TradingView Widget -->
        <div class="tradingview-widget-container">
            <div id="tradingview_ddb6c"></div>
                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script>
                        new TradingView.widget(
                            {
                                "width": "1500",
                                "height": "650",
                                "symbol": "NYSE:NKE",
                                "interval": "15",
                                "timezone": "Africa/Lagos",
                                "theme": "light",
                                "style": "1",
                                "locale": "en",
                                "enable_publishing": false,
                                "backgroundColor": "rgba(255, 255, 255, 1)",
                                "allow_symbol_change": true,
                                "details": true,
                                "calendar": true,
                                "container_id": "tradingview_ddb6c"
                            }
                        );
                    </script>
                </div>
            </div>
        </div>

        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>

        <!-- Bootstrap Javascript Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>