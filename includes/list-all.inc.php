<?php

$mysql = new mysqli(serverName, dbUsername, dbPassword, dbName); 
$mysql->set_charset('utf8'); 

$result = $mysql->query("select * from products where active!=0");
$mysql->close();

if (isset($_SESSION["userId"]) && $_SESSION["role_users"] === "admin")
{
	
	while($row = $result->fetch_assoc())
	{
        echo "
        <div class='item-one'>
            <figure>
                <figcaption class='top' data-toggle='tooltip' data-placement='top' title='" . $row['description'] ."'>
                <button type='button' class='btn btn-warning'>Описание</button>
                </figcaption>
                <img src='img/products/". $row['imageUrl'] ."'>
                <figcaption>
                    <a class='operations' href='edit_product.php?target_id=".$row['product_id']."' >Редактирай</a>
                    <a class='operations' href='includes/delete_product.inc.php?target_id=".$row['product_id']."' >Изтрий</a>
                </figcaption>
            </figure>
        </div>";

	}
}
else
{
    while($row = $result->fetch_assoc())
	{
        echo "
        <div class='item-one'>
            <figure>
                <figcaption class='top' data-toggle='tooltip' data-placement='top' title='" . $row['description'] ."'>
                    <button type='button' class='btn btn-warning'>Описание</button>
                    </figcaption>
                <img src='img/products/". $row['imageUrl'] ."'>
                <figcaption>
                    <p class='price-info'>Цена: ".$row['price']." лв.</p>
                </figcaption>
                <a class='operations' href='includes/buy_product.inc.php?target_id=".$row['product_id']."' >Добави в количката</a>
            </figure>
        </div>";
    }
}

?>