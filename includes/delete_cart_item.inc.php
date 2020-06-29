<?php

if (session_status() == PHP_SESSION_NONE) {
    include 'dbh.inc.php';
}

if (isset($_SESSION['username'])) {

    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8');

    if ($mysql->query("delete from cartitems where cartItem_id=".$_REQUEST['target_id'])){
        $_SESSION['cart-item-deleted'] = "Елементът бе премахнат от вашата кошница. ";

        $result = $mysql->query("select * from cartitems where cart_id=".$_SESSION['cartId']);

        if (mysqli_num_rows($result) === 0) {
            unset($_SESSION['cartId']);
        }

        header('Location: ../products.php?success=removed');
    }

    $mysql->close();
}

?>