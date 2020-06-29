<?php

    if(isset($_POST['order-submit'])) {

        if (session_status() == PHP_SESSION_NONE) {
            require "dbh.inc.php";
        }

        if(isset($_POST["shipping"])) {
            $shipping = addslashes($_POST["shipping"]); 
        }

        $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
        $mysql->set_charset('utf8');

        $queryOrder = "insert into orders(cart_id, finalPrice, shipping) 
            values ('". $_SESSION['cartId'] . "', '". $_SESSION['totalPrice'] . "', '". $shipping . "')";

        if(mysqli_query($mysql, $queryOrder))  
        {  
            unset($_SESSION['cartId']);

            $_SESSION['feedback-success'] = 'Вашата поръчка бе приета!';
            header("Location: ../products.php?shipping=success");
        }
        else {
            $_SESSION['feedback-failure'] = 'Моля добавете елементи в количката за да завършите покупката!';
            header("Location: ../products.php?shipping=invalid");
        }

        $mysql->close();              
    }
?>
