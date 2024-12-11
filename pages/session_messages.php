<?php
// Assuming you have already connected using mysqli_connect() in config.php
require_once '../config/config.php';

// Check if the form data is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $full_name = $_POST['contact_name'];
    $email = $_POST['contact_email'];
    $subject = $_POST['contact_subject'];
    $message = $_POST['contact_message'];

    // Prepare the SQL query to insert data into the contacts table using mysqli
    $query = "INSERT INTO contacts (full_name, email, subject, message) VALUES ('$full_name', '$email', '$subject', '$message')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Thank you for contacting us! We will get back to you soon.";
    } else {
        echo "There was an error submitting your message. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
