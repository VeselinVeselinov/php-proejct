<?php

    if (session_status() == PHP_SESSION_NONE) {
        include 'dbh.inc.php';
    }

    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8');

    if($mysql->query("update products set active='0' where product_id=".$_REQUEST['target_id'])) {
        $_SESSION['feedback-success'] = "Елементът бе успешно премахнат от системата. ";
        header('Location: ../products.php?success=removed');
    }

    $mysql->close();

?>
