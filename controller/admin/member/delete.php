<?php
loadModel('member');
$id = $_GET['id'];

if (isset($id)) {
    $admin = new Member();
    $success = $admin->delete_by_id($id);
    $members = $admin->get_all(1);
    $title = "Member Page";
    if ($success) {
        loadView("member/index", $title, ADMIN, ["members" => $members, "pageCount" => 0]);
    }
}
