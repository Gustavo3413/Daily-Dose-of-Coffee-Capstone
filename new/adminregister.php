<?php 
session_start();
include('includes/header.php'); 
//require('../dbcon.php');
?>
<!-- register form start -->
<div class="login-form">
  <div class="admin-login">
    <a href="index.html" class="form-anchor">
      <img src="images/DDC Logo.png" alt="ddc logo" /> <br />
      Back to Home page</a
    >
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <?php if(isset($_SESSION['message'])) { ?>
        <strong>Hey!</strong> <?=$_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <?php
        unset($_SESSION['message']);
      }
      ?>
    </div>
    <h1>Register</h1>
    <br />
    <div class="login1" id="login1">
      <div class="row">
        <form action="functions/authcode.php" method="post">
          <div class="inputbox">
            <span class="fas fa-user"></span>
            <input type="text" placeholder="name" name="name"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-envelope"></span>
            <input type="email" placeholder="Email" name="email"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-phone"></span>
            <input type="tel" placeholder="Phone" name="phone"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-key"></span>
            <input type="password" placeholder="password" name="password"/>
          </div>
          <div class="inputbox">
            <span class="fas fa-key"></span>
            <input type="password" placeholder="confirm password" name="confirm_password"/>
          </div>
          <input
            type="submit"
            value="Register"
            name="register_btn"
            class="btn"
          />
        </form>
      </div>
    </div>
    <br />
    <a href="login.php" class="form-anchor"
      ><p>Already have an account? Click here to login!</p></a
    >
  </div>
</div>
<!-- register form end -->

<?php include('includes/footer.php'); ?>
