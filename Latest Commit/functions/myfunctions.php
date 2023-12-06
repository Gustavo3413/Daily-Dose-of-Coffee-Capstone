<?php
//include('../config/database.php');


function getAll($table)
{
    global $dbc;
    $product_query = "SELECT * FROM products_coffeeshop";
    return $product_query_run = mysqli_query($dbc, $product_query);
}
//$table = $_GET['products_coffeeshop'];

function getByID($table, $id)
{
    global $dbc;
    $product_query = "SELECT * FROM products_coffeeshop WHERE productid = $id";
    return $product_query_run = mysqli_query($dbc, $product_query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

?>