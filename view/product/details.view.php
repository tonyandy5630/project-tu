<?php
$ProductId = $_GET['ProductId'];
if (isset($_POST['add'])) {
    if (empty($_SESSION['email'])) {
        header('Location: ../user/login.php');
    } else {
        $email = $_SESSION['email'];
        $sql = "select id from members where email='$email'";
        $result = execute($sql);
        $UserId;

        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        foreach ($result as $admin) {
            $UserId = $admin['id'];
        }
        $sql = "insert into products_in_cart (productId,size,quantity) values ('$ProductId','$size','$quantity')";
        execute($sql);
    }
}
?>
<div>
    <form method="post" action="">
        <input type="hidden" name="ProductId" value="<?php echo $ProductId ?>">
        <select name="size">
            <option value="">Size</option>
            <option value="S">X</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
        <label for="quantity">So Luong</label>
        <input type="number" name="quantity">
        <button class="btn btn-success" name="add">Them vao gio hang</button>
    </form>
</div>