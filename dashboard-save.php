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
    <title>Dashboard</title>
</head>

<body>
    <?php
        require('database.php');
        session_start();

        //created empty array for error messages to count errors 
        $errors = [];

        
        //Validating password regarding if password field is empty
        if (!empty($_REQUEST ['address'])) {
            $address = $_REQUEST['address'];
        } else {
            $address = NULL;
        }

        //preparing data to database
        if(count($errors) == 0) {

            $address_clean = prepare_string($dbc, $address);


            $q = 'UPDATE users SET address = ( ? ) WHERE userid = ' . $_SESSION['user_id'];

            $stmt = mysqli_prepare($dbc, $q);

            mysqli_stmt_bind_param(
                $stmt,
                's',
                $address_clean,
            );

            $result = mysqli_stmt_execute($stmt);
            
            if($result) {
                header('Location: dashboard.php?changes=saved');
            }
            } else {
                $_SESSION["error_registration"] = $errors;
                header('Location: register.php');
            }
    ?>
</body>
</html>