<body>
    <div class="container-sm mx-auto py-3">
        <h2 class="my-2 fw-bold text-md-start text-center">Add Admin</h2>
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <!-- email -->
                    <label for="email" class="form-text"><b>Email</b> </label> <br>
                    <input type="text" name="email" class="form-control"> <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- password -->
                    <label for="password" class="form-text"><b>Password</b></label> <br>
                    <input type="password" name="password" class="form-control"> <br>
                </div>
            </div>
            <!-- submit -->
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary">Add</button>
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
                    <p class="alert alert-danger">Update Failed</p>
            <?php
                }
            }

            ?>
        </form>
    </div>
</body>
<script src="main.js"></script>

</html>