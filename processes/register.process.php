<?php
    require_once './back/Request.php';
    if(isset($_POST['fi-signup-sub']))
    {
        #   Ensure CSRF security
        $request = new Request;
        $request->process();
        
        #   Read input data
        $name = $_POST['fi-name'];
        $email = $_POST['fi-email'];
        $phone = $_POST['fi-phone'];
        $passwd = $_POST['fi-passwd'];
        $cpasswd = $_POST['fi-cpasswd'];
        
        #   Check if any field is unfilled
        if(empty($name) || empty($email) || empty($phone)|| empty($passwd)||empty($cpasswd))
            $msg = "Please fill all fields";
        elseif(!Form::isLongEnough($passwd, 6))
            $msg = "Password to short";
        elseif($passwd !== $cpasswd)
            $msg = "Passwords mismatched";
        else
        {
            #   CSet up database
            $db = new Database;
            $db->selectDb('field_insight');
            
            #   Check is a user exists
            if(!empty($db->fetchData('user', ['name'], ['email' => $email])))
                $msg = "Email already in use";
            else
            {
                #   create a user ID and insert user
                $user_id = hash('sha256', $email);
                $passwd = Form::hashPassword($passwd);
                
                #   prepare data for insertion
                $user_data = [
                  'id' => $user_id, 'name' => $name, 'email' => $email,
                  'phone' => $phone, 'password' => $passwd
                ];
                
                #   Attempt to add user to database
                if(!$db->insertRecord('user', $user_data))
                   $msg = "An error occured. Please Try again";
                else
                {
                    $db->closeConnection();         #   Close database connection
                    $_SESSION['uid'] = $user_id;    #   Set uid session variable
                    header("Location: ./home.php"); #   Redirect to home page
                }
                
            }
        }
    }