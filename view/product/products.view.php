<body>
    <div class="container-sm mx-auto py-3">
        <!-- <p><a href="../user/product_in_cart.php">Gio Hang</a></p> -->
        <form method="GET" action="" class="py-3">
            <div class="row">
                <div class="col-md-4 d-flex gap-3">
                    <select class="form-select" aria-label="Category select" name="category">
                        <option value="">Choose a category</option>
                        <?php
                        $categoryParam = $_GET['category'] ?? "";
                        if (count($categories) > 0) {
                            foreach ($categories as $row) {

                        ?>
                                <option <?= $categoryParam === $row['id'] ? 'selected' : '' ?> value=<?php echo $row['id'] ?>><?php echo $row['name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary d-none d-md-block">Filter</button>
                </div>
            </div>

        </form>
        <div class="row g-3">
            <?php
            if (count($products) > 0) {
                foreach ($products as $product) {;
            ?>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="card h-100 d-flex flex-column justify-content-between">
                            <img src=<?= $product['image'] ?> class="card-img-top p-3" alt=<?= $product['name'] ?>>
                            <div class="body-group">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['name'] ?></h5>
                                    <p class="card-text"><?= $product['description'] ?></p>
                                    <a href="detailProduct.php?ProductId=<?php echo $product[0] ?>" class="btn btn-primary">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <?php
        print_r($_GET);
        $isFiltering = isset($_GET['category']);
        if (!$isFiltering) {
        ?>
            <div class="row my-3">
                <div class="col">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item <?= (int) $page === 1 ? 'disabled' : '' ?>">
                                <a class="page-link <?= (int) $page === 1 ? 'disabled' : '' ?>" href="product?page=<?= (int) $page - 1 ?>">Previous</a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pageCount; $i++) {
                            ?>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link <?= (int) $page === $i ? 'active' : '' ?>" href="product?page=<?= $i ?>"><?php echo $i ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link <?= (int) $page === (int) $pageCount ? 'disabled' : '' ?>" href="product?page=<?= (int) $page + 1 ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } ?>

    </div>
</body>

</html>