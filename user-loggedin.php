<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>
        p {
            color: #fff;
        }
    </style>
    <title>login attempt</title>
</head>

<body>

<?php    
        require('database.php');

        //created empty array for error messages to count errors 
        $errors = [];

        //Validating email input regarding if field is empty or not
        if (!empty($_REQUEST['email'])) {
	        $email = $_REQUEST['email'];
        } else {
	        $email = NULL;
	        $errors[] = '<p class="error">Please enter your email adress.</p>';
        }

        //Validating email input regarding if data entered is a valid email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<p></p>';
        } else {
            $email = NULL;
            $errors[] = '<p class="error">Please enter a valid email adress. e.g. domain@example.com</p>';
        }

        //Validating password regarding if password field is empty
        if (!empty($_REQUEST ['password'])) {
            $password = $_REQUEST['password'];
        } else {
            $password = NULL;
            $errors[] = '<p class="error">Please type a password</p>';
        }

        //preparing statement for input for validation
        $email_clean = prepare_string($dbc, $email);
        $password_clean = prepare_string($dbc, $password);


        $q = "SELECT * FROM users WHERE email = $email_clean";

        $stmt = mysqli_prepare($dbc, $q);

        $result = mysqli_stmt_execute($stmt);

        if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_assoc($result);

          if ($row['email'] === $email_clean && $row['password'] === $password_clean) {
            echo '<p><a href="user-loggedin.php">logged in! click here to go to dashboard.</a></p>';
          } else {
            $errors[] = '<p class="error">Invalid email or password</p>';
          }
        }
        
        if(count($errors) > 0) {
          foreach($errors as $error) {
            echo $error;
        }
            }
    ?>

  </body>
</html>