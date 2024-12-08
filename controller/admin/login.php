<?php
loadModel("admin");
$title = "Admin Login";
$loginFailed = null;

if (!empty($_POST)) {
    $email = $password = '';
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (!empty($email)) {
        $admin = new Admin();
        $loginAdmin = $admin->login($email, $password);
        if ($result !== null) {
            //login success
            $loginFailed = false;
            $_SESSION['admin_email'] = $loginAdmin->get_email();
            header('Location: /admin');
            exit();
        }
        $loginFailed = true;
    }
}


loadView("admin/login", $title, ADMIN, ["loginFailed" => $loginFailed]);
