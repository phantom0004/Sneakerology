<?php
    session_start();
    require '../includes/config.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];

        //Username is stored in the session
        $username = $_SESSION['username'];

        // Validate new password
        if (strlen($newPassword) < 10 || !preg_match("#[0-9]+#", $newPassword)) {
            echo "<script> 
                    alert('New password does not meet the criteria.'); 
                    window.location.href = '../index.php'; // Adjust the redirect URL as needed
                </script>";
            exit;
        }

        // Prepare the SQL statement to retrieve the hashed password
        $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['user_password'])) {
            // Old password is correct, hash new password and update
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt = $conn->prepare("UPDATE users SET user_password = :newPassword WHERE user_username = :username");
            $updateStmt->bindParam(':newPassword', $newHashedPassword);
            $updateStmt->bindParam(':username', $username);
            $updateStmt->execute();

            if ($updateStmt->rowCount()) {
                //Password successfully changed
                echo "<script> alert('Password successfully updated. Please login again to try your new password'); window.location.href = '../index.php'; </script>";
            } else {
                //Error updating password
                echo "<script> alert('Error updating password. Please try again in a few moments.'); window.location.href = '../index.php'; </script>";
            }
        } else {
            // Old password doesn't match
            echo "<script> alert('Incorrect old password. Please try again!'); window.location.href = '../index.php'; </script>";
        }

        closeConnection();
    }
?>
