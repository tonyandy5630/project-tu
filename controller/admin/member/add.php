<?php
loadModel('member');
$title = "Add Member";
$success = null;
if (!empty($_POST)) {
    $name = $phone = $email = $password = "";
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

    $admin = new Member();
    $newMember = Member::construct_with_args($name, $phone, $email, $password);

    $addSuccess = $admin->add($newMember);
    if ($addSuccess) {
        $success = true;
    }
}

loadView("member/add", $title, ADMIN, ["addSuccess" => $success]);
