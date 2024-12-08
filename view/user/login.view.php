<body>
	<div class="container-sm mx-auto py-3">
		<h2 class="my-2 fw-bold text-md-start text-center">Login Page</h2>
		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<!-- email -->
					<label for="email" class="form-text"><b>Email</b> </label>
					<input type="email" name="email" class="form-control" autofocus>
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
					<a href="/register" class="btn btn-outline-primary">Register</a>
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