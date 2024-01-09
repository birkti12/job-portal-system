<?php
// Start the session and connect to the database
session_start();
// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the token and new password values
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password === $confirmPassword) {
        // Check if the token exists in the res_password table
        $sql = "SELECT * FROM res_password WHERE token='$token'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];

            // Update the password in the users table
            // Hash the password using base64_encode(strrev(md5($password))) before storing it
            $hashedPassword = base64_encode(strrev(md5($password)));
            $sql = "UPDATE users SET password='$hashedPassword' WHERE email='$email'";
            mysqli_query($conn, $sql);

            // Delete the token from the res_password table
            $sql = "DELETE FROM res_password WHERE token='$token'";
            mysqli_query($conn, $sql);

            $_SESSION['success'] = "Password updated successfully.";
            header("Location: login.php"); // Redirect to the login page or any other desired page
            exit();
        } else {
            $_SESSION['error'] = "Invalid token.";
            header("Location: forget_password.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Password and confirm password do not match.";
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: forget_password.php");
    exit();
}
?>