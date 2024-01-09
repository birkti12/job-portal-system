
<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");



if(isset($_POST)) {
// get the form data
$name = mysqli_real_escape_string($conn,$_POST["name"]);
$email =mysqli_real_escape_string($conn, $_POST["email"]);
$phone =mysqli_real_escape_string ($conn,$_POST["phone"]);
$address =mysqli_real_escape_string ($conn,$_POST["address"]);
$experience = mysqli_real_escape_string($conn,$_POST["experience"]);
$catagory = mysqli_real_escape_string($conn,$_POST["catagory"]);
$skills = mysqli_real_escape_string($conn,$_POST["skill"]);


// connect to the database

// check if the connection was successful


// insert the data into the database
$sql = "INSERT INTO resume(name,email,phone,address,experience,catagory,skill) VALUES ('$name','$email','$phone','$address','$experience','$catagory','$skills')";
if($conn->query($sql)===TRUE) {

    //If data inserted successfully then Set some session variables for easy reference and redirect to company login
    $_SESSION['registerCompleted'] = true;
    header("Location: index.php");
    exit();

} else {
    //If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
    echo "Error " . $sql . "<br>" . $conn->error;
}
} else {
//if email found in database then show email already exists error.
$_SESSION['registerError'] = true;
header("Location: cv.php");
exit();
}

//Close database connection. Not compulsory but good practice.
$conn->close();

 else {
//redirect them back to register page if they didn't click register button
header("Location: cv.php");
exit();
}
        