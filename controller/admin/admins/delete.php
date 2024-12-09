<?php

loadModel('admin');
$id = $_GET['id'];

if (isset($id)) {
    $admin = new Admin();
    $success = $admin->delete_by_id($id);
    $admins = $admin->get_all(1);
    $title = "Admin Page";
    if ($success) {
        loadView("admins/index", $title, ADMIN, ["admins" => $admins, "pageCount" => 0]);
    }
}
