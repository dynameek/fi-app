<?php
    require __DIR__ . '/../vendor/autoload.php';
    use Twilio\Rest\Client;
    
    $acc_id  = 'ACc3f1ed418936760225a2ff30603d53d1';
    $auth_token = '95d4fbc13d752276085374a2267e6de7';
    $my_number = '+14437207688';
    
    $client = new Client($acc_id, $auth_token);
    $message = "Hello, ".$name.". You have added a new hobby: ".$hobby;
    $smsConfig = ['from' => $my_number, 'body' => $message];
    $client->messages->create($phone, $smsConfig);
    
    