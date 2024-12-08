<?php
include __DIR__ . '/../authorize.php';
loadModel('product');
loadModel('category');
$id = $_GET['id'];
$category = new Category();
$categories = $category->get_all_category();
$Product = new Product();
$admin = $Product->get_product_by_id($id);
$success = null;
if (!empty($_POST)) {

    // print_r($_POST);
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['img']) && isset($_POST['categories'])  && isset($_POST['description'])) {
        $description =  $_POST['description'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $uCategories = $_POST['categories'];

        $uProduct = Product::construct_with_args($name, $img, $description, $price, $uCategories);
        $updateSuccess = $Product->update_product_by_id($id, $uProduct);
        $success = $updateSuccess !== null;
        if ($updateSuccess !== null) {
            $admin = $updateSuccess;
        }
    }
}

$title = "Edit Product";
loadView("product/edit", $title, ADMIN, [
    "product" => $admin,
    "categories" => $categories,
    "updateSuccess" => $success
]);
