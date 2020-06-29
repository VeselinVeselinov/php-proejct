<?php

if (session_status() == PHP_SESSION_NONE) {
    include 'dbh.inc.php';
}

if (isset($_POST['product-submit'])) {

    $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
    $mysql->set_charset('utf8');

    $product_name = addslashes($_POST['product_name']);
    $product_price = addslashes($_POST['product_price']);
    $product_description = addslashes($_POST['product_description']);

    if ($_REQUEST['target_id'] != 'create' and is_numeric($_REQUEST['target_id'])) {

        if ($_FILES["product_image"]["error"] > 0)
        {
            $update_query="update products set product_name='".$product_name."', description='".$product_description."', price='".$product_price."' where product_id=". $_REQUEST['target_id'];
            if ($mysql->query($update_query)){

                $_SESSION['feedback-success'] = "Продукта бе успешно редактиран. ";
                header('Location: ../products.php?update=success');
            }
        }
        else {

            $allowedExt = "png";
            $splitImageName = explode(".", $_FILES['product_image']["name"]);
            $image_extension = end($splitImageName);

            if ($allowedExt === $image_extension)
            {
                $image_name = uniqid('board');
                move_uploaded_file($_FILES["product_image"]["tmp_name"], "../img/products/". $image_name);

                $update_query="update products set imageUrl='".$image_name."', product_name='".$product_name."', description='".$product_description."', price='".$product_price."' where product_id=". $_REQUEST['target_id'];
                if ($mysql->query($update_query)){

                    $_SESSION['feedback-success'] = "Продукта бе успешно редактиран. ";
                    header('Location: ../products.php?update=success');
                }
            }
            else
            {
                $_SESSION['feedback-failure'] = "Снимката не е в подходящ формат - поддържа се само .png. ";
                header('Location: ../edit_product.php?target_id='.$_REQUEST['target_id']);
            }
        }
    }
    else {
        if ($_FILES["product_image"]["error"] > 0)
        {
            $_SESSION['feedback-failure'] = 'Не е избрана снимка за продукта!';
            header('Location: ../edit_product.php?target_id=create');
        }
        else {
            
            $allowedExt = "png";
            $splitImageName = explode(".", $_FILES['product_image']["name"]);
            $image_extension = end($splitImageName);

            if ($allowedExt === $image_extension)
            {
                $image_name = uniqid('board').".png";
                move_uploaded_file($_FILES["product_image"]["tmp_name"], "../img/products/". $image_name);

                $insert_query="insert into products (product_name, active, description, imageUrl, price) VALUES ('".$product_name."',1, '".$product_description."','".$image_name."', '".$product_price."')";
                if ($mysql->query($insert_query)){

                    $_SESSION['feedback-success'] = "Продукта бе успешно добавен. ";
                    header('Location: ../products.php?create=success');
                }
            }
            else
            {
                $_SESSION['feedback-failure'] = "Снимката не е в подходящ формат - поддържа се само .png. ";
                header('Location: ../edit_product.php?target_id=create');
            }
        }
    }

    $mysql->close();
}


?>