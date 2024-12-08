<body>
    <div class="container-sm mx-auto py-3">
        <h3 class="fw-bold text-md-start text-center">Add Product</h3>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <!-- name  -->
                    <label for="name" class="form-text"><b>Product Name</b></label>
                    <input type="text" name="name" class="form-control" required autofocus>
                </div>
                <div class="col-md-6">
                    <!-- price -->
                    <label for="price" class="form-text"><b>Price</b></label>
                    <input type="number" name="price" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- image  -->
                    <label for="img" class="form-text"><b>Image</b> </label>
                    <input type="text" name="img" class="form-control" required>
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
                            <input class="form-check-input" name="categories[]" type="checkbox" value=<?= $cate['id'] ?> id=<?= $cate['id'] ?>>
                            <label class="form-check-label" for=<?= $cate['id'] ?>>
                                <?= $cate['name'] ?>
                            </label>
                        </div>
                    <?php } ?>
                    <?php if (isset($hasCategories)) {
                        if (!$hasCategories)
                    ?>
                        <p class="text-danger">Please select at least one category</p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- description -->
                    <label for="description" class="form-text"><b>Description</b></label>
                    <textarea type="text" name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    <button class="btn btn-primary">Add</button>
                    <button class="btn btn-outline-warning" type="reset">Reset</button>
                </div>
            </div>
            <?php
            if (isset($addSuccess)) {
                if ($addSuccess) {
            ?>
                    <p class="alert alert-success">Add Successful</p>
                <?php
                } else {
                ?>
                    <p class="alert alert-danger">Add Failed</p>
            <?php
                }
            }

            ?>
        </form>
    </div>
</body>

</html>