<?php

// Check if form was submitted 
if($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get form data
  $name = trim($_POST["name"]); 
  $email = trim($_POST["email"]);
  $mobile = trim($_POST["mobile"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Validate form data
  if(empty($name) || empty($email) || empty($mobile) || empty($subject) || empty($message)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address."; 
  } else if(!preg_match("/^[0-9]{10}$/", $mobile)) {
    $error = "Invalid mobile number.";
  } else {

    // Recipient email 
    $recipient = "info@example.com";
    
    // Set email subject and headers
    $subject = "Contact Form: $subject"; 
    $headers = "From: $name <$email>";

    // Build email content
    $content = "Name: $name\n";
    $content .= "Email: $email\n";
    $content .= "Mobile: $mobile\n\n";
    $content .= "Message:\n$message\n";
    
    // Send email  
    $mail_sent = mail($recipient, $subject, $content, $headers);
    
    // Email response
    if($mail_sent) {
      $error = "Thanks! Your message has been sent.";
    } else {
      $error = "Oops! Something went wrong, please try again.";
    }

  }

}

// Return JSON response
$response = array("error" => $error);
echo json_encode($response);

?>