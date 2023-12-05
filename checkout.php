<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Daily Dose Of Coffee - Checkout</title>
    <style>
        .checkout-products {
            margin-top: 5vh;
            /* align-items: center; */
            padding-top: 12.5%;
            /* margin-top: 1%; */
        }

        .checkout-products .content {
            max-width: 60rem;
        }

        .checkout-products .content {
            font-size: 2rem;
            font-weight: lighter;
            line-height: 1.8;
            padding: 1rem 0;
            color: black;
            font-weight: bold;
        }

        .checkout-products .content h3 {
            font-size: 6rem;
            text-transform: uppercase;
            color: #fff;
        }

        .checkout-products .content h4 {
            font-size: 3rem;
            text-transform: uppercase;
            color: #fff;
        }

        .checkout-products .content .checkout-form {
            background: var(--main-color);
            padding: 10vh;
        }

        .total-price {
            color: black;
            font-size: 2rem;
        }
    </style>
</head>

<body>

    <?php

    require('database.php');

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
    <!-- checkout section starts Made by Gustavo -->
    <section class="checkout-products" id="checkout">
        <div class="content">
            <h3>Your order</h3>

            <?php
            if (isset($_SESSION['shopping_cart'])) {?>

                    <form class="checkout-form" method="post" action="checkout-success.php">
                        <?php
                        foreach ($_SESSION['shopping_cart'] as $index => $product) { 
                        ?>
                        <button type="submit" name="delete_item" class="delete-item-btn">
                            <span class="fas fa-times"></span>
                        </button>
                        <input type="hidden" name="item_index" value="<?= $index; ?>">
                        <input type="hidden" name="productid" value="<?= $product['productid']; ?>">
                        <div class="content">
                            <p><?= $product['productname']; ?></p>
                            <div class="price" name="price">$<?= number_format($product['price'], 2); ?></div>
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="new_quantity" value="<?= $product['quantity']; ?>" min="1">
                            <button type="submit" name="update_quantity">Update Quantity</button>
                        </div> </br>
                        <?php
                        }
                        ?>
                        <div class="total-price">Total: $<?= number_format($total_price, 2); ?></div></br>
                        <h4>Your payment information</h4></br>
                        <label> Credit Card Number:
                            <input type="number" name="credit_card_number" id="credit_card_number" placeholder="XXXX-XXXX-XXXX" maxlength="12">
                        </label></br>
                        <label> Expiry Date:
                            <input type="number" name="credit_card" id="credit_card_expiry" placeholder="MMYY" maxlength="4">
                        </label></br>
                        <label> CVV:
                            <input type="number" name="credit_card" id="credit_card_cvv" placeholder="XXX" maxlength="3">
                        </label>

                        <?php
                        if (isset($_SESSION['error_checkout'])) {
                            
                            
                            $errors = $_SESSION['error_checkout'];

                            foreach ($errors as $error) {
                                echo '</br>';
                                echo '<p style="color:red;" class="register-error">' . $error . '</p>';
                            }

                            unset($_SESSION['error_checkout']);
                        }
                        ?>

                    </form>
                    <div class="checkout-btn" name="checkout-btn"><a href="checkout-success.php" class="btn">Place order</a></div>

            <?php
                }

            ?>
        </div>
    </section>
    <!-- checkout section ends -->
    <!-- footer section starts made by Gustavo-->
    <section class="footer">
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
        <div class="links">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#menu">Menu</a>
            <a href="index.php#products">Product</a>
            <a href="index.php#review">Review</a>
            <a href="index.php#blogs">Blogs</a>
            <a href="index.php#contact">Contact</a>
        </div>
        <div class="credit">created by <span>GROUP 6</span></div>
    </section>
    <!-- footer section ends -->
    <script src="index.js"></script>
</body>

</html>