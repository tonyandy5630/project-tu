<?php

loadModel('admin');
$title = "Update Admin";

$admin = new Admin();

$id = $_GET['id'];
$curAdmin = $admin->get_by_id($id);

if (empty($id)) {
    header('Location: admin/admins');
}

$success = null;
if (!empty($_POST)) {
    $hasEmail = isset($_POST['email']);
    $hasPassword = isset($_POST['password']);

    $valid =  $hasEmail && $hasPassword;
    if ($valid) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $uAdmin = Admin::construct_with_args($email, $password);
        $updateSuccess = $admin->edit($id, $uAdmin);
        if ($updateSuccess !== null) {
            $success = true;
            $curAdmin = $updateSuccess;
        }
    }
}

loadView('admins/edit', $title, ADMIN, [
    "updateSuccess" => $success,
    "admin" => $curAdmin
]);
