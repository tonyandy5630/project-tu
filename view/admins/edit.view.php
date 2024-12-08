<body>
    <div class="container-sm mx-auto py-3">
        <h3 class="fw-bold text-md-start text-center">Update Member</h3>
        <form method="post">
            <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id'] ?>"> <br>
            <div class="row">
                <div class="col">
                    <!-- image  -->
                    <label for="email" class="form-text"><b>Email</b> </label> <br>
                    <input autofocus type="text" name="email" class="form-control" value="<?php echo $admin->get_email() ?>"> <br>
                </div>
                <div class="col">
                    <!-- description -->
                    <label for="password" class="form-text"><b>Password</b></label> <br>
                    <input type="text" value="<?= $admin->get_password() ?>" name="password" class="form-control"> <br>
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