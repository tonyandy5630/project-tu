<body>
    <div class="container-sm mx-auto py-3">
        <a href="/admin/members/add" class="btn btn-primary">Add Member</a>
        <table class="table">
            <thead>
                <tr>
                    <td scope="col">Name</td>
                    <td scope="col">Phone Number</td>
                    <td scope="col">Email</td>
                    <td scope="col">Password</td>
                    <td scope="col">Create At</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($members) > 0) {
                    foreach ($members as $admin) {
                ?>
                        <tr>
                            <td><?php echo $admin['username'] ?></td>
                            <td><?php echo $admin['phone_number'] ?></td>
                            <td><?php echo $admin['email'] ?></td>
                            <td><?php echo $admin['password'] ?></td>
                            <td><?php echo $admin['iat'] ?></td>
                            <td>
                                <a class="btn btn-outline-primary" href="/admin/members/edit?id=<?= $admin['id']  ?>">Edit</a>
                                <a class="btn btn-danger" href="/admin/members/delete?id=<?php echo $admin['id'] ?>">Delete</a>
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
                            <a class="page-link <?= (int)$page === 1 ? 'disabled' : '' ?>" href="members?page=<?= (int)$page - 1  ?>">Previous</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $pageCount; $i++) {
                        ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link <?= (int)$page === $i ? 'active' : '' ?>" href="members?page=<?= $i ?>"><?php echo $i ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link <?= (int)$page === (int)$pageCount ? 'disabled' : '' ?>" href="members?page=<?= (int)$page + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>