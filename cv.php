<!DOCTYPE html>
<html>
<head>
	<title>CV Form</title>
	<style>
		label {
			display: inline-block;
			width: 100px;
			margin-bottom: 10px;
		}
		input[type="text"], textarea {
			width: 300px;
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 4px;
			resize: none;
		}
		textarea {
			height: 100px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>CV Form</h1>
	<form method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" required>
		<br>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" required>
		<br>
		<label for="phone">Phone:</label>
		<input type="tel" name="phone" id="phone" required>
		<br>
		<label for="address">Address:</label>
		<input type="text" name="address" id="address" required>
		<br>
		<label for="education">Education:</label>
		<textarea name="education" id="education" required></textarea>
		<br>
		<label for="experience">Experience:</label>
		<textarea name="experience" id="experience" required></textarea>
		<br>
		<label for="skills">Skills:</label>
		<textarea name="skills" id="skills" required></textarea>
		<br>
		<input type="submit" value="Submit">
	</form>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			$address = $_POST["address"];
			$education = $_POST["education"];
			$experience = $_POST["experience"];
			$skills = $_POST["skills"];

			echo "<h2>CV Preview</h2>";
			echo "<p><strong>Name:</strong> $name</p>";
			echo "<p><strong>Email:</strong> $email</p>";
			echo "<p><strong>Phone:</strong> $phone</p>";
			echo "<p><strong>Address:</strong> $address</p>";
			echo"<h3>Education:</h3>";
			echo "<p>$education</p>";
			echo "<h3>Experience:</h3>";
			echo "<p>$experience</p>";
			echo "<h3>Skills:</h3>";
			echo "<p>$skills</p>";
		}
	?>
</body>
</html>