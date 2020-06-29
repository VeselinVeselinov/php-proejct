<?php
    session_start();
    session_destroy();
    
    header("Location: ../index.php?loggedOut");
    exit();
?>