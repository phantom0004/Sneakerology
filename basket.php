<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Basket</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/basket.ico">

        <!-- Canvas Confetti script -->
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2"></script>
        <!-- Bootstrap HTML Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Jquery library for API usage -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Used for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>

            <!-- Discount API to handle checking of discount code -->
            <?php require 'includes/API/discountcodeAPI.php' ?>

            <!-- Function for handling API discount response -->
            <script src = "scripts/discountfunction.js"></script>

            <script src = "scripts/basket.js"></script>
        </header>

        <div class="py-5 text-center">
            <h2 class = "fw-bold display-5">Basket Summary</h2>
        </div>

        <div class="container">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill" id="items-basket">0</span>
                    </h4>

                    <?php
                        if (isset($_POST["submit"])) {
                            // Append the new item to the basketItems session array
                            $_SESSION['basketItems'][] = [
                                'shoeName' => $_POST['shoeName'],
                                'retailPrice' => $_POST['retailPrice']
                            ];
                        }
                    ?>

                    <?php
                        if (isset($_POST['clearBasket'])) {
                            // Clear the basketItems session array
                            $_SESSION['basketItems'] = [];
                        }                        
                    ?>
                    <ul class="list-group mb-3" id="basket-list">
                        <!-- This will be populated dynamically using JavaScript -->
                    </ul>

                    <script>
                        function displayBasketItems() {
                            var basketList = document.getElementById('basket-list');
                            var basketItems = <?php echo json_encode($_SESSION['basketItems']) ?> || [];

                            var list = '';
                            if (basketItems.length > 0) {
                                basketItems.forEach(function (item) {
                                    var price = parseFloat(item.retailPrice);
                                    if (!isNaN(price)) { // Check if price is a valid number
                                        list += '<li class="list-group-item d-flex justify-content-between lh-sm">' +
                                            '<div><h6 class="my-0">' + item.shoeName + '</h6></div>' +
                                            '<span class="text-muted">' + '€' + price.toFixed(2) + '</span>' +
                                            '</li>';
                                    } else {
                                        window.alert('Invalid price for item:', item);
                                    }
                                });
                                document.getElementById('items-basket').textContent = basketItems.length;
                            } else {
                                list = '<li class="list-group-item">Your basket is currently empty</li>';
                                document.getElementById('items-basket').textContent = '0';
                            }

                            basketList.innerHTML = list;
                        }

                        document.addEventListener('DOMContentLoaded', displayBasketItems);
                    </script>

                    <?php
                        // Calculate the total price
                        $totalPrice = 0;
                        if (isset($_SESSION['basketItems']) && is_array($_SESSION['basketItems'])) {
                            foreach ($_SESSION['basketItems'] as $item) {
                                $totalPrice += floatval($item['retailPrice']);
                            }
                        }
                    ?>

                    <form action="includes/API/discountcodeAPI.php" method="post" class="card p-2" id="discount-form">
                        <div class="input-group">
                            <input type="text" class="form-control" id="discount-code" name="discount-code" placeholder="Sneakerology Discount Code" required>
                            <input type="submit" class="btn btn-outline-danger" value="Apply Discount">
                        </div>

                        <div class = "font-monospace text-center mt-2" id="message"></div>
                    </form>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <form action="basket.php" method="POST">
                            <button type="submit" name="clearBasket" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-trash-alt"></i> Clear all items in basket
                            </button>
                        </form>

                        <?php
                            // Calculate the total price
                            $totalPrice = 0;
                            if (isset($_SESSION['basketItems']) && is_array($_SESSION['basketItems'])) {
                                foreach ($_SESSION['basketItems'] as $item) {
                                    $totalPrice += floatval($item['retailPrice']);
                                }
                            }
                        ?>

                        <p class="mb-0 text-primary">Your total: <span class = "fw-bold"> €<?php echo number_format($totalPrice, 2); ?> </span></p>
                    </div>
                    <p class = "lead text-muted text-center mt-3"> Final price will be calculated at checkout </p>
                </div>
                
                <!-- Discount messages styles (error and success) -->
                <style>
                    .success-message {
                        color: green;
                    }

                    .error-message {
                        color: red;
                    }
                </style>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3 text-primary">Billing address</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email to receive updates (optional)</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Delivery Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country" required>
                                <option value="">Choose ...</option>
                                <option>Malta</option>
                                <option>Gozo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">City</label>
                            <select class="form-select" id="city" required>
                                <option value="">Choose ...</option>
                                <option>Valletta</option>
                                <option>Sliema</option>
                                <option>St. Julian's</option>
                                <option>Mdina</option>
                                <option>Rabat</option>
                                <option>Qawra</option>
                                <option>Birgu (Vittoriosa)</option>
                                <option>Victoria</option>
                                <option>Xlendi</option>
                                <option>Xewkija</option>
                                <option>Zurrieq</option>
                                <option>Swieqi</option>
                                <option>Luqa</option>
                                <option>Zebbug (Gozo)</option>
                                <option>Marsaxlokk</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" required>
                        </div>
                    </div>
                    <div class="form-check my-5">
                        <input type="checkbox" class="form-check-input" id="same-address">
                        <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="save-info">
                        <label class="form-check-label" for="save-info">Save this information for next time</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <hr class="bg-primary w-25 mx-auto">
        </div>

        <h4 class="mb-3 text-center text-primary">Proceed with payment details</h4>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-5">
                <form id="paymentForm" action="basket.php" method="post" onsubmit="return validateForm()">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <p class="fw-bold mb-4">Add your card details:</p>
                            <div class="form-outline mb-4">
                                <input type="text" id="formControlLgXsd" class="form-control form-control-lg" placeholder="John Doe" required />
                                <label class="form-label" for="formControlLgXsd">Cardholder's Name</label>
                            </div>
                            <div class="row mb-4">
                                <div class="col-7">
                                    <div class="form-outline">
                                        <input type="password" id="formControlLgXM" class="form-control form-control-lg" placeholder="1234 5678 1234 5678" required />
                                        <label class="form-label" for="formControlLgXM">Card Number</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-outline">
                                        <input type="text" id="formControlLgExpk" class="form-control form-control-lg" placeholder="MM/YYYY" required />
                                        <label class="form-label" for="formControlLgExpk">Expire</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-outline">
                                        <input type="text" id="formControlLgcvv" class="form-control form-control-lg" placeholder="Cvv" required />
                                        <label class="form-label" for="formControlLgcvv">Cvv</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Proceed to checkout" class="btn btn-outline-primary btn-lrg w-100 mt-4" />
                </form>
            </div>
        </div>

        <div class="bg-secondary py-3 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <p class="mb-0 fw-bold">All transactions are encrypted and safe.</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <img src="https://img.icons8.com/color/48/000000/lock--v1.png" alt="Secure Icon" width="24" height="24" class="me-2">
                        <img src="https://img.icons8.com/color/48/000000/shield.png" alt="Shield Icon" width="24" height="24" class="me-2">
                        <img src="https://img.icons8.com/color/48/000000/security-checked.png" alt="Security Checked Icon" width="24" height="24">
                    </div>
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