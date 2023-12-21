<?php

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the form data
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Validate form data
  if(empty($name) || empty($email) || empty($subject) || empty($message)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";  
  } else {
  
    // Set recipient email address
    $recipient = "yapepo@gmail.com";
    
    // Set email subject and headers
    $subject = "Contact Form Submission: $subject";
    $headers = "From: $name <$email>";
    
    // Build email content
    $content = "Name: $name\n";
    $content .= "Email: $email\n\n";
    $content .= "Message:\n$message\n";
        
    // Send the email
    $success = mail($recipient, $subject, $content, $headers);
    
    // Check if email was sent
    if($success) {
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