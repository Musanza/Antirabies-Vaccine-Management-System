<?php include 'config.php'; ?>
<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "avamas_db";
$con = new PDO ("mysql:host=$host; dbname=$db", $user, $pass);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
	if (isset($_POST["login"])) {
		if (empty($_POST["username"]) || empty($_POST["password"])) {
		}else{
			$query = "SELECT * FROM users WHERE username = :username AND password = :password";
			$stmt = $con->prepare($query);
			$stmt->execute (
				array(
					'username' => $_POST["username"],
					'password' => md5($_POST["password"])
				)
			);

			$row = $stmt->fetch();
			$name = $row['name'];
			$user  = $row['username'];
			$pass  = $row['password'];
			$id  = $row['id'];
			$type  = $row['type'];

			$count = $stmt->rowCount();
			if ($count > 0) {
				$_SESSION["name"] = $name;
				$_SESSION["username"] = $user;
				$_SESSION["password"] = $pass;
				$_SESSION["id"] = $id;
				$_SESSION["type"] = $type;
				if ($_SESSION['type'] == 'Warehouse Officer' || 'Provincial Health Officer' || 'District Health Officer') {
					header("location: forms.php");
				} else {
				header("location: dashboard.php");
				}

  }else{
  	$message = '<label>Wrong Data</label>';
  }
}
}
}catch(PDOException $error){
	$message = $error->getMessage();
}
?>
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
<nav class="navbar navbar-default navbar-fixed-top">
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
        <li class="active"><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<main>
	<section>
		<div class="jumbotron text-center">
  <div class="container-fluid">
  	<div class="row">
  		<h2>Welcome to Antirabies Vaccine Management System</h2>
  		<br>
  <p>The system provides an effective way of ensuring availability of anti-rabies vaccines in health facilities so as to encourage health workers to effectively delivery health care services to dog bite victims and prevent deaths from rabies. The developed system can be used by all existing health care facilities in Zambia for the management of anti-rabies vaccines.</p>
  	</div>
  </div>
</div>
	</section>
	<section id="login">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-3">
					<div class="form">
						<form method="post">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<input type="submit" name="login" class="btn btn-primary" value="Login">
						</form>
					</div>
				</div>
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
						<li>Student name: Joseph Siwiti</li>
						<li>Student No. 1702978649</li>
						<li>Course: Final Year Project</li>
						<li>Program: BA of ICT in Software Engineering</li>
					</ul>
				</div>
				<div class="col-md-4">
					<h3 class="footer-title">Contact Us</h3>
					<ul>
						<li>Telephone No. +260977700107</li>
						<li>Postal address: 10101</li>
					</ul>
				</div>
				<div class="col-md-4">
					<h3 class="footer-title">Links</h3>
					<ul>
						<li><a href="https://www.icuzambia.net/" target="blank">ICU Zambia</a></li>
						<li><a href="https://zrdc.org/" target="blank">ZRDC</a></li>
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