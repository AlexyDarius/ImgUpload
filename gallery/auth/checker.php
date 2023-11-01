<?php

session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.php'); // Redirect to the login page if not authenticated
    exit;
}

?>