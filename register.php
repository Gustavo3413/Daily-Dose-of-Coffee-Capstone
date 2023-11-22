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
    <title>Register</title>
  </head>

  <?php
  require('config_session.php');
  ?>

  <body class="login-page">
    <!--register form start-->
    <div class="login-form">
      <div class="admin-login">
        <a href="index.php" class="form-anchor">
          <img src="images/DDC Logo.png" alt="ddc logo" /> <br />
          Back to Home page</a
        >
        <h1>Register</h1>
        <br />
        <div class="login1" id="login1">
          <div class="row">
            <form action="registration-success.php" method="post">
              <div class="inputbox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name" name="username"/>
              </div>
              <div class="inputbox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="Email" name="email"/>
              </div>
              <div class="inputbox">
                <span class="fas fa-key"></span>
                <input type="password" placeholder="password" name="password"/>
              </div>
              <div class="inputbox">
                <span class="fas fa-key"></span>
                <input type="password" placeholder="confirm password" name="confirm-password"/>
              </div>
              <input
                type="submit"
                value="Register"
                name="register"
                class="btn"
              />
            </form>

            <?php
            if (isset($_SESSION['error_registration'])) {
                $errors = $_SESSION['error_registration'];

                foreach ($errors as $error) {
                    echo '</br>';
                    echo '<p style="color:red;" class="register-error">' . $error . '</p>';
                }

                unset($_SESSION['error_registration']);
            } elseif (isset($_GET['registration']) && $_GET['registration'] === 'success') {
                echo '</br>';
                echo '<p style="color:green;" class="register-success">Registration successful. You may now <a href="login.php">Log in.</a></p>';
            }
            ?>



          </div>
        </div>
        <br />

        <br />
        <a href="login.php" class="form-anchor"
          ><p>Already has an account? Click here to login!</p></a
        >
      </div>
    </div>
    <!--register form end-->
  </body>

  <script src="index.js"></script>
</html>
