<?php
    require "header.php";
?>

<head>
    <link rel="stylesheet" href="css/products-style.css">
</head>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Вашата количка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    require "includes/list-cart-items.inc.php";
                ?>
                <form action="includes/order.inc.php" method="post">
                <?php 
                    if(isset($_SESSION["cartId"])) {
                        echo ' 
                            <div class="container">
                                <strong>Доставка до адрес:</strong>
                                <input type="radio" name="shipping" value="Address" checked>
                                <br>
                                <strong>Доставка до еконт:</strong>
                                <input type="radio" name="shipping" value="Econt">                            
                            </div>
                        ';
                    }
                ?>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
                <button type="submit" class="btn btn-primary" name="order-submit">Завърши покупката</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <main id="main-content">

        <div class="button-cart sticky-top"><input type="submit" name="" value="" data-toggle="modal" data-target="#exampleModal"></div>

		<section id="row-one">
            <?php
                require "includes/list-all.inc.php";
            ?>
		</section>
		
    </main>
    
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
        if(isset($_SESSION['cart-item-deleted'])){
            echo "<script>notifySuccess('".$_SESSION['cart-item-deleted']."')</script>";
            echo "<script>$('#exampleModal').modal('show');</script>";
            unset($_SESSION['cart-item-deleted']);
        }
    ?>

<?php
    require "footer.php";
?>