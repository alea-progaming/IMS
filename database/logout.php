<?php
// Start new or resume existing session
    session_start();
// Free all session variables
    session_unset(); 
// Destroys all data registered to a session
    session_destroy(); 
    if(!isset($_SESSION['user'])) header('Location: ../');
?>