<?php
$title = "Register User";
if (!empty($_POST)) {
    $name = $phone = $email = $password = $password2 = "";
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['password2'])) {
        $password2 = $_POST['password2'];
    }
    $sql = "insert into members (id,username,phone_number,email,password) values(UUID(),'$name','$phone','$email','$password')";
    execute($sql);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: /login');
}

loadView('/user/register', $title, ADMIN, []);
