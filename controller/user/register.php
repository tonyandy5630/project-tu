<?php $view = "user/register";
$title = "Register Member";

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

// $sql = "insert into members (id,username,phone_number,email,password) values(UUID(),'$name','$phone','$email','$password')";
// execute($sql);



loadView($view, $title, USER);
