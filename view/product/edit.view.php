<body>
    <div class="container-sm mx-auto py-3">
        <h3 class="fw-bold text-md-start text-center">Update Product</h3>
        <form method="post">
            <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id'] ?>"> <br>
            <!-- name  -->
            <div class="row">
                <div class="col-md-6">

                    <label for="name" class="form-text"><b>Product Name</b></label> <br>
                    <input type="text" name="name" class="form-control" value="<?php echo $product->get_name() ?>"> <br>
                </div>
                <div class="col-md-6">
                    <!-- price -->
                    <label for="price" class="form-text"><b>Price</b></label> <br>
                    <input type="text" name="price" class="form-control" value="<?php echo $product->get_price() ?>"> <br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- image  -->
                    <label for="img" class="form-text"><b>Image</b> </label> <br>
                    <input type="text" name="img" class="form-control" value="<?php echo $product->get_img() ?>"> <br>
                </div>
                <div class="col-md-6 ">
                    <img src="<?= $product->get_img()  ?>" class="form-img" alt="<?= $product->get_name() ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="type" class="form-text"><b>Category</b></label> <br>
                    <!-- Category  -->
                    <?php
                    foreach ($categories as $cate) {
                    ?>
                        <div class="form-check form-check-inline">
                            <input <?= in_array($cate['id'], $product->get_categories()) ? 'checked' : '' ?> class="form-check-input" name="categories[]" type="checkbox" value=<?= $cate['id'] ?> id=<?= $cate['id'] ?>>
                            <label class="form-check-label" for=<?= $cate['id'] ?>>
                                <?= $cate['name'] ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- description -->
                    <label for="description" class="form-text"><b>Description</b></label> <br>
                    <textarea type="text" name="description" class="form-control"><?= $product->get_description() ?></textarea> <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
            <?php
            if (isset($updateSuccess)) {
                if ($updateSuccess) {
            ?>
                    <p class="alert alert-success">Update Successful</p>
                <?php
                } else {
                ?>
                    <p class="alert alert-danger">Update Failed</p>
            <?php
                }
            }

            ?>
        </form>
    </div>
</body>

</html>