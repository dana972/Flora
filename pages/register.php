<?php
// Include the database connection
require_once '../config/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect to the login page after successful registration
        header("Location: ./login.php");
        exit(); // Always call exit after a header redirect
    } else {
        // If there's an error, show it
        echo "Error: " . mysqli_error($conn);
    }
}
?>
