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
    <title>Login Attempt</title>
</head>

<body>

<?php    

 

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_clean = $_POST["email"];
    $password_clean = $_POST["password"];
    $user_id = $_POST["userid"];
    $user_name = $_POST["username"];

    // requiring database connection file
    require('database.php'); 

    // array created to store errors
$errors = [];

// validate email input regarding if the field is empty or not
if (!empty($_REQUEST['email'])) {
    $email = $_REQUEST['email'];
} else {
    $email = NULL;
    $errors[] = '<p class="error">Please enter your email address.</p>';
}

// validate email input regarding if data entered is a valid email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
} else {
    $email = NULL;
    $errors[] = '<p class="error">Please enter a valid email address. e.g. domain@example.com</p>';
}

// validate the password regarding if the password field is empty
if (!empty($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
} else {
    $password = NULL;
    $errors[] = '<p class="error">Please type a password</p>';
}

// requiring session start file
require('config_session.php');

// prepare the email and password for database query
$email_clean = prepare_string($dbc, $email);
$password_clean = prepare_string($dbc, $password);

// selecting data from database
$q = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($dbc, $q);
mysqli_stmt_bind_param($stmt, "s", $email_clean);
mysqli_stmt_execute($stmt);

// statement preparation
$result = mysqli_stmt_get_result($stmt);

// checking if database returns a result
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] === $email_clean && $row['password'] === $password_clean) {
        header('Location: index.php?login=success');
        
    } else {
        $errors[] = '<p class="error">Invalid email or password</p>';
    }
} else {
    $_SESSION['error_login'] = $errors;
    header("Location: login.php");
}

// counting and showing errors
if (count($errors) > 0) {
    $_SESSION['error_login'] = $errors;
    header("Location: login.php");
}

$new_session_id = session_create_id();
$sessionid = $new_session_id . "_" . $result['userid'];
session_id($sessionid);

$_SESSION['user_id'] = $result['userid'];
$_SESSION['user_name'] = htmlspecialchars($result['username']);
$_SESSION['user_email'] = htmlspecialchars($result['email']);

} else {
    header("Location: index.php");
    die();
}

?>
    
</body>
</html>
