
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}