<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Used for icons -->
    </head>
    <body>
        <?php session_start(); ?> <!-- Automatically add session start to all files -->
        <?php ini_set('display_errors', 0); // Hides all errors for security reasons ?>

        <header>
            <!-- Add loading screen animation -->
            <?php include 'includes/loadingscreen.html'; ?>

            <!-- Checks if the user is on the right page, if not go to 404 -->
            <?php
                $requested_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); // Get the path from the URL

                //All avaliable pages to navigate
                $valid_pages = array(
                    "basket.php",
                    "comingsoon.php",
                    "help.php",
                    "index.php",
                    "login.php",
                    "marketplace.php",
                    "ourmission.php",
                    "signup.php"
                );

                if (!in_array($requested_page, $valid_pages)) {
                    header("Location: ../pagenotfound.html");
                    exit; // Terminate the script to prevent further processing
                }
            ?>

            <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid">          
                <a class="navbar-brand" href="index.php">
                    <img src="assets/sneakerologylogo.png" alt="sneakerology-logo" width="120" height="90" class="d-inline-block ">
                    <span class="fw-bold font-monospace">Sneakerology.</span>
                </a>
                <div class = "ms-auto">           
                    <ul class="navbar-nav">
                        <li class="nav-item ps-5 <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active glowing'; ?>">
                            <a class="nav-link font-monospace" href="index.php"><i class="fas fa-home text-primary"></i> Home</a>
                        </li>

                        <li class="nav-item ps-5 <?php if(basename($_SERVER['PHP_SELF']) == 'ourmission.php') echo 'active glowing'; ?>">
                            <a class="nav-link font-monospace" href="ourmission.php"><i class="fas fa-bullseye text-primary"></i> Our Mission</a>
                        </li>

                        <li class="nav-item ps-5 <?php if(basename($_SERVER['PHP_SELF']) == 'marketplace.php') echo 'active glowing'; ?>">
                            <a class="nav-link font-monospace" href="marketplace.php"><i class="fas fa-store text-primary"></i> Marketplace</a>
                        </li>

                        <?php if(!isset($_SESSION["username"])) : ?>
                            <li class="nav-item ps-5 <?php if(basename($_SERVER['PHP_SELF']) == 'login.php') echo 'active glowing'; ?>">
                                <a class="nav-link font-monospace" href="login.php"><i class="fas fa-sign-in-alt text-primary"></i> Login</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item ps-5 <?php if(basename($_SERVER['PHP_SELF']) == 'help.php') echo 'active glowing'; ?>">
                            <a class="nav-link font-monospace" href="help.php"><i class="fas fa-question-circle text-primary"></i> Help</a>
                        </li>

                        <li class="nav-item ps-5 <?php if(basename($_SERVER['PHP_SELF']) == 'basket.php') echo 'active glowing'; ?>">
                            <a class="nav-link font-monospace" href="basket.php"><i class="fas fa-shopping-basket text-primary"></i> View Basket</a>
                        </li>

                        <?php if(isset($_SESSION["username"])) : ?>
                            <li class="nav-item dropdown ps-5">
                                <a class="nav-link dropdown-toggle p-2" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fa fa-user me-2"></i> <?php echo $_SESSION["username"]; ?> <span class = "fst-italic text-primary fw-bold">Status : Buyer</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fas fa-cog"></i> Account Settings</a></li>
                                    <li><a class="dropdown-item" href="includes/logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </div>     
            </nav>
            
            <!-- Styles the current page you are on in the-->
            <style> 
                @keyframes glow {
                    0% {
                        text-shadow: 0 0 5px rgba(13, 110, 253, 0.3), 0 0 10px rgba(13, 110, 253, 0.3);
                    }
                    50% {
                        text-shadow: 0 0 10px rgba(13, 110, 253, 0.6), 0 0 15px rgba(13, 110, 253, 0.6);
                    }
                    100% {
                        text-shadow: 0 0 5px rgba(13, 110, 253, 0.3), 0 0 10px rgba(13, 110, 253, 0.3);
                    }
                }

                .glowing {
                    animation: glow 2s infinite;
                    font-weight: bold;
                }
            </style>

            <!-- Modal to view your account information -->
            <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title font-monospace fw-bold" id="modalLabel">Your account with Sneakerology</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-0"> 
                            <div class="card profile">

                                <div class="upper text-center">
                                    <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid w-100 mb-3" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                </div>

                                <div class="text-center justify-content-center align-items-center"> 
                                    <div class="profile">
                                        <img src="https://icons.veryicon.com/png/o/education-technology/alibaba-big-data-oneui/user-profile.png" class="rounded-circle" width="80">
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <h4 class="mb-0 fw-bold"><?php echo $_SESSION["username"]; ?></h4>
                                    <span class="text-muted d-block lead mb-2">Malta</span>
                                    <a href = "comingsoon.php"><button class="btn btn-dark btn-sm w-20" style="border-radius: 15px;">Edit your account</button></a>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 px-4">
                                    <div class="stats">
                                        <h6 class="mb-0">Followers</h6>
                                        <span class = "fw-bold">0</span>
                                    </div>
                                    <div class="stats">
                                        <h6 class="mb-0">Sneakers Bought</h6>
                                        <span class = "fw-bold">0</span>
                                    </div>
                                    <div class="stats">
                                        <h6 class="mb-0">Sneakers Sold</h6>
                                        <span class = "fw-bold">0</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </header>
    </body>
</html>