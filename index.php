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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <title>Daily Dose Of Coffee</title>
  </head>
  <body>

  <?php

  require('database.php');
  require('config_session.php');
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
        <div class="navbar-username">
          <?php              
            if(isset($_SESSION['user_id'])) {
              echo $_SESSION['user_name'];
            } 
          ?>
        </div>
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
            if(isset($_SESSION['cart'])) {
              if (isset($_GET['action']) && $_GET['action'] === 'add&productid') {
                $cart_result = $_SESSION['cart'];
              foreach ($cart_result as $cart_item) {?>
              
              
              <div class="cart-items">
                <span class="fas fa-times"></span>

                <img src="<?= $row["coffeeshop_img"] ?>" />
                <div class="content">
                  <h3><?= $row["name"]; ?></h3>
                  <div class="price">$<?= number_format($row["price"], 2); ?></div>
                </div>
              </div>
            
          <?php 
                }
              }
            }
          ?>
            
        <div class="checkout-btn"><a href="#" class="btn">checkout now</a></div>
      </div>
      
        
        <!--<div class="cart-items">
          <span class="fas fa-times"></span>
          <img
            src="images/top-view-fresh-roasted-coffee-beans-burlap-bag-with-coffee-beans-isolated-red-background.jpg"
            alt="coffee beans"
          />
          <div class="content">
            <h3>cart item 2</h3>
            <div class="price">$15.99</div>
          </div>
        </div>
        <div class="cart-items">
          <span class="fas fa-times"></span>
          <img
            src="images/top-view-fresh-roasted-coffee-beans-burlap-bag-with-coffee-beans-isolated-red-background.jpg"
            alt="coffee beans"
          />
          <div class="content">
            <h3>cart item 3</h3>
            <div class="price">$15.99</div>
          </div>
        </div>
        <div class="cart-items">
          <span class="fas fa-times"></span>
          <img
            src="images/top-view-fresh-roasted-coffee-beans-burlap-bag-with-coffee-beans-isolated-red-background.jpg"
            alt="coffee beans"
          />
          <div class="content">
            <h3>cart item 4</h3>
            <div class="price">$15.99</div>
          </div>
        </div>
        <div class="cart-items">
          <span class="fas fa-times"></span>
          <img
            src="images/top-view-fresh-roasted-coffee-beans-burlap-bag-with-coffee-beans-isolated-red-background.jpg"
            alt="coffee beans"
          />
          <div class="content">
            <h3>cart item 5</h3>
            <div class="price">$15.99</div>
          </div>-->
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
          <img
            src="images/fresh-coffee-steam-rises-from-single-dark-mug-generated-by-ai.jpg"
            alt="background img"
          />
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
        $cart_result = mysqli_query($dbc, $q);

        while ($row = mysqli_fetch_array($cart_result)) {?>

          
            <form method="get" action="index.php?action=add&productid" class="box">
            <img src="<?= $row["coffeeshop_img"] ?>" />
            <h3><?= $row["name"]; ?></h3>
            <div class="price">$<?= number_format($row["price"], 2); ?></div>
            <input type="hidden" name="productid" value="<?= $row['productid'] ?>" />
            <input type="hidden" name="name" value="<?= $row['name'] ?>" />
            <input type="hidden" name="price" value="<?= $row['price'] ?>" />
            <input type="submit" name="add_to_cart" class="btn" value="add to cart" />
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
          $result = mysqli_query($dbc, $q);

          while ($row = mysqli_fetch_array($result)) {?>

        
            <form method="get" action="index.php" class="box">
              <div class="image">
                <img src="<?= $row["coffeeshop_img"] ?>" />
              </div>
              <h3><?= $row["name"]; ?></h3>
              <div class="price">$<?= number_format($row["price"], 2); ?></div>
              <input type="hidden" name="productid" value="<?= $row['productid'] ?>" />
              <input type="hidden" name="name" value="<?= $row['name'] ?>" />
              <input type="hidden" name="price" value="<?= $row['price'] ?>" />
              <input type="submit" name="add_to_cart" class="btn" value="add to cart" />
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
        <iframe
          class="map"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2895.101780122779!2d-80.52108322389472!3d43.47934627111091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882bf31d0cec9491%3A0x8bf5f60c306d2207!2sConestoga%20College%20Waterloo%20Campus!5e0!3m2!1sen!2sca!4v1697044627199!5m2!1sen!2sca"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
        <form action="contact-us-success.php" method="post">
          <h3>Get in touch</h3>
          <div class="inputbox">
            <span class="fas fa-user"></span>
            <input type="text" placeholder="name" name="name"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-envelope"></span>
            <input type="email" placeholder="group6@gmail.com" name="email"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-phone"></span>
            <input type="number" placeholder="1234567890" name="phone"/>
          </div>
          <div class="inputbox">
            <input type="text" placeholder="Tell us about your query" name="message"/>
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
