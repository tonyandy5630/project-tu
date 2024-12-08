<?php
$loginFailed = false;
if (!empty($_POST)) {
	$email = $password = '';
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	}
	if (!empty($email)) {
		$sql = "select * from admins where email = '$email' and password = '$password'";
		$result = executeResult($sql);
		if ($result != null && count($result) > 0) {
			//login success
			$_SESSION['admin_email'] = $email;
			header('Location: /admin');
			exit();
		}
		$loginFailed = true;
	}
}
?>

<body>
	<div class="container-sm mx-auto py-3">
		<h2 class="my-2 fw-bold text-md-start text-center">Login Page</h2>
		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<!-- email -->
					<label for="email" class="form-text"><b>Username</b> </label>
					<input name="email" class="form-control" autofocus>
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
			<div class="row ">
				<div class="col-md-4 justify-content-center d-flex gap-2 justify-content-md-start">
					<button class="btn btn-primary">Login</button>
					<a href="./register.php" class="btn btn-outline-primary">Register</a>
				</div>
			</div>
			<?php if ($loginFailed) { ?>
				<div class="row my-1">
					<div class="col-md-4">
						<p class="alert alert-danger">Wrong password or email</p>
					</div>
				</div>
			<?php } ?>
		</form>
	</div>
</body>

</html>