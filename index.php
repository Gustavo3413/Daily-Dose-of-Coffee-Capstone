<!-- 
Name:Group 6
Web site design capstone
professor: Pratish Shelar
Project Name: Daily Dose Of Coffee.
Group lead: Gustavo de Azevedo Silva Student ID: 8883413.
Group Memer: Oyindamola Owoyemi Student ID:8896557. 
Group Memer: Shrey Vora Student ID:8720056.
Group Memer: Navneet Kaur Student ID: 8881292.
Developement started on date:- 2023-09-20.
front end developnment ended:- 2023-10-11.
Login page Dev: Gustavo de Azevedo Silva.
Header/Navbar Dev: Shrey Vora.
Home page Dev: Oyindamola Owoyemi.
About page Dev: Navneet Kaur.
Menu Page Dev: Shrey Vora.
Product page Dev: Gustavo de Azevedo Silva.
Review Page Dev: Gustavo de Azevedo Silva.
Blogs Page Dev: Navneet Kaur.
Contact Page Dev: Oyindamola Owoyemi.
Footer Section Dev: Oyindamola Owoyemi.
Media Gathering: Navneet Kaur. 
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <title>Daily Dose Of Coffee</title>
</head>

<body>

  <?php

  require('database.php');

  session_start();
  ?>

  <!-- login page made by Gustavo-->
  <!-- login page ends -->
  <!-- header section start  made by Shrey-->
  <header class="header">
    <a href="#home" class="logo">
      <img src="images/DDC Logo.png" alt="logo" />
    </a>
    <nav class="navbar">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#products">Product</a>
      <a href="#review">Review</a>
      <a href="#blogs">Blogs</a>
      <a href="#contact">Contact</a>
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
  <!-- home section starts Made by Damola -->
  <section class="home" id="home">
    <div class="content">
      <h3>Fresh coffee in the morning</h3>
      <p>Taste our new selection of hot beverages for your mornings.</p>
      <a href="#menu" class="btn">Get yours now</a>
    </div>
  </section>
  <!-- home section ends -->
  <!-- about section starts made by Navneet -->
  <section class="about" id="about">
    <h1 class="heading"><span>about</span> us</h1>
    <div class="row">
      <div class="image">
        <img src="images/fresh-coffee-steam-rises-from-single-dark-mug-generated-by-ai.jpg" alt="background img" />
      </div>
      <div class="content">
        <h3>what makes our coffee special?</h3>
        <p>
          We ensure the high quality of the coffee that goes to your table by
          only having coffe grains from the best farmers. Our criteria for
          selecting suppliers allows us to ensure that only high quality
          coffee gets served to you.
        </p>
        <p>
          Wait no longer! Come meet us, or order here our beverages to see for
          yourself. If making coffee at home is your liking, we have high
          quality coffee packages so you can have the best of Canada's coffee
          done at home.
        </p>
        <a href="#blogs" class="btn">learn more</a>
      </div>
    </div>
  </section>
  <!-- about section ends -->
  <!-- menu section Made by Shrey-->
  <section class="menu" id="menu">
    <h1 class="heading">our <span>menu</span></h1>
    <div class="box-container">
      <?php
      $q = "SELECT * FROM menu_coffeeshop";
      $menu_result = mysqli_query($dbc, $q);

      while ($row = mysqli_fetch_array($menu_result)) { ?>


        <form method="post" class="box" class="cart">
          <img name="productimg" src="<?= $row["coffeeshop_img"] ?>" />
          <h3><?= $row["name"]; ?></h3>
          <div class="price" name="price">$<?= number_format($row["price"], 2); ?></div>
          <input type="hidden" name="productid" value="<?= $row['productid'] ?>" />
          <input type="hidden" name="name" value="<?= $row['name'] ?>" />
          <input type="hidden" name="price" value="<?= $row['price'] ?>" />
          <input type="submit" id="add_to_cart" name="add_to_cart" class="btn" value="add to cart" />
        </form>

      <?php
      }
      ?>
    </div>
  </section>

  <!-- menu section ends   -->
  <!-- product section starts  made by Gustavo-->
  <section class="menu" id="products">
    <h1 class="heading">our <span>products</span></h1>
    <div class="box-container">


      <?php
      $q = "SELECT * FROM products_coffeeshop";
      $product_result = mysqli_query($dbc, $q);

      while ($row = mysqli_fetch_array($product_result)) { ?>


        <form method="post" class="box" class="cart">
          <div class="image">
            <img name="productimg" src="<?= $row["coffeeshop_img"] ?>" />
          </div>
          <h3><?= $row["name"]; ?></h3>
          <div class="price">$<?= number_format($row["price"], 2); ?></div>
          <input type="hidden" name="productid" value="<?= $row['productid'] ?>" />
          <input type="hidden" name="name" value="<?= $row['name'] ?>" />
          <input type="hidden" name="price" value="<?= $row['price'] ?>" />
          <input type="submit" id="add_to_cart" name="add_to_cart" class="btn" value="add to cart" />
        </form>

      <?php
      }
      ?>

  </section>
  <!-- product section ends -->
  <!-- product preview page starts made by Damola -->

  <!-- product preview page ends -->
  <!-- review section starts made by Gustavo -->
  <section class="review" id="review">
    <h1 class="heading">Customer's <span>review</span></h1>
    <div class="box-container">
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus,
          ratione, voluptatem reiciendis quisquam voluptate veniam labore
          magnam at ipsum sunt doloremque quas rerum error! Voluptas iste
          reiciendis praesentium dolorem tempore?
        </p>
        <div class="user">
          <img src="icons/user_3917688.png" alt="user" />
          <div class="user-info">
            <h3>john doe</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- review section ends -->
  <!-- blog setion starts  made by Navneet-->
  <section class="blogs" id="blogs">
    <h1 class="heading">Our <span>blogs</span></h1>

    <div class="content">
      <h2>daily dose of coffee</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam sunt
        adipisci, vitae neque id rem ducimus reprehenderit eos ut rerum vel
        iure pariatur quidem minima eveniet at dignissimos dolorum sed placeat
        quia accusantium. Itaque atque at asperiores optio aut, porro,
        aspernatur voluptate a dolor quod explicabo. Fugit expedita magnam ea
        ad, provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure. Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Veniam sunt adipisci, vitae
        neque id rem ducimus reprehenderit eos ut rerum vel iure pariatur
        quidem minima eveniet at dignissimos dolorum sed placeat quia
        accusantium. Itaque atque at asperiores optio aut, porro, aspernatur
        voluptate a dolor quod explicabo. Fugit expedita magnam ea ad,
        provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure.Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Veniam sunt adipisci, vitae
        neque id rem ducimus reprehenderit eos ut rerum vel iure pariatur
        quidem minima eveniet at dignissimos dolorum sed placeat quia
        accusantium. Itaque atque at asperiores optio aut, porro, aspernatur
        voluptate a dolor quod explicabo. Fugit expedita magnam ea ad,
        provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure.
      </p>
      <br />
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore
        explicabo excepturi perferendis quasi dicta ad. Lorem ipsum dolor sit
        amet consectetur adipisicing elit. Veniam sunt adipisci, vitae neque
        id rem ducimus reprehenderit eos ut rerum vel iure pariatur quidem
        minima eveniet at dignissimos dolorum sed placeat quia accusantium.
        Itaque atque at asperiores optio aut, porro, aspernatur voluptate a
        dolor quod explicabo. Fugit expedita magnam ea ad, provident non
        impedit, possimus voluptatum amet perspiciatis consequatur in
        cupiditate eaque incidunt autem quo est at iusto quaerat quia saepe
        officiis nobis debitis. Nostrum praesentium est obcaecati aspernatur
        debitis mollitia optio asperiores nemo doloremque expedita quia, amet
        hic laboriosam beatae! Voluptas quidem perspiciatis aspernatur iste!
        Debitis iste sed iure. Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Veniam sunt adipisci, vitae neque id rem ducimus
        reprehenderit eos ut rerum vel iure pariatur quidem minima eveniet at
        dignissimos dolorum sed placeat quia accusantium. Itaque atque at
        asperiores optio aut, porro, aspernatur voluptate a dolor quod
        explicabo. Fugit expedita magnam ea ad, provident non impedit,
        possimus voluptatum amet perspiciatis consequatur in cupiditate eaque
        incidunt autem quo est at iusto quaerat quia saepe officiis nobis
        debitis. Nostrum praesentium est obcaecati aspernatur debitis mollitia
        optio asperiores nemo doloremque expedita quia, amet hic laboriosam
        beatae! Voluptas quidem perspiciatis aspernatur iste! Debitis iste sed
        iure.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam
        sunt adipisci, vitae neque id rem ducimus reprehenderit eos ut rerum
        vel iure pariatur quidem minima eveniet at dignissimos dolorum sed
        placeat quia accusantium. Itaque atque at asperiores optio aut, porro,
        aspernatur voluptate a dolor quod explicabo. Fugit expedita magnam ea
        ad, provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure.Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Veniam sunt adipisci, vitae
        neque id rem ducimus reprehenderit eos ut rerum vel iure pariatur
        quidem minima eveniet at dignissimos dolorum sed placeat quia
        accusantium. Itaque atque at asperiores optio aut, porro, aspernatur
        voluptate a dolor quod explicabo. Fugit expedita magnam ea ad,
        provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure.Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Veniam sunt adipisci, vitae
        neque id rem ducimus reprehenderit eos ut rerum vel iure pariatur
        quidem minima eveniet at dignissimos dolorum sed placeat quia
        accusantium. Itaque atque at asperiores optio aut, porro, aspernatur
        voluptate a dolor quod explicabo. Fugit expedita magnam ea ad,
        provident non impedit, possimus voluptatum amet perspiciatis
        consequatur in cupiditate eaque incidunt autem quo est at iusto
        quaerat quia saepe officiis nobis debitis. Nostrum praesentium est
        obcaecati aspernatur debitis mollitia optio asperiores nemo doloremque
        expedita quia, amet hic laboriosam beatae! Voluptas quidem
        perspiciatis aspernatur iste! Debitis iste sed iure.
      </p>
      <br />
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis
        corrupti dolor incidunt maiores? Ipsam itaque consectetur blanditiis
        earum molestiae corrupti!
      </p>
    </div>
    <!-- <img
          src="images/fresh-coffee-steam-rises-from-single-dark-mug-generated-by-ai.jpg"
          alt=""
        /> -->
  </section>
  <!-- blog setions ends -->
  <!-- contact section starts made by Damola -->
  <section class="contact" id="contact">
    <h1 class="heading"><span>Contact</span> us</h1>
    <div class="row">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2895.101780122779!2d-80.52108322389472!3d43.47934627111091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882bf31d0cec9491%3A0x8bf5f60c306d2207!2sConestoga%20College%20Waterloo%20Campus!5e0!3m2!1sen!2sca!4v1697044627199!5m2!1sen!2sca" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <form action="contact-us-success.php" method="post">
        <h3>Get in touch</h3>
        <div class="inputbox">
          <span class="fas fa-user"></span>
          <input type="text" placeholder="name" name="name" />
        </div>
        <div class="inputbox">
          <span class="fas fa-envelope"></span>
          <input type="email" placeholder="group6@gmail.com" name="email" />
        </div>
        <div class="inputbox">
          <span class="fas fa-phone"></span>
          <input type="number" placeholder="1234567890" name="phone" />
        </div>
        <div class="inputbox">
          <input type="text" placeholder="Tell us about your query" name="message" />
        </div>
        <input type="submit" value="contact now" class="btn" />
      </form>
    </div>
  </section>
  <!-- contact section ends -->
  <!-- footer section starts made by Gustavo-->
  <section class="footer">
    <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-pinterest"></a>
    </div>
    <div class="links">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#products">Product</a>
      <a href="#review">Review</a>
      <a href="#blogs">Blogs</a>
      <a href="#contact">Contact</a>
    </div>
    <div class="credit">created by <span>GROUP 6</span></div>
  </section>
  <!-- footer section ends -->
  <script src="index.js"></script>
</body>

</html>