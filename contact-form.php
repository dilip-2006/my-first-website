<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
    // Your email address
    $to = "letsmaildilip@gmail.com";
    
    // Email subject
    $email_subject = "Website Contact Form: $subject";
    
    // Email content
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n";
    $email_body .= "Message:\n$message\n";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirect back to the form with success message
        header("Location: index.php?message=success#contact");
        exit;
    } else {
        // Redirect back with error message
        header("Location: index.php?message=error#contact");
        exit;
    }
} else {
    // Not a POST request, redirect to the main page
    header("Location: index.php");
    exit;
}
