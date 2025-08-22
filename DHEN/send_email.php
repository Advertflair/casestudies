<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ---  EMAIL CONFIGURATION ---
    $recipient_email = "hari.g@advertflair.com";
    $sender_email = "hari.g@advertflair.com"; // Emails will be sent FROM this address

    // --- FORM DATA PROCESSING ---
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $company = strip_tags(trim($_POST["company"]));
    $industry = strip_tags(trim($_POST["industry"]));
    $requirement = strip_tags(trim($_POST["requirement"]));

    // Basic validation
    if ( empty($name) OR empty($phone) OR empty($requirement) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // --- EMAIL CONSTRUCTION ---
    $subject = "New Consultation Request from $name";
    $email_content = "You have received a new message from your website contact form.\n\n";
    $email_content .= "Here are the details:\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Company: $company\n";
    $email_content .= "Industry: $industry\n\n";
    $email_content .= "Requirement:\n$requirement\n";
    $email_headers = "From: " . $sender_email . "\r\n" . "Reply-To: " . $email;

    // --- SEND EMAIL ---
    if (mail($recipient_email, $subject, $email_content, $email_headers)) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(403);
}
?>