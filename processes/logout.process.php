<?php
    session_start();
    if(isset($_SESSION['uid']))
    {
        unset($_SESSION['uid']);
        unset($_SESSION['user']);
        
        session_destroy();
    }