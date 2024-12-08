<?php

loadModel("admin");
$title = "Admins Page";
$admin = new Admin();
$page = $_GET['page'] ?? 1;
$admins = $admin->get_all($page);
$adminCount = $admin->count();

$pageCount = (string)ceil($adminCount / PAGE_LIMIT);

loadView("admins/index", $title, ADMIN, [
    "admins" => $admins,
    "page" => $page,
    "pageCount" => $pageCount
]);
