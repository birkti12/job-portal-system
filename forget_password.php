<?php
// Start the session and connect to the database
session_start();
// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the username or email value
    $email = $_POST['email'];

    // Check if the username or email exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        // Generate a token and insert it into the res_password table
        $token = base64_encode(random_bytes(32));
        $sql = "INSERT INTO res_password (email, token) VALUES ('$email', '$token')";
        mysqli_query($conn, $sql);

        // Redirect to the reset_password.php page with the token as a query parameter
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    } else {
        $_SESSION['error'] = "email address not found.";
    }
}
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
        .input-group {
    display: flex;
}

.input-group input[type="email"] {
    flex-grow: 1;
    margin-right: 10px;
}

.input-group button[type="submit"] {
    width: auto;
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

        input[type="text"] {
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
        echo "Enter your email address to reset your password";
    }
    ?>
<form method="post" action="forget_password.php">
    <label for="email">Email:</label>
    <div class="input-group">
        <input type="email" name="email" required>
        <button type="submit" name="submit">Reset Password</button>
    </div>
</form>
</div>
</body>
</html>
