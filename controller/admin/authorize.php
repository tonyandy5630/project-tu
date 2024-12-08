<?php
$adminLoggedIn = isset($_SESSION['admin_email']);
if (!$adminLoggedIn) {
    header('Location: /admin/login');
    exit();
}
