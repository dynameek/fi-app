<?php
    #
    if(!isset($_SESSION['uid'])) header("Location: ./index.php");
    
    #
    $user_id = $_SESSION['uid'];
    
    #
    $db = new Database;
    $db->selectDb('field_insight');
    
    $user_data = $db->fetchData('user', ['name', 'phone', 'email'], ['id' => $user_id]);
    
    #   Save user data to session
    $_SESSION['user']['name'] = $user_data[0]['name'];
    $_SESSION['user']['phone'] = $user_data[0]['phone'];
    $_SESSION['user']['email'] = $user_data[0]['email'];
    
    #   Get any hobbies for the user
    $rHobbies = $db->fetchData('hobby', ['title'], ['user' => $user_id]); 
    $hobbies = [];
    foreach($rHobbies as $rHobby)
    {
        foreach($rHobby as $hobby)
        {
            $hobbies[] = $hobby;
        }
    }
    
    $db->closeConnection();
?>