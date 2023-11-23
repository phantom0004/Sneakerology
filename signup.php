<?php require 'includes/config.php' ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | SignUp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/signin.ico">

        <!-- Bootstrap HTML Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>
            
            <!-- SweetAlert2 library for customized alerts -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Used for confetti animation -->
            <script src='https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2'></script>";
        </header>
        
        <section class="vh-200 mt-3" id="section-background">
            <div class="mask d-flex align-items-center h-100">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 20px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase font-monospace text-center fw-bold">Create an account with us</h2>
                                    <p class="lead text-muted text-center">Unlock all features possible</p>

                                    <div class="mb-4 text-center">
                                        <p id="incorrect_password_prompt_password" class="lead text-danger fw-bold m-2" style="display: none;">Make sure the password exceeds 10 characters and has at least one number</p>
                                        <p id="incorrect_password_prompt_username" class="lead text-danger fw-bold m-2" style="display: none;">Email or username already in use</p>
                                        <p id="incorrect_password_prompt_password_match" class="lead text-danger fw-bold m-2" style="display: none;">Repeated passwords do not match</p>
                                    </div>

                                    <form method="post" action="signup.php">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="fullname">Your Full Name</label>
                                            <input type="text" id="fullname" name = "fullname" class="form-control form-control-lg" required>      
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="fullname">Your Username</label>
                                            <input type="text" id="username" name = "username" class="form-control form-control-lg" required>      
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Your Email</label>
                                            <input type="email" id="email" name = "email" class="form-control form-control-lg" required>                                           
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Your Password</label>
                                            <br>
                                            <small class = "text-muted">Ensure it has more then 10 characters and has at least a number</small>
                                            <input type="password" id="password" name = "password" class="form-control form-control-lg" required>                                         
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="repeatpassword">Repeat your password</label>
                                            <input type="password" id="repeatpassword" name="repeatpassword" class="form-control form-control-lg" required>
                                        </div>

                                        <div class="mb-4 text-center"> <!-- If password doesnt match the repeated password show this code -->
                                            <p id = "incorrect_password_prompt" class = "lead text-danger fw-bold m-5" style = "display: none;">Repeated password doesnt match!</p>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-3">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="termsandconditions" required>
                                            <label class="form-check-label" for="termsandconditions"> I read and agreed to the <a href="https://www.aliveshoes.com/sneakerology-god/terms" target=_blank class="text-primary">Terms of service</a> </label>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" value="Register now" name="submit" class="btn btn-outline-primary btn-block btn-lg w-100">
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Have already an account?<a href="login.php" class="fw-bold text-primary">Login here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var passwordInput = document.getElementById('password');
                var errorPrompt = document.getElementById('incorrect_password_prompt_password');

                passwordInput.addEventListener('input', function () {
                    var passwordValue = passwordInput.value;
                    var hasNumber = /\d/.test(passwordValue);

                    if (passwordValue.length <= 10 || !hasNumber) {
                        errorPrompt.style.display = 'block';
                    } else {
                        errorPrompt.style.display = 'none';
                    }
                });
            });
        </script>

        <!-- Styles the background -->
        <style>
            #section-background {
                background-image: url('https://img.freepik.com/free-vector/wave-background-minimalist-color-gradient_483537-3378.jpg?w=1060&t=st=1698688680~exp=1698689280~hmac=dea58b0b94f526bb003e62aa6fcf0359d634e83ffd951fef1fd29f528f5e2bfa');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                text-align: center;
            }
        </style>

        <?php
            if (isset($_POST["submit"])) {
                $user_fullname = $_POST["fullname"];
                $user_username = $_POST["username"];
                $user_email = $_POST["email"];
                $user_password = $_POST["password"];
                $user_password_confirmation = $_POST["repeatpassword"];

                // Check if email or username already exists
                $checkQuery = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_username = :user_username OR user_email = :user_email");
                $checkQuery->execute([
                    ":user_username" => $user_username,
                    ":user_email" => $user_email,
                ]);
                $count = $checkQuery->fetchColumn();

                if ($count > 0) {
                    // Email or username already exists
                    echo "<script>document.getElementById('incorrect_password_prompt_username').style.display = 'block';</script>";
                } else {
                    if ($user_password === $user_password_confirmation) {
                        try {
                            $insert = $conn->prepare("INSERT INTO users (user_username, user_email, user_password, full_name) VALUES (:user_username, :user_email, :user_password, :user_fullname)");
                            $insert->execute([
                                ":user_username" => $user_username,
                                ":user_email" => $user_email,
                                ":user_password" => password_hash($user_password, PASSWORD_DEFAULT),
                                ":user_fullname" => $user_fullname,
                            ]);

                            echo "<script>
                                confetti({ 
                                    particleCount: 500,
                                    spread: 120,
                                    origin: { y: 0.6 }
                                }); 

                                setTimeout(function() {
                                    Swal.fire({
                                        title: 'Thank you for creating an account with Sneakerology!',
                                        text: 'You may now proceed to use all benefits, including buying, selling and much more',
                                        icon: 'success',
                                        confirmButtonText: 'I understand, take me to the login page',
                                        confirmButtonColor: '#3085d6'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'login.php';
                                        }
                                    });
                                }, 1000);
                            </script>";
                            
                        } catch (PDOException $error) {
                            echo "An error has occurred: " . $error->getMessage();
                        }
                    } else {
                        echo "<script>document.getElementById('incorrect_password_prompt_password').style.display = 'block';</script>";
                    }
                }
            }
        ?>

        <!-- Close the database connection -->
        <?php closeConnection(); ?> 

        <!-- Bootstrap Javascript Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>

    </body>
</html>
