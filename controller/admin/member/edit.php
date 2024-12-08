<?php

loadModel('member');
$title = "Update Member";

$admin = new Member();
$id = $_GET['id'];
$curAdmin = $admin->get_by_id($id);
if (empty($id)) {

    header('Location: admin/members');
}
$success = null;
if (!empty($_POST)) {
    $hasUsername = isset($_POST['username']);
    $hasPhoneNumber = isset($_POST['phone_number']);
    $hasEmail = isset($_POST['email']);
    $hasPassword = isset($_POST['password']);

    $valid = $hasUsername && $hasPhoneNumber && $hasEmail && $hasPassword;
    if ($valid) {
        $username = $_POST['username'];
        $phoneNumber = $_POST['phone_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $uAdmin = Member::construct_with_args($username, $phoneNumber, $email, $password);
        $updateSuccess = $admin->edit($id, $uAdmin);
        if ($updateSuccess !== null) {
            $success = true;
            $curAdmin = $updateSuccess;
        }
    }
}

loadView('member/edit', $title, ADMIN, [
    "updateSuccess" => $success,
    "member" => $curAdmin
]);
