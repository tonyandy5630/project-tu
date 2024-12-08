<?php
loadModel('product');
$id = $_GET['id'];

if (isset($id)) {
    $admin = new Product();
    $success = $admin->delete_product_by_id($id);
    $title = "Add Product";
    loadModel('product');
    $admin = new Product();
    $products = $admin->get_all_product(1);
    $title = "Admin Homepage";
    if ($success) {
        loadView("product/index", $title, ADMIN, ["products" => $products]);
    }
}
