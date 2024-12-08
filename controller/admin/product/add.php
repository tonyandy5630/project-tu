<?php
include __DIR__ . '/../authorize.php';
loadModel('product');
loadModel('category');
$category = Category::construct_0_args();
$productCategories = $category->get_all_category();

$addSuccess = null;
$hasCategories = null;
if (!empty($_POST)) {
    $name = $price = $img = $type = $material = $description = "";
    $hasCategories = isset($_POST['categories']);
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['img']) && isset($_POST['categories'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $description = $_POST['description'];
        $categories = $_POST['categories'];

        $admin = Product::construct_with_args($name, $img, $description, $price, $categories);
        $addSuccess = $admin->create_product($categories);
    }
}



$title = "Add Product";
loadView("product/add", $title, ADMIN, [
    "addSuccess" => $addSuccess,
    "categories" => $productCategories,
]);
