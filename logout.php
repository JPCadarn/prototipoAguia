<?php
    if(session_status() <> PHP_SESSION_ACTIVE){
        session_start();
    }

    unset($_SESSION['userId']);
    unset($_SESSION['userType']);
    header('Location: dash.php');
?>