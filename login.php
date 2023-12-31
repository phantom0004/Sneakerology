<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sneakerology | Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/icons/login.ico">

        <!-- Bootstrap HTML Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php require 'includes/header.php'; ?>
            <?php require "includes/config.php" ?>
            
            <!-- SweetAlert2 library for customized alerts -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </header>
        
        <!-- Section to log the user in -->
        <section class="vh-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 text-black">

                        <div class="px-5 ms-xl-4 m-4">
                            <span class="lead font-monospace fw-bold">Login to access all features of Sneakerology</span>
                            <p class = "lead text-muted "><i>Or create an account</i></p>
                        </div>

                        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 pt-xl-0 mt-xl-n5">
                            <form method = "post" action = "login.php" style="width: 23rem;">
                                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Enter your details:</h3>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" id="email" name = "email" class="form-control form-control-lg" required>                            
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name = "password" class="form-control form-control-lg" required>
                                </div>

                                <div class="mb-4 text-center"> <!-- If password doesnt match show this code -->
                                    <input type="submit" name="submit" id="loginButton" class="btn btn-outline-primary btn-lg btn-block" value="Login">
                                    <p id = "incorrect_password_prompt" class = "lead text-danger fw-bold m-5" style = "display: none;">Email or password incorrect!</p>
                                </div>

                                <p>Don't have an account? <a href="signup.php" class="text-primary">Register an account with us</a></p> <!-- Create account option -->
                            </form>
                        </div>
                    </div>

                    <!-- Custom image to customize the login page -->
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="assets\sneakersloginwallpaper.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                    </div>
                </div>
            </div>
        </section>

        <style> /* Minimal inline CSS to style for the content above */
            .bg-image-vertical {
                position: relative;
                overflow: hidden;
                background-repeat: no-repeat;
                background-position: right center;
                background-size: auto 100%;
            }

            @media (min-width: 1025px) {
                .h-custom-2 {
                    height: 70%;
                }
            }
        </style>

        <!-- Handles login functions -->
        <?php
            //Checks if submit as been pressed
            if(isset($_POST["submit"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                try{
                    //Comparing data with a query
                    $login = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
                    $login->bindParam(':email', $email); //Avoids SQL injection

                    //Execute query
                    $login->execute();
            
                    //Fetch information from database (using PDO)
                    $data = $login->fetch(PDO::FETCH_ASSOC); //Fetches rows affected
            
                    //Check for row count, this will return the row number that matches the credentials
                    if($login->rowCount() > 0){ //Check if there is more then one row affected
                        if(password_verify($password,$data['user_password'])){ //Use the password_verify function (It will hash then verify)
                            $_SESSION["username"] = $data["user_username"];
                            $_SESSION["email"] = $data["user_email"];
                            $_SESSION["username"] = $data["user_username"];
                            
                            $username = $data["user_username"];
                            
                            //This is for the custom message that appiers after the login
                            echo "<script>
                            Swal.fire({
                                title: 'Welcome back $username!',
                                text: 'You can now continue to use your account features',
                                icon: 'success',
                                confirmButtonText: 'Go to the home page',
                                confirmButtonColor: '#3085d6'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            });
                          </script>";
                    }
                    
                    //Customises the page to display an error message if the user enters the wrong credentials
                    } else {
                        echo  "<script>
                                    var passwordInput = document.getElementById('password');
                                    var emailInput = document.getElementById('email');

                                    passwordInput.style.borderWidth = '3px';
                                    passwordInput.style.borderColor = 'red';

                                    emailInput.style.borderWidth = '3px';
                                    emailInput.style.borderColor = 'red';

                                    setTimeout(function() {
                                        passwordInput.style.borderWidth = '1px';
                                        passwordInput.style.borderColor = '#ced4da';

                                        emailInput.style.borderWidth = '1px';
                                        emailInput.style.borderColor = '#ced4da';
                                    }, 1500);
                                </script>";

                        echo "<script>
                                document.getElementById('incorrect_password_prompt').style.display = 'block';

                                setTimeout(function() {
                                    document.getElementById('incorrect_password_prompt').style.display = 'none';
                                }, 1500);
                            </script>";
                    }
                }
                catch (PDOException $error){ //Display a friendly error if there was an error with the login
                    print("<script> window.alert('Oops! An unforseen error has occured, please attempt to login at a later time'); </script>");
                }
              }
        ?>

        <!-- Close the database connection -->
        <?php closeConnection(); ?> 

        <footer>
            <?php require 'includes/footer.html'; ?>
        </footer>

        <!-- Bootstrap Javascript Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
