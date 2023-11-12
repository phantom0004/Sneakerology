<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Help</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/help.ico">
        <!-- Bootstrap HTML Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>
        </header>
        
        <h1 class = "text-center display-5 m-3"> Have an issue? We are here to <span class = "text-primary">help</span></h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body p-4 p-md-5 p-xl-6">
                            <div class="text-center mb-3 mb-lg-6">
                                <span class="section-title text-primary fw-bold">FAQ's</span>
                                <h2 class="h1 mb-4 text-secondary">Frequently Asked Questions</h2>
                            </div>
                            <div id="accordion">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                                <span class="text-theme-secondary me-2">Q.</span> How Do I Find the Right Sneaker Size?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            Discover our easy-to-follow sizing guide to ensure a perfect fit. We provide tips and charts to help you select the right size.
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                                <span class="text-theme-secondary me-2">Q.</span> What Makes Our Sneakers Unique?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                        <div class ="card-body">
                                            Our sneakers stand out with their blend of premium materials, stylish designs, and a commitment to sustainability. Find out what sets us apart.
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                                <span class="text-theme-secondary me-2">Q.</span> Can I Track My Order Status?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            Yes, you can easily track your order's progress through our tracking system. We keep you informed every step of the way.
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingFour">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                                <span class="text-theme-secondary me-2">Q.</span> What's Your Return Policy?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            We offer a hassle-free return policy. If your sneakers don't meet your expectations, you can return them within a specific time frame.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                                <span class="text-theme-secondary me-2">Q.</span> Are Your Sneakers Suitable for Sports and Active Lifestyle?
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            Our sneakers are versatile and suitable for various activities, including sports and an active lifestyle. Experience comfort and support in every step.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            .card-header .btn-link {
                text-decoration: none;
                font-weight: bold;
            }
        </style>

        <hr class="bg-primary w-25 mx-auto m-5">
        <p class = "text-center display-5 m-3">Still stuck? Reach out to us</p>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-style3 border-0 shadow">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h3 mb-4 text-primary text-center">We will provide you with our best help</h2>
                            <form>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id="firstname" class="form-control" required />
                                            <label class="form-label" for="firstname">First name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type = "text" id="lastname" class="form-control" required />
                                            <label class="form-label" for="lastname">Last name</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" class="form-control" required />
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <!-- Number input -->
                                <div class="form-outline mb-4">
                                    <input type="number" id="phone" class="form-control" required />
                                    <label class="form-label" for="phone">Phone (Include the +)</label>
                                </div>

                                <!-- Message input -->
                                <div class="form-outline mb-4">
                                    <textarea class="form-control" id="question" rows="4"></textarea>
                                    <label class="form-label" for="question">Please explain the issue you face in detail</label>
                                </div>

                                <!-- Submit button (centered) -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" onclick = "message()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Displays a confirmation message to user -->
        <script> 
            function message() {
                // Get the form element
                var form = document.querySelector('form');

                // Add an event listener to the form submission
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from actually submitting

                    // Display the alert message
                    alert("Thank you for submitting your question! We will get back to you via email shortly.");
                });
            }
        </script>

        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>

        <!-- Bootstrap Javascript Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
