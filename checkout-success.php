<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .success-error-msg p {
            margin-top: 5vh;
            /* align-items: center; */
            padding-top: 12.5%;
            /* margin-top: 1%; */
            color: #eee;
            font-size: 3rem;
        }
    </style>
    <title>Daily Dose Of Coffee - Checkout</title>
</head>

<body>

    <?php
    // requiring database connection file
    require('database.php');

    // starting session
    session_start();
    ?>

    <!-- header section start  made by Shrey-->
    <header class="header">
        <a href="index.php#home" class="logo">
            <img src="images/DDC Logo.png" alt="logo" />
        </a>
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#menu">Menu</a>
            <a href="index.php#products">Product</a>
            <a href="index.php#review">Review</a>
            <a href="index.php#blogs">Blogs</a>
            <a href="index.php#contact">Contact</a>
        </nav>
        <div class="icons">
            <div class="navbar-useremail">
                <?php
                if (isset($_SESSION['login'])) {
                    if (isset($_SESSION['user_email'])) {
                        echo '<p>' . $_SESSION['user_email'] . '</p>';
                    }
                }
                ?>
            </div>
            <?php
            if (isset($_SESSION['login'])) {
            ?>
                <form class=logout-form method="post" action="logout.php">
                    <button class="btn" type="submit" name="logout">Logout</button>
                </form></br>
            <?php
            } ?>
            <div class="fas fa-user" id="user" onclick="Loginpage()"></div>
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>
        <div class="search-form">
            <input type="search" class="search-box" placeholder="search here..." />
            <label for="search-box" class="fas fa-search"></label>
        </div>
        <div class="cart-items-container">



            <?php
            $total_price = 0; // Initialize total price

            if (isset($_POST['add_to_cart'])) {
                $productid = $_POST['productid'];
                $quantity = 1;
                $price = $_POST['price'];
                $productname = $_POST['name'];

                $cart_array = array(
                    'productid' => $productid,
                    'quantity' => $quantity,
                    'price' => $price,
                    'productname' => $productname,
                );

                if (empty($_SESSION['shopping_cart'])) {
                    $_SESSION['shopping_cart'] = array($cart_array);
                } else {
                    // Check if the product is already in the cart, update the quantity if so
                    $found = false;
                    foreach ($_SESSION['shopping_cart'] as &$item) {
                        if ($item['productid'] == $productid) {
                            $item['quantity'] += 1;
                            $found = true;
                            break;
                        }
                    }
                    // If the product is not in the cart, add it
                    if (!$found) {
                        $_SESSION['shopping_cart'][] = $cart_array;
                    }
                }
            }

            if (isset($_POST['update_quantity']) && isset($_POST['item_index'])) {
                $item_index = $_POST['item_index'];
                $new_quantity = $_POST['new_quantity'];
                if (isset($_SESSION['shopping_cart'][$item_index])) {
                    $total_price -= $_SESSION['shopping_cart'][$item_index]['quantity'] * $_SESSION['shopping_cart'][$item_index]['price']; // Subtract the old total price
                    $_SESSION['shopping_cart'][$item_index]['quantity'] = $new_quantity;
                    $total_price += $new_quantity * $_SESSION['shopping_cart'][$item_index]['price']; // Add the new total price
                }
            }

            if (isset($_POST['delete_item']) && isset($_POST['item_index'])) {
                $item_index = $_POST['item_index'];
                if (isset($_SESSION['shopping_cart'][$item_index])) {
                    $total_price -= $_SESSION['shopping_cart'][$item_index]['quantity'] * $_SESSION['shopping_cart'][$item_index]['price']; // Subtract the price of the deleted item
                    unset($_SESSION['shopping_cart'][$item_index]);
                    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
                }
            }

            if (isset($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $index => $product) {
            ?>
                    <form class="cart-items" method="post">
                        <button type="submit" name="delete_item" class="delete-item-btn">
                            <span class="fas fa-times"></span>
                        </button>
                        <input type="hidden" name="item_index" value="<?= $index; ?>">
                        <input type="hidden" name="productid" value="<?= $product['productid']; ?>">
                        <div class="content">
                            <h3><?= $product['productname']; ?></h3>
                            <div class="price" name="price">$<?= number_format($product['price'], 2); ?></div>
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="new_quantity" value="<?= $product['quantity']; ?>" min="1">
                            <button type="submit" name="update_quantity">Update Quantity</button>
                        </div>
                    </form>
            <?php
                    $total_price += $product['quantity'] * $product['price']; // Add the price of each product to the total
                }
            }
            ?>

            <div class="total-price">Total: $<?= number_format($total_price, 2); ?></div>

            <div class="checkout-btn" name="checkout-btn"><a href="#" class="btn">checkout now</a></div>



        </div>
    </header>
    <!-- header section end -->

    <!--Error or success message begins-->
    <section class="success-error-msg">

        <?php

        // array created to store errors
        $errors = [];


        if (isset($_SESSION['login'])) {
            if (isset($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $index => $product) {

                    $productid = $product['productid'];
                    $userid = $_SESSION['user_id'];
                    $price = $product['price'];

                    if (count($errors) == 0) {


                        $q = "INSERT INTO sales(productid, userid, price) VALUES(?, ?, ?)";

                        $stmt = mysqli_prepare($dbc, $q);

                        mysqli_stmt_bind_param(
                            $stmt,
                            'iii',
                            $productid,
                            $userid,
                            $price,
                        );

                        $result = mysqli_stmt_execute($stmt);
                    } else {
                        $_SESSION["error_checkout"] = $errors;
                        header('Location: checkout.php');
                    }
                }

                if ($result) {
                    echo "<p>Thank you for ordering. We are already preparing your delicious coffee.</p>";
                } else {
                    echo '<p class="error">Oops, something went wrong! Please, try again later.</p>';
                }
            } else {
                echo '<p class="error">You cannot checkout without buying any products!</p>';
            }
        } else {
            header("Location: login.php");
        } ?>
    </section>
    <!--Error or success message ends-->

</body>

</html>