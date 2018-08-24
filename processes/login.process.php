<?php
    try{
        require_once './back/Request.php';
        if(isset($_POST['fi-login-sub']))
        {
            #   Ensure CSRF security
            $request = new Request;
            $request->process();
            
            #   Read Input
            $email = $_POST['fi-email'];
            $passwd = $_POST['fi-passwd'];
            
            #   Check if email or password is empty
            if(empty($email) || empty($passwd))
            {
                $msg = "Please, fill all fields";
            }elseif(!Form::isEmailValid($email))
            {
                $msg = "Email is invalid";
            }else
            {
                #   If security checks are passed,
                #   get user name and id from database
                $db = new Database;
                $db->selectDb('field_insight');
                $user_info = $db->fetchData('user', ['id', 'password'], ['email' => $email]);
                
                if(empty($user_info))
                    $msg = 'Email/Password incorrect';
                else
                {
                    $user_id = $user_info[0]['id'];
                    $hash_passwd = $user_info[0]['password'];
                    
                    if(!Form::doPasswordsMatch($hash_passwd, $passwd))
                        $msg = 'Email/Password incorrect';
                    else{
                        #set user id to a session variable and redirect to home page
                        $_SESSION['uid'] = $user_id;
                        header("Location: ./home.php");
                    }
                }
            }
        }
    }catch(Exception $e)
    {
        
    }
?>