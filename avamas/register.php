<!DOCTYPE html>
<html>
<head>
	<title>Login | Antirabies Vaccine Management System</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Antirabies Vaccine Management System</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="login.php">Login</a></li>
					<li class="active"><a href="register.php">Register</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<main>
		<section id="login">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3"></div>
					<form method="post">
						<div class="form">
							<div class="col-md-3">
								<div class="form-group">
									<label>Full name</label>
									<input type="text" name="username" class="form-control" required="">
								</div>
								<div class="form-group">
									<label>Telephone</label>
									<input type="text" name="username" class="form-control" required="">
								</div>
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" name="username" class="form-control" required="">
								</div>
								<input type="submit" name="register" class="btn btn-primary" value="Register">
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" maxlength="8" required="">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password1" class="form-control" required="">
								</div>
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="password2" class="form-control" required="">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>
	<div class="divider"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3 class="footer-title">Developer</h3>
					<ul>
						<li>Student name: </li>
						<li>Student No. </li>
						<li>Course: Final Year Project</li>
						<li>Program: </li>
					</ul>
				</div>
				<div class="col-md-4">
					<h3 class="footer-title">Contact Us</h3>
					<ul>
						<li>Email address: </li>
						<li>Telephone No. </li>
						<li>Postal address:</li>
					</ul>
				</div>
				<div class="col-md-4">
					<h3 class="footer-title">Links</h3>
					<ul>
						<li><a href="#">ICU Zambia</a></li>
						<li><a href="#">ZRDC</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copyright text-center">Antirabies Vaccine Management System &copy; 2020</div>
	</footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>