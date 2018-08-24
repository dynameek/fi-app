<?php
    //require_once '../web.php';
    class Request
    {
        public $requestType;
        public $csrf_token;
        
        /*  */
        private function getRequestType()
        {
            return $rMethod = strtolower($_SERVER['REQUEST_METHOD']);
        }
        
        private function getCSRFToken()
        {
            if(isset($_POST['csrf_token']))
                $this->csrf_token = $_POST['csrf_token'];
            else throw new Exception('CSRF Token Absent');
        }
        
        private function cleanRequestData($request_array)
        {
            $temp_array = [];
            foreach ($request_array as $key => $value)
            {
                $temp_array[$key] = htmlspecialchars($value);
            }
            
            $request_array = $temp_array;
        }
        
        public function process()
        {
            if(self::getRequestType() == 'post')
            {
                self::cleanRequestData($_POST);
                self::getCSRFToken();
                if(!Security::verifyToken($this->csrf_token))
                    throw new Exception('Invalid CSRF token');
            }else self::cleanRequestData($_GET);
        }
    }