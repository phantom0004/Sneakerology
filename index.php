<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/index.ico">

        <!-- Bootstrap HTML Links and Other Library Links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Used for animations -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
        <!-- Used for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> 
    </head>

    <body>
        <header>
            <!-- Adds website header -->
            <?php require 'includes/header.php'; ?>

            <!-- Include product api -->
            <?php require 'includes/API/getallproductsAPI.php' ?>

            <!-- Link to CSS file -->
            <link rel="stylesheet" type="text/css" href="styles/index.css">
        </header>

        <!-- Carousel banner images for advertising -->
        <div class="container-xxl p-0">
        <!-- Image Carousel with Arrows -->
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                <div class="border border-primary border-5 rounded p-2 m-2">
                    <a href="marketplace.php">
                     <!-- Images -->
                        <div class="carousel-inner" style = "height : 400px;">
                            <div class="carousel-item active"> <!-- DISCOUNT BANNER IMAGE -->
                                <img src="assets/banner_product_1.png" class="d-block w-100" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_1">
                            </div>

                            <div class="carousel-item active"> <!-- DISCOUNT BANNER IMAGE -->
                                <img src="assets/banner_product_2.png" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_2">
                            </div>

                            <div class="carousel-item active"> <!-- DISCOUNT BANNER IMAGE -->
                                <img src="assets/banner_product_3.png" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_3">
                            </div>

                            <div class="carousel-item active"> <!-- DISCOUNT BANNER IMAGE -->
                                <img src="assets/banner_product_4.webp" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_4">
                            </div>

                            <!-- Special events discount banners -->
                            <?php
                                // Check if it's November (month number 11), for black friday discounts
                                if (date('m') == '11') {
                                    echo '<div class="carousel-item active">
                                            <img src="assets/banner_product_blackfriday_sale.webp" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_blackfriday_sale">
                                          </div>';
                                }
                                
                                // Check if it's December (month number 12), for christmas discounts
                                if(date('m') == '12') {
                                    echo '<div class="carousel-item active">
                                            <img src="assets/banner_product_christmas_sale.webp" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_christmas_sale">
                                          </div>';
                                }

                                // Check if it's October (month number 10), for halloween discounts
                                if(date('m') == '10') {
                                    echo '<div class="carousel-item active">
                                            <img src="assets/banner_product_halloween_sale.webp" class="d-block w-100 img-fluid" style="object-fit: cover; width: 100%; height: 100%;" alt="A banner displaying latest news" id="banner_product_halloween_sale">
                                          </div>';
                                }
                            ?>
                        </div>

                        <!-- Left and Right Arrows -->
                        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </a>
                </div>
            </div>
        </div>

        <!-- Advertise selling accounts to user -->
        <div class = "container-xxl text-center"> 
            <div class="d-flex align-items-center justify-content-center">
                <span class = "display-6 font-monospace fw-bold p-1 m-2">Join the family. Start selling sneakers now  </span>
                <button type="button" class="btn btn-outline-primary btn-lg m-3" data-bs-toggle="modal" data-bs-target="#myModal" id = "become-seller"> Begin Journey </button></a>
            </div>
        </div>

        <!-- Modal for the above code, when button clicked activate this modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl d-flex justify-content-center align-items-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-monospace fw-bold text-primary" id="modalLabel">Create your selling account with us</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="https://images.solecollector.com/complex/images/c_crop,h_608,w_1080,x_0,y_186/c_fill,dpr_2.0,h_182,q_70,w_328/n7jbkn4apfjyiz1jn9le/silhouette-usa-transformation-church-sneaker-buyout" class="img-fluid rounded" alt="Your Image">
                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold text-primary">Join the family and become a seller now. Here are some of the benefits:</p>
                                <ul>
                                    <li>Reach a global audience of sneaker enthusiasts.</li>
                                    <li>Expand your brand and grow your business.</li>
                                    <li>Access powerful marketing tools to promote your products.</li>
                                    <li>Connect with like-minded sellers and share your passion for sneakers.</li>
                                    <li>Enjoy a user-friendly platform for managing your listings and orders.</li>
                                </ul>
                                <p>Don't miss out on this amazing opportunity. Get started <span class="text-primary fw-bold">today!</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href = "comingsoon.php"><button id="become-seller"> Start now </button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product recomendation-->
        <div class="container text-center" id="imageContainer">
            <p class="h2 font-monospace fw-bold m-5 animate__animated animate__pulse">See what is trending around you</p>
            <div class="row justify-content-center" id="imageContainer">
                <?php
                    $sneakerData = $sneakerapiResponse['results'];
                    shuffle($sneakerData);

                    foreach ($sneakerData as $index => $sneaker) {
                        $imageURL = $sneaker['image']['original'];
                        if(!empty($imageURL)){
                            echo '<div class="col-6 col-md-4 mb-4">
                                <div class="card shadow" id = "product_card_index">
                                    <a href = "marketplace.php"><img src="' . $imageURL . '" class="card-img-top mx-auto d-block" alt="popular_sneaker_image"></a>
                                </div>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>

        <div class="container text-center">
            <hr class="bg-primary w-25 mx-auto">
        </div>
        
        <!-- Brand recomendations -->
        <div class="container text-center my-5">
            <h2 class="font-monospace fw-bold m-2">Browse more brands</h1>
            <p class="lead text-mute m-0">We think these may interest you</p>

            <div class="row">
                <div class="col-4">
                    <a href="marketplace.php">
                        <img src="https://images.fineartamerica.com/images/artworkimages/medium/3/bape-logo-bape-collab-transparent.png" alt="popular_brand_1" class="img-fluid image-hover">
                    </a>
                </div>

                <div class="col-4" style="margin-top: 100px;">
                    <a href="marketplace.php">
                        <img src="https://staticg.sportskeeda.com/editor/2023/03/b579f-16776871165574-1920.jpg" alt="popular_brand_2" class="img-fluid image-hover">
                    </a>
                </div>

                <div class="col-4">
                    <a href="marketplace.php">
                        <img src="https://admin.showstudio.com/images/ynvX_Z118ksae-rfslrFi_A0Ou8=/383435/width-1280/YEEZY_LOGO.jpg" alt="popular_brand_3" class="img-fluid image-hover">
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Help section, user can find the store or else contact sneakerology via the help page -->
        <div class = "container">
            <h2 class="font-monospace fw-bold text-center m-1">Questions?</h2>
            <p class = "lead text-mute m-2 text-center">You can either email us or find us</p>

            <div class="container m-3">
                <div class="row">
                    <div class="col-md-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.4627752401275!2d-73.67463752426795!3d40.79582337138107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2888e80303743%3A0x7396e9013d093f27!2sSneakerology!5e0!3m2!1sen!2smt!4v1697541996458!5m2!1sen!2smt" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="col-md-6">
                        <div class = "container bg-black text-white text-center p-3">
                            <p class = "lead fw-bold font-monospace text-center">Contact us here:</p>
                            <hr class="bg-primary w-25 mx-auto">
                            <p>Call us <i class="fas fa-phone"></i> : +1 516-627-7400</p>
                            <p>Email us <i class="fas fa-envelope"></i> : <a href="mailto:sneakerologyBuisness@gmail.com">sneakerologyBuisness@gmail.com</a></p>
                            <p class = "fw-bold lead"> Cant solve your issue? Visit the <a href = "help.php" class = "text-decoration-none"><span class = "text-primary" id = "help-section">help</span></a> section</h3>
                        </div>
                        
                        <div class = "container text-center bg-light text-black">
                            <p class = "lead font-monospace">Our store is open on:</p>
                            <p class="mb-3"><span class="fw-bold">Monday:</span> 9:00 AM - 6:00 PM</p>
                            <p class="mb-3"><span class="fw-bold">Tuesday:</span> 9:00 AM - 6:00 PM</p>
                            <p class="mb-3"><span class="fw-bold">Wednesday:</span> 9:00 AM - 6:00 PM</p>
                            <p class="mb-3"><span class="fw-bold">Thursday:</span> 9:00 AM - 6:00 PM</p>
                            <p class="mb-3"><span class="fw-bold">Friday:</span> 10:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Javascript Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                        
        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>

    </body>
</html>
