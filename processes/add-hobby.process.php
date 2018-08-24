<?php
    session_start();
    try{
        require_once '../web.php';
        //require_once '../vendor/autoload.php';
        
        #   prepare return values
        $retBool = 0;
        $retMsg = '';
        
        #   Handle the request
        $request = new Request;
        $request->process();
        
        #   Read input data
        $hobby = strtolower($_POST['hobby']);
        $user = $_SESSION['uid'];
        $name = $_SESSION['user']['name'];
        $phone = $_SESSION['user']['phone'];
        
        #generate an id for the hobby
        $hob_id = hash('sha256', $hobby.$user);
        
        #   Open database connection
        $db = new Database;
        $db->selectDb('field_insight');
        
        #   Check if the hobby exists
        $sel_hob = $db->fetchData('hobby', ['title'], ['id' => $hob_id]);
        
        if(!empty($sel_hob)) $retMsg = "Hobby already exists";
        else
        {
            #   Attempt Insertion
            if($db->insertRecord('hobby', ['id'=>$hob_id, 'user' => $user, 'title'=> $hobby]))
            {
                #   Handle SMS
                require_once '../back/Twilio.php';
                
                #   Set positive return values
                $retBool = 1;
                $retMsg = "Hobby added successfully: ".$phone;
            }else $retMsg = "Could not add Hobby";
        }
        
        $db->closeConnection();
        
        Security::protectForm();
        $token = $_SESSION['csrf_token'];
        
        echo '{"isSuccessful":'.$retBool.', "body": "'.$retMsg.'", "token": "'.$token.'" }';
    }catch(Exception $e)
    {
        $e = new $e;
        echo '{"isSuccessful":'.$retBool.', "body":"Oops, Internal error"}';
    }
?>