<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $familyName = isset($_POST['family-name']) ? $_POST['family-name'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $plan = isset($_POST['plan']) ? $_POST['plan'] : '';
    $to = 'yapepo@gmail.com'; // Replace with your email address

    // Validate required fields
    if (empty($name) || empty($familyName) || empty($mobile) || empty($email) || empty($message) || empty($plan)) {
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
      <p><strong>Name:</strong> {$name} {$familyName}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Mobile:</strong> {$mobile}</p>
      <p><strong>Plan:</strong> {$plan}</p>
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
    if (mail($to, "New Message from Website: Coworking Büro Leibnitz", $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "There was a problem sending your message. Please try again.";
    }
} else {
    echo "Form not submitted correctly.";
}
?>