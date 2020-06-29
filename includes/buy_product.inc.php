<?php

if (session_status() == PHP_SESSION_NONE) {
    include 'dbh.inc.php';
}

if (isset($_SESSION['username'])) {

    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8');

    if (!isset($_SESSION['cartId'])) {
        
        $sqlQuery_cart = "INSERT INTO carts (`user_id`, `active`) VALUES ('". $_SESSION['userId'] ."','1')";

        if ($mysql->query($sqlQuery_cart) === TRUE) {

            $cartId = $mysql->insert_id;
            $_SESSION['cartId'] = $cartId;
        }
        
    }
    
    $createCartItem_query = "INSERT INTO cartitems (`cart_id`, `product_id`, `quantity`) VALUES ('". $_SESSION['cartId'] ."','".$_REQUEST['target_id']."', '1')";
    if ($mysql->query($createCartItem_query) === TRUE) {
        $_SESSION['feedback-success'] = "Елементът бе добавен в кошницата. ";
        header('Location: ../products.php?addedItem');
    }

    $mysql->close();
}
else {
    $_SESSION['feedback-failure'] = "Моля влезте в системата за да закупите продукта. ";
    header('Location: ../products.php?failure=nouser');
}

?>