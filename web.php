<?php
    function __autoload($class)
    {
        if(file_exists('./back/'.$class.'.php'))
            require_once('./back/'.$class.'.php');
        elseif(file_exists('/var/www/html/fi-app/vendor/twilio/sdk/Twilio/Rest/'.$class.'.php'))
            require_once('/var/www/html/fi-app/vendor/twilio/sdk/Twilio/Rest/'.$class.'.php');
        else require_once('../back/'.$class.'.php');
    }