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
    <title>Form sent</title>
</head>

<body>
    <?php
        require('database.php');

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

        //Validating phone number regarding if phone field is empty
        if (!empty($_REQUEST ['phone'])) {
            $phone = $_REQUEST['phone'];
        } else {
            $phone = NULL;
            $errors[] = '<p class="error">Please enter a phone number</p>';
        }

        //Validating phone number regarding if phone field is properly filled.
        if(preg_match("/^[0-9]{10}+/", $phone)) {
            echo '<p></p>';
            } else {
                $phone = NULL;
            echo '<p class="error">Please use a canadian phone number. Write your phone number with numbers only.</p>';
            }

        //Validating message box regarding if message field is empty
        if (!empty($_REQUEST ['message'])) {
            $message = $_REQUEST['message'];
        } else {
            $message = NULL;
            $errors[] = '<p class="error">Please enter your message</p>';
        }

        //preparing data to database
        if(count($errors) == 0) {

            $name_clean = prepare_string($dbc, $name);
            $email_clean = prepare_string($dbc, $email);
            $phone_clean = prepare_string($dbc, $phone);
            $message_clean = prepare_string($dbc, $message);


            $q = "INSERT INTO contact_us(name, email, phone, message) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_prepare($dbc, $q);

            mysqli_stmt_bind_param(
                $stmt,
                'ssis',
                $name_clean,
                $email_clean,
                $phone_clean,
                $message_clean
            );

            $result = mysqli_stmt_execute($stmt);
            
            if($result) {
                echo '<p class="heading">Thank you for your contact. We will reach out shortly.</p>';
                echo '<a href="index.php" class="form-anchor">Go to home page</a>';
            }
            } else {
                foreach($errors as $error) {
                    echo $error;
        }
    }
    ?>
</body>
</html>