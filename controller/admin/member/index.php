<?php
loadModel("member");
$member = new Member();
$title = "Members Page";

$page = $_GET['page'] ?? 1;
$members = $member->get_all($page);

$memberCount = $member->count();
$pageCount = (string)ceil($memberCount / PAGE_LIMIT);


loadView("member/index", $title, ADMIN, [
    "members" => $members,
    "page" => $page,
    "pageCount" => $pageCount
]);
