<?php
session_start();



require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Transparent Sign Up Form</title>
	<link rel="stylesheet" href="style2.css">
</head>
<body>
	<div class="container">
		
        <form method="post" id="registerEmployee" action="addemployee.php" enctype="multipart/form-data">
			<h2>Sign Up</h2>
			<label for="first-name">First Name</label>
			<input type="text" id= "first_name"  name="firstname" required>
			<label for="last-name">Last Name</label>
			<input type="text"  name="lastname" required>
			<label for="email">Email</label>
			<input type="email"  name="email" required>
			<label for="password">Password</label>
			<input type="password"  name="password" required>
			<label for="confirm-password">Confirm Password</label>
			<input type="password"  name="confirm_password" required>
			<button type="submit">Sign Up</button>
<p>Already have an account? <a href="employee/index.php">Login</a></p>
		</form>
	</div>
</body>
</html>