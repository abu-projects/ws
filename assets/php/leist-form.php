<?php

// Check if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $message = $_POST['message'];
    $plan = $_POST['plan'];

    // Define error and success messages
    $missing_fields = "Please fill in all fields.";
    $email_sent = "Thank you! Your message has been sent.";
    $email_failed = "Something went wrong, please try again.";

    // Validate form    
    if(empty($name) || empty($email) || empty($phone) || empty($message) || empty($plan)) {

        $error = $missing_fields;

    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Invalid email address';

    } else {

        // Recipient email address 
        $to = 'info@example.com';
        
        // Formatting message 
        $body = "Name: {$name}\n";
        $body .= "Email: {$email}\n";
        $body .= "Phone: {$phone}\n\n";
        $body .= "Message:\n{$message}\n\n";
        $body .= "Selected Plan: {$plan}";

        // Set content-type header
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

        // Send email
        $mail_sent = mail($to, 'Contact Form Message', $body, $headers);
        
        // Check whether message is sent
        $error = $mail_sent ? $email_sent : $email_failed; 
    }

    // Return response
    $response = ['error' => $error];
    header('Content-Type: application/json');
    echo json_encode($response);

}

?>