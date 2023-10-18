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
    <title>Account Registered</title>
</head>

<body>
    <?php
        require('user_database.php');

        //created empty array for error messages to count errors 
        $errors = [];

        //Validating name input regarding if field is empty or not     
        if (!empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
        } else {
            $name = NULL;
            $errors[] = '<p class="error">Please enter your name</p>';
        }

        //Validating name input regarding use of only letters from the alphabet
        if (preg_match("/[^a-zA-Z]+/", $name)) {
            $name = NULL;
            $errors[] = '<p class="error">Please do not use numbers and special characters in name field.</p>';
        }

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

        if (!empty($_REQUEST ['confirm-password'])) {
            $confirm_password = $_REQUEST ['confirm-password'];
        } else {
            $confirm_password = NULL;
            $errors[] = '<p class="error">Please confirm your password</p>';
        }

        if ($confirm_password != $password) {
            $confirm_password = NULL;
            $errors[] = '<p class="errors">Your passwords did not match, please try again</p>';
        }

        //preparing data to database
        if(count($errors) == 0) {

            $name_clean = prepare_string($dbc, $name);
            $email_clean = prepare_string($dbc, $email);
            $password_clean = prepare_string($dbc, $password);


            $q = "INSERT INTO users(name, email, password) VALUES(?, ?, ?)";

            $stmt = mysqli_prepare($dbc, $q);

            mysqli_stmt_bind_param(
                $stmt,
                'sss',
                $name_clean,
                $email_clean,
                $password_clean
            );

            $result = mysqli_stmt_execute($stmt);
            
            if($result) {
                echo '<p class="heading">Thank you for your registration. You may now login.</p>';
                echo '<a href="login.html" class="form-anchor">Go to login page</a>';
            }
            } else {
                foreach($errors as $error) {
                    echo $error;
        }
    }
    ?>
</body>
</html>