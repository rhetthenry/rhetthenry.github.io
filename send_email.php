<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize the input to prevent malicious code injection
    $name     = strip_tags(trim($_POST["user_name"]));
    $email    = filter_var(trim($_POST["user_email"]), FILTER_SANITIZE_EMAIL);
    $interest = htmlspecialchars($_POST["interest"]);

    // 2. Set your details
    $to      = "RHWreptiles@outlook.com"; // <-- REPLACE THIS WITH YOUR REAL EMAIL
    $subject = "New Scout Application: $name";

    // 3. Create the email content
    $email_content = "Scout Masters and Assistaint Scoutmasters,\n\n";
    $email_content .= "A new recruit has shown interest:\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$interest\n";

    // 4. Set the email headers
    // This makes the 'Reply' button in your inbox go to the user's email
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // 5. Send the mail
    if (mail($to, $subject, $email_content, $headers)) {
        // Success: Redirect to a "Thank You" page or show a message
        echo "<h1>Signal Sent!</h1><p>Thank you, $name. Our troop leaders will be in touch soon.</p>";
    } else {
        // Failure
        echo "<h1>Transmission Failed</h1><p>The signal was lost in the woods. Please try again later.</p>";
    }
} else {
    // If someone tries to access the script directly without a form submission
    echo "You must submit the form to access this page.";
}
?>