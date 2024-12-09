<body>
    <div class="container-sm mx-auto py-3">
        <a href="/admin/product/add" class="btn btn-primary">Add Products</a>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td scope="col">Name</td>
                        <td scope="col">Price</td>
                        <td scope="col">Image</td>
                        <td scope="col">Description</td>
                        <td scope="col">Create Add</td>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($products) > 0) {
                        foreach ($products as $product) {
                            $id = str_replace('-', '', $product['id']);
                    ?>
                            <tr>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['price'] ?></td>
                                <td><img src=<?= $product['image'] ?> alt=<?= $product['name'] ?> width="100px" class="table-img" /></td>
                                <td><?php echo $product['description'] ?></td>
                                <td><?php echo $product['iat'] ?></td>
                                <td>
                                    <a class="btn btn-outline-primary" href="/admin/product/edit?id=<?php echo $product['id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="/admin/product/delete?id=<?php echo $product['id'] ?>">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row my-3">
            <div class="col">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link <?= (int)$page === 1 ? 'disabled' : '' ?>" href="admin?page=<?= (int)$page - 1  ?>">Previous</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $pageCount; $i++) {
                        ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link <?= (int)$page === $i ? 'active' : '' ?>" href="admin?page=<?= $i ?>"><?php echo $i ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link <?= (int)$page === (int)$pageCount ? 'disabled' : '' ?>" href="admin?page=<?= (int)$page + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>