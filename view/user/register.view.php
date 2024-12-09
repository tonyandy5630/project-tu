<?php
if (!empty($_POST)) {
    $name = $phone = $email = $password = $password2 = "";
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['password2'])) {
        $password2 = $_POST['password2'];
    }
    $sql = "insert into members (id,username,phone_number,email,password) values(UUID(),'$name','$phone','$email','$password')";
    execute($sql);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: /login');
}

?>

<body>
    <div class="container-sm mx-auto py-3">
        <h2 class="my-2 fw-bold text-md-start text-center">Register Page</h2>
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <!-- name  -->
                    <label for="firstName" class="form-text"><b>Fullname</b></label> <br>
                    <input type="text" name="name" class="form-control"> <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="secondName" class="form-text"><b>Phone Number</b></label> <br>
                    <input type="text" name="phone" class="form-control"> <br>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-4">
                    <!-- nhap lai password  -->
                    <label for="password" class="form-text"><b>Re-enter Password</b></label> <br>
                    <input type="password" name="password2" class="form-control"> <br>
                </div>
            </div>
            <!-- submit -->
            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</body>

</html>