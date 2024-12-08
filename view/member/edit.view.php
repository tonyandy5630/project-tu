<body>
    <div class="container-sm mx-auto py-3">
        <h3 class="fw-bold text-md-start text-center">Update Member</h3>
        <form method="post">
            <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id'] ?>"> <br>
            <!-- name  -->
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="form-text"><b>Username</b></label> <br>
                    <input type="text" name="username" class="form-control" value="<?php echo $member->get_username() ?>"> <br>
                </div>
                <div class="col-md-6">
                    <!-- price -->
                    <label for="phone_number" class="form-text"><b>Phone Number</b></label> <br>
                    <input type="text" name="phone_number" class="form-control" value="<?php echo $member->get_phone_number() ?>"> <br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- image  -->
                    <label for="email" class="form-text"><b>Email</b> </label> <br>
                    <input type="text" name="email" class="form-control" value="<?php echo $member->get_email() ?>"> <br>
                </div>
                <div class="col">
                    <!-- description -->
                    <label for="password" class="form-text"><b>Password</b></label> <br>
                    <input type="text" value="<?= $member->get_password() ?>" name="password" class="form-control"> <br>
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