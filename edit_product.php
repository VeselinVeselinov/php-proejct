<?php
    require 'header.php'
?>

<head>
	<link rel="stylesheet" href="css/register.css">
</head>

<?php 

    if (session_status() == PHP_SESSION_NONE) {
        include 'includes/dbh.inc.php';
    }

    if (isset($_SESSION['role_users']) and $_SESSION['role_users'] != 'admin' or !isset($_SESSION['role_users'])) {
        $_SESSION['feedback-failure'] = "Нямате права да обработвате продукти! ";
        echo "<script>location.href = 'index.php?failure=nouser';</script>";
    }

    if ($_REQUEST['target_id'] != 'create' and is_numeric($_REQUEST['target_id'])) {

        $mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
        $mysql->set_charset('utf8');

        $result_product = $mysql->query("select * from products where product_id='". $_REQUEST['target_id'] . "'");

        if ($row_product = $result_product->fetch_assoc()) {
            $product_name = $row_product["product_name"];
            $product_description = $row_product["description"];
            $product_price = $row_product["price"];
            $image_url = $row_product["imageUrl"];
        }
    }

?>

<section class="testimonial py-5">
    <div class="container">
        <div class="row">

            <div class="col-md-4 py-5 bg-success text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="https://image.flaticon.com/icons/png/512/2000/2000200.png" style="width:30%">
                        <h2 class="py-3">Обработка на продукт</h2>
                        <p>
                            Тук се помещава създаването и обработването на продукти.
                            Всеки продук има име, описание, цена и снимка - като всеки един от изброените атрибути е задължителен! 
                            Продуктът не може да бъде създаден или обработен,
                             докато не попълните съответстващите на указания полета във формата.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Моля, опишете продукта:</h4>
                <form action="includes/edit_product.inc.php?target_id=<?php echo  $_REQUEST['target_id'];?>" method="post" enctype="multipart/form-data">

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="product_name">Име на продукта:</label>
                            <input name="product_name" minlength="3" maxlength="25" placeholder="Име на продукта" class="form-control" type="text" 
                            class="form-control" required value="<?php if(isset($product_name))echo $product_name; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="product_price">Цена на продукта:</label>
                            <input name="product_price" placeholder="Цена на продукта:" class="form-control" type="number" 
                            class="form-control" required value="<?php if(isset($product_price))echo $product_price; ?>">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="product_description">Описание на продукта</label>
                            <textarea class="form-control" id="product_description" placeholder="Описание на продукта"
                            required minlength="15" maxlength="250" name="product_description" rows="3" 
                            style="min-height:200px;"><?php if(isset($product_description))echo $product_description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div >
                            <input class="form-control" type="file" name="product_image" >
                        </div>    
                    </div>

                    <div class="form-row" style="position:absolute; bottom:0;">
                        <button type="submit" name="product-submit" class="btn btn-primary">Обновяване</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<!-- this script handles the rendering of feedback messages -->
<script type="text/javascript" src="js/renderHandler.js"></script>
    
    <?php
        if(isset($_SESSION['feedback-success'])){
            echo "<script>notifySuccess('".$_SESSION['feedback-success']."')</script>";
            unset($_SESSION['feedback-success']);
        }
        if(isset($_SESSION['feedback-failure'])){
            echo "<script>notifyFailure('".$_SESSION['feedback-failure']."')</script>";
            unset($_SESSION['feedback-failure']);
        }
    ?>

<?php
    require "footer.php";
?>