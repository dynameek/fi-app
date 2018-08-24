
<?php
require 'vendor/autoload.php';

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("me@nateogund.com.ng", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("nathanoguntuberu@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    echo $response->statusCode() . "\n";
    print_r($response->headers());
    echo $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}