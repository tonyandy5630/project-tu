<?php

loadModel('admin');
$id = $_GET['id'];

if (isset($id)) {
    $admin = new Admin();
    $success = $admin->delete_by_id($id);
    $admins = $admin->get_all();
    $title = "Admin Page";
    if ($success) {
        loadView("member/index", $title, ADMIN, ["admins" => $members]);
    }
}
