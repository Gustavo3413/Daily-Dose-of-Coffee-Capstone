<?php
session_start();
include('../../config/database.php');

if (isset($_POST['addproduct_btn'])) {
    $id = mysqli_real_escape_string($dbc, $_POST['productid']); 
    $description = mysqli_real_escape_string($dbc, $_POST['description']);
    $price = mysqli_real_escape_string($dbc, $_POST['price']);
    $discount = mysqli_real_escape_string($dbc, $_POST['discount']);
    $image = $_FILES['coffeeshop_img']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $stock = mysqli_real_escape_string($dbc, $_POST['stock']);
    $name = mysqli_real_escape_string($dbc, $_POST['name']);

    // check if email is already registered

    $product_query = "INSERT INTO products_coffeeshop (productid, description, price, discount, coffeeshop_img, stock, name) VALUES (?,?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbc, $product_query);

    // Assuming $description is a string, use "s" in the bind_param
    mysqli_stmt_bind_param($stmt, "isddsis", $id, $description, $price, $discount, $image, $stock, $name);

    $product_query_run = mysqli_stmt_execute($stmt);

    if ($product_query_run) {
        $_SESSION['message'] = "New Product Registration Successful";
        header('Location: ../addproducts.php');
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header('Location: ../addproducts.php');
    }
}
 else {
    $_SESSION['message'] = "Passwords do not match";
    header('location: ../adminregister.php');
}
    
    if ($product_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        // Assuming you have a redirect function defined somewhere
        redirect("../addproducts.php", "Product added successfully!");
    } else {
        // Assuming you have a redirect function defined somewhere
        redirect("../addproducts.php", "Failed to add product!");
    }
 
?>
