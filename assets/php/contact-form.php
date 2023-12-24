<?php

// Set error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get posted data 
$name = $_POST['name'];
$familyName = $_POST['familyName']; 
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Email headers
$headers = "From: $name <$email>";

// Build email body
$body = "Name: $name $familyName\n";
$body .= "Email: $email\n";
$body .= "Mobile: $mobile\n\n";
$body .= "Message:\n$message";

// Email config
$to = "your@email.com";
$mailSubject = "Contact form inquiry: $subject"; 

// Send mail  
$success = mail($to, $mailSubject, $body, $headers);

// Return response
if ($success) {
  echo "Mail sent successfully!";  
} else {
  echo "Error sending mail!";
}

?>