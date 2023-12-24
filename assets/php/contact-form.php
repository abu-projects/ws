<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $mobile = isset($_POST['Mobile']) ? $_POST['Mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $to = 'yapepo@gmail.com'; // Replace with your email address

    // Validate required fields
    if (empty($name) || empty($mobile) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Prepare the email body
    $body = "
    <html>
    <head>
      <title>New Message Coworking Büro Leibnitz</title>
    </head>
    <body>
      <h2>Contact Form Message</h2>
      <p><strong>Name:</strong> {$name}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Mobile:</strong> {$mobile}</p>
      <h3>Message:</h3>
      <p>{$message}</p>
    </body>
    </html>
    ";

    // Prepare email headers for HTML content
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";
    $headers .= "Reply-To: <$email>" . "\r\n";

    // Send the email
    if (mail($to, "New Message from Website: $subject", $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "There was a problem sending your message. Please try again.";
    }
} else {
    echo "Form not submitted correctly.";
}
?>