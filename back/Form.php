<?php
    /*  FORM CLASS
     *  **********
     *  This class handles basic form data sanitization
     *  It is extended by Controllers
    */
    class Form
    {
        public $formError = ''; #   Holds any errors encountered
        
        /*
         *  Hash Passwords
         *  It returns a hashed password
        */
        public function hashPassword($password)
        {
            return password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        }
        
        /*
         *  Checks if passwords are a match
         *  It takes two parameters:
         *  1. the hashed password
         *  2. the password to check
         *
         *  It returns true, if they match and false otherwise
        */
        public function doPasswordsMatch($hash, $password)
        {
            $retVal = false;
            if(password_verify($password, $hash)) $retVal = true;
            
            #
            return $retVal;
        }
        
        /*
         *  Checks if a variable is long enough
         *  It takes 2 parameters:
         *  1. the variable to check
         *  2. the length to check against
         *
         *  it returns true, if password is long enough and false otherwise
         *
        */
        public function isLongEnough($var, $min_length)
        {
            $retVal = false;
            if(strlen($var) >= $min_length) $retVal = true;
            #
            return $retVal;
        }
        
        /*
         *  Checks if email adress meets the global standard
         *  It takes 1 parameter:
         *  1. The email address to be checked
         *
         *  It returns true, if email is valid and false otherwise
        */
        public function isEmailValid($email)
        {
            $retVal = false;
            $unwantedCharPattern = "/[^\w\@\.]/";                               #   Any character(s) other than this is unwanted
            $structurePattern = "/\w+\.*\@(\w+\.)+[^(\.\.)]([A-Za-z0-9]*)$/";   #   Outlines the valid structure of the email
            if(!preg_match($unwantedCharPattern, $email) && preg_match($structurePattern, $email))
                $retVal = true;
            
            #
            return $retVal;
        }
    }