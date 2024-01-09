<?php
// Start the session and connect to the database
session_start();
// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// Check if the token is provided in the query string
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the res_password table
    $sql = "SELECT * FROM res_password WHERE token='$token'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        // Display the password reset form
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                /* CSS styles for responsive design */
                body {
                    font-family: Arial, sans-serif;
                }

                .container {
                    max-width: 500px;
                    margin: 0 auto;
                    padding: 20px;
                }

                .container:hover {
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                }

                label {
                    display: block;
                    margin-bottom: 10px;
                }

                input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                }

                button[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 12px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    width: 100%;
                }

                button[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            } else {
                echo "Enter your new password";
            }
            ?>

<form method="post" action="update_password.php">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <label for="password">New Password:</label>
    <input type="password" name="password" id="password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
    <button type="submit" name="submit">Reset Password</button>
</form>
        </div>
        </body>
        </html>

        <?php
    } else {
        $_SESSION['error'] = "Invalid token.";
        header("Location: forget_password.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Token not provided.";
    header("Location: forget_password.php");
    exit();
}
?>

