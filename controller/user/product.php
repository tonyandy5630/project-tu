<?php

$view = "product/products";
$title = "Product Page";

loadModel('product');
loadModel('category');

$product = new Product();
$admin = Product::construct_0_args();
$category = Category::construct_0_args();

$products = [];
$page = $_GET['page'] ?? 1;

$memberCount = $product->count();
$pageCount = (string)ceil($memberCount / PAGE_LIMIT);

if (!empty($_GET['category'])) {
    $type = $_GET['category'];
    $products = $admin->get_products_by_category($type);
} else {
    $products = $admin->get_all_product($page);
}
$categories = $category->get_all_category();

loadView($view, $title, USER, [
    "categories" => $categories,
    "products" => $products,
    "page" => $page,
    "pageCount" => $pageCount
]);
