<body>
    <div class="container-sm mx-auto py-3">
        <a href="/admin/admins/add" class="btn btn-primary">Add Admin</a>
        <table class="table">
            <thead>
                <tr>
                    <td scope="col">Email</td>
                    <td scope="col">Password</td>
                    <td scope="col">Create At</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($admins) > 0) {
                    foreach ($admins as $admin) {
                ?>
                        <tr>
                            <td><?php echo $admin['email'] ?></td>
                            <td><?php echo $admin['password'] ?></td>
                            <td><?php echo $admin['iat'] ?></td>
                            <td>
                                <a class="btn btn-outline-primary" href="/admin/admins/edit?id=<?= $admin['id']  ?>">Edit</a>
                                <a class="btn btn-danger" href="/admin/admins/delete?id=<?php echo $admin['id'] ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="row my-3">
            <div class="col">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link <?= (int)$page === 1 ? 'disabled' : '' ?>" href="admins?page=<?= (int)$page - 1  ?>">Previous</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $pageCount; $i++) {
                        ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link <?= (int)$page === $i ? 'active' : '' ?>" href="admins?page=<?= $i ?>"><?php echo $i ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link <?= (int)$page === (int)$pageCount ? 'disabled' : '' ?>" href="admins?page=<?= (int)$page + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>