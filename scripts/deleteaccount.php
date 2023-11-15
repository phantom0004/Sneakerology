<?php
    require '../includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement to retrieve the hashed password
        $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['user_password'])) {
            // Password is correct, proceed to delete the user
            $deleteStmt = $conn->prepare("DELETE FROM users WHERE user_email = :email");
            $deleteStmt->bindParam(':email', $email);
            $deleteStmt->execute();

            // Notify user and redirect using JavaScript
            echo "<script> 
                alert('Your account has been successfully deleted. You will now be logged out'); 
                window.location.href = 'logout.php'; 
            </script>";

            closeConnection();
            exit;
        } else {
            // Handle incorrect credentials
            echo "<script> alert('Incorrect email or password. Please ensure account details are correct'); window.location.href = '../index.php'; </script>";

            closeConnection();
            exit;
        }
    }
?>
