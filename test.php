<?php

session_start();
echo $_SESSION['login'];
echo $_SESSION['user_email'];

/*if (isset($_SESSION['login'])) {
    if (isset($_SESSION['user_email'])) {
        echo '<p>' . $_SESSION['user_email'] . '</p>';
    }
}*/
?>
