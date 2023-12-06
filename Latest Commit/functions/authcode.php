<?php
session_start();
include('../config/dbcon.php');

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($dbc, $_POST['name']);
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $phone = mysqli_real_escape_string($dbc, $_POST['phone']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $cpassword = mysqli_real_escape_string($dbc, $_POST['password']);

    // check if email is already registered
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($dbc, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email already registered!";
        header('Location: ../adminregister.php');
    } else {
        if ($password == $cpassword) {
            //Insert user data using prepared statement
            $insert_query = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $password);
            $insert_query_run = mysqli_stmt_execute($stmt);

            if ($insert_query_run) {
                $_SESSION['message'] = "Registration Successful";
                header('Location: ../adminlogin.php');
            } else {
                $_SESSION['message'] = "Something went wrong!";
                header('Location: ../adminregister.php');
            }
        } else {
            $_SESSION['message'] = "Passwords do not match";
            header('location: ../adminregister.php');
        }
    }
} elseif (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $select_user = "SELECT * FROM users WHERE email='$email' AND password= '$password' ";
    $result = mysqli_query($dbc, $select_user);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($result);
        $username = $userdata['name'];
        $useremail = $userdata['email'];

        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail
        ];

        $_SESSION['message'] = "Logged In successfully";
        header("Location:../admin/index.php");
    } else {
        $_SESSION['message'] = "Invalid Email or Password!";
        header("Location:../adminlogin.php");
    }
}
?>
