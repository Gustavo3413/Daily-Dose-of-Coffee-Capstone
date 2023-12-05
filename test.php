<?php

session_start();
/*echo $_SESSION['login'];
echo $_SESSION['user_email'];
foreach($_SESSION['shopping_cart'] as $index => $product) {
    echo $product['productname'], $product['price'], $product['productid'];
}*/
echo $_SESSION['user_id'];
echo $_SESSION['user_name'];
?>
