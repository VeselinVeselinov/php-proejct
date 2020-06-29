<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php  
    if (session_status() == PHP_SESSION_NONE) {
        require "includes/dbh.inc.php";
    }

	$mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
	$mysql->set_charset('utf8');

	if (isset($_SESSION['cartId']))
	{
        $result_cart_items = $mysql->query("select * from cartitems where cart_id='". $_SESSION['cartId'] . "'");
        $total_price_cart = 0;

        while ($row_cart_items = $result_cart_items->fetch_assoc())
        {
            $currentCartItemId = $row_cart_items['cartItem_id'];
            $product_id =$row_cart_items["product_id"];
            $result_products_client = $mysql->query("select * from products where product_id='". $product_id . "'");
            
            if ($row_products_client = $result_products_client->fetch_assoc())
            {
                $product_name = $row_products_client["product_name"];
                $description = $row_products_client["description"];
                $price = $row_products_client["price"];

                //calculate total price for cart
                $total_price_cart += $row_products_client["price"];
                $_SESSION['totalPrice'] = $total_price_cart;

                echo 
                    '
                        <table class="table">
                            <thead class="bg-warning">
                                <tr>
                                    <th scope="col">Име:</th>
                                    <th scope="col">Описание:</th>
                                    <th scope="col">Цена:</th>
                                    <th scope="col"></th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$product_name.'</td>
                                    <td>'.$description.'</td>
                                    <td>'.$price.' лв.</td>
                                    <td>
                                    <a class="text-danger ml-1" onclick="return confirm(`Сигурен ли си, че искаш да премахнеш продукта от количката?`)" href="includes/delete_cart_item.inc.php?target_id='.$currentCartItemId.'">
                                            <i class="fa fa-trash fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                       
                    ';
            }
        }
        
        echo 
        '
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Обща цена на количката:</strong></td>
                        <td>' .$total_price_cart. ' лв.</td>
                    </tr>                   
                </tbody>            
            </table>                  
        ';       
    }
    else {
        echo 
        '
            <div class="icon-cart-empty"></div>           
        ';
    }

    $mysql->close();
?>