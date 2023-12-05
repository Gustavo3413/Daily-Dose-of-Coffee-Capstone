<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="forms.css" />
    <style>
      .row p {
        color: red;
        font-weight: bold;
      }
    </style>
    <title>Login</title>
  </head>

  <?php
    require('database.php');
    session_start();

    if(isset($_SESSION['login'])) {
      header ('Location: index.php');
    }
  ?>

  <body class="login-page">

  <script src="toggle.js"></script>
    <!-- Login form start -->
    <div class="login-form">
      <div class="admin-login">
        <a href="index.php" class="form-anchor">
          <img src="images/DDC Logo.png" alt="Logo" /><br />
          Back to Home page
        </a>
        <h1>Login</h1>
        <br />
        <!-- <form>
          
          <div class="login">
            <span class="fas fa-user"></span>
           
            <input type="email" placeholder="group6@gmail.com" />
           
            
            <div>
              <input type="password" placeholder="password" />
            </div>
          </div>

          <a href="forgot-password.html" class="forgot-pwd">
            <p>Forgot password?</p></a
          >
          <br />
          <p align="center">
            <input
              type="button"
              onclick="indexpage()"
              name="submit"
              id="submit"
              value="Login"
              class="btn"
            />
          </p>
        </form> -->

        <div class="login1" id="login1">
          <div class="row">
            <form action="user-login.php" method="post" name="login" id="form" class="form">
              <!-- <div class="inputbox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name" />
              </div> -->
              <div class="inputbox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="group6@gmail.com" name="email" id="email" />
              </div>
              <div class="inputbox">
                <span class="fas fa-key"></span>
                <input type="password" placeholder="password" name="password" id="password" />
              </div>
              <input
                type="submit"
                value="Login"
                class="btn"
              />
            </form>

            <?php
            if (isset($_SESSION['error_login'])) {
                $errors = $_SESSION['error_login'];

                foreach ($errors as $error) {
                    echo '</br>';
                    echo '<p style="color:red;" class="login-error">' . $error . '</p>';
                }
                unset($_SESSION['error_login']);
            }?>

          </div>
          <a href="forgot-password.html" class="forgot-pwd">
                <p>Forgot password?</p></a
              >
        </div>
        <br />
        <a href="register.php" class="form-anchor"
          ><p>No account? Click here to register!</p>
        </a>
        <br />
      </div>
    </div>
    <!-- Login form end -->
  </body>
</html>
