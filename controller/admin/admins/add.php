<?php
loadModel("admin");
$title = "Add Admin";
$addSuccess = null;

if (!empty($_POST)) {
    $email = $password = "";

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    $admin = new Admin();
    $newAdmin = Admin::construct_with_args($email, $password);

    $addSuccess = $admin->add($newAdmin);
    if ($addSuccess) {
        $success = true;
    }
}

loadView("/admins/add", $title, ADMIN, ["addSuccess" => $addSuccess]);
