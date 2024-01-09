<?php
// Assuming you have already established a database connection
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
// Retrieve the form data
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$company = $_POST['company'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$jobTitle = $_POST['jobtitle'];
$jobDescription = $_POST['job_description'];

// Insert the preferences into the preference table
$insertQuery = "INSERT INTO preference (pre_id, email, qualification, company, country, state, city, job_title, job_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("issssssss", $_SESSION['pre_id'], $email, $qualification, $company, $country, $state, $city, $jobtitle, $job_description);

if ($stmt->execute()) {
  echo "Preferences saved successfully.";
} else {
  echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
