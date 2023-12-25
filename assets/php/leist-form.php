<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $familyName = $_POST['family-name'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $plan = $_POST['plan'] ?? '';
    $to = 'yapepo@gmail.com';

    if (empty($name) || empty($familyName) || empty($mobile) || empty($email) || empty($message) || $plan === "Plan auswählen") {
        echo "error";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error";
        exit;
    }

    $body = "<html><head><title>New Message</title></head><body>";
    $body .= "<h2>Contact Form Message</h2>";
    $body .= "<p><strong>Name:</strong> {$name} {$familyName}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Mobile:</strong> {$mobile}</p>";
    $body .= "<p><strong>Plan:</strong> {$plan}</p>";
    $body .= "<h3>Message:</h3><p>{$message}</p>";
    $body .= "</body></html>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: <$email>\r\n";
    $headers .= "Reply-To: <$email>\r\n";

    if (mail($to, "New Message from Website", $body, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
