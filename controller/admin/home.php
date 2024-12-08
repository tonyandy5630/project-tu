<?php
require 'authorize.php';
loadModel('product');
$product = new Product();
$page = $_GET['page'] ?? 1;

$memberCount = $product->count();
$pageCount = (string)ceil($memberCount / PAGE_LIMIT);

$products = $product->get_all_product($page);
$title = "Admin Homepage";
loadView("product/index", $title, ADMIN, [
    "products" => $products,
    "page" => $page,
    "pageCount" => $pageCount
]);
