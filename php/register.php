<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish a database connection
$servername = "localhost";
$username = "root";     
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname,3308);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   

// Retrieve data from the form (adjust field names accordingly)
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statement to insert data
$stmt = $conn->prepare("INSERT INTO registration (Name, Email, Password) VALUES (?, ?, ?)");

// Check if the statement is prepared successfully
if ($stmt) {
    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    echo "Registration Successful.";
} else {
    echo "Error in preparing the statement: " . $conn->error;
}

// Close the database connection
$conn->close();

?>
