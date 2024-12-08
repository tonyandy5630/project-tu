<?php session_start(); // Start the session to access session variables

// Destroy the session and redirect to login page
session_unset();
session_destroy();
setcookie('rememberMe', '', time() - 999999, "/"); // Expire the cookie
header('Location: /login');
exit();
