<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}

if (isset($_GET['update_user'])) {
	$update_id = $_GET['update_user'];
	$edit_state = true;
	$query = "SELECT * FROM `users` WHERE id = '$update_id'";
	$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$row = $select->fetch_assoc();
	$u_name = $row['name'];
	$u_telephone = $row['telephone'];
	$u_email = $row['email'];
	$u_username = $row['username'];
	$u_type = $row['type'];
}

if (isset($_POST['update-user'])) {
	$name = $_POST['name'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$type = $_POST['type'];
	$query = "UPDATE `users` SET name='$name', telephone='$telephone', email='$email', username='$username', password='$password', type='$type' WHERE id='$update_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'User updated successfully';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard | Antirabies Vaccine Management System</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<!-- Datepcker -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
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
				<ul class="nav navbar-nav">
					<li><a href="#">Hi, <?php echo $_SESSION['name']; ?></a></li>
					<li class="active"><a href="#"><?php echo $_SESSION['type']; ?> <span class="sr-only">(current)</span></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if ($_SESSION['type'] == 'Administrator' || $_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
					<li><a href="dashboard.php">Create Form</a></li>
				<?php } ?>
					<li><a href="forms.php">All Forms</a></li>
					<?php if ($_SESSION['type'] == 'Administrator' || $_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
					<li><a href="patients.php">Patients</a></li>
				<?php } ?>
				<?php if ($_SESSION['type'] == 'Administrator' || $_SESSION['type'] == 'Warehouse Manager') {?>
					<li><a href="warehouse.php">Warehouse</a></li>
				<?php } ?>
					<?php if ($_SESSION['type'] == 'Administrator') {?>
						<li class="active"><a href="users.php">Users</a></li>
					<?php } ?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<main>
		<section id="users">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<?php if (isset($message)) { ?>
							<div class="alert alert-success" role="alert">
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<?php if (isset($error)) { ?>
							<div class="alert alert-danger" role="alert">
								<?php echo $error; ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<h3>Add Health Facility</h3>
						<form method="post">
							<div class="form-group">
								<label>Facility name</label>
								<input type="text" name="facility" class="form-control">
							</div>
							<input type="submit" name="add-facility" class="btn btn-primary" value="Add">
						</form>
					</div>
					<div class="col-md-3">
						<h3>Assign User ID</h3>
						<form method="post">
							<div class="form-group">
								<label>Province</label>
								<input type="text" name="province" list="province" class="form-control">
								<datalist id="province">
									<?php
									$query = "SELECT * FROM `province` ORDER BY province ASC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<option><?php echo $row['province']; ?></option>
									<?php } ?>
								</datalist>
							</div>
							<div class="form-group">
								<label>District</label>
								<input type="text" name="district" list="district" class="form-control">
								<datalist id="district">
									<?php
									$query = "SELECT * FROM `district` ORDER BY district ASC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<option><?php echo $row['district']; ?></option>
									<?php } ?>
								</datalist>
							</div>
							<div class="form-group">
								<label>Health Facility</label>
								<input type="text" name="facility" list="facility" class="form-control">
								<datalist id="facility">
									<?php
									$query = "SELECT * FROM `facility` ORDER BY facility ASC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<option><?php echo $row['facility']; ?></option>
									<?php } ?>
								</datalist>
							</div>
							<div class="form-group">
								<label>User ID</label>
								<input type="text" name="userid" list="usersList" class="form-control">
								<datalist id="usersList">
									<?php
									$query = "SELECT * FROM `users` ORDER BY username ASC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<option><?php echo $row['username']; ?></option>
									<?php } ?>
								</datalist>
							</div>
							<input type="submit" name="assign" class="btn btn-primary" value="Assign">
						</form>
					</div>
					<div class="col-md-6" id="Assign">
						<h3>Facilities</h3>
						<div class="table-responsive">
							<table id="table" class="table table-bordered">
								<thead>
									<tr>
										<th>User ID</th>
										<th>Name</th>
										<th>District</th>
										<th>Province</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = "SELECT * FROM `assign` ORDER BY id DESC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<tr>
											<td><?php echo $row['userid']; ?></td>
											<td><?php echo $row['facility']; ?></td>
											<td><?php echo $row['district']; ?></td>
											<td><?php echo $row['province']; ?></td>
											<td>
												<a href="config.php?delete_assigned=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<form method="post">
						<center><h3>Add user</h3></center>
						<div class="col-md-2">
							<div class="form-group">
								<label>Full name</label>
								<input type="text" name="name" class="form-control" required="" value="<?php echo $u_name; ?>">
							</div>
							<div class="form-group">
								<label>Telephone</label>
								<input type="text" name="telephone" class="form-control" required="" value="<?php echo $u_telephone; ?>">
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" name="email" class="form-control" required="" value="<?php echo $u_email; ?>">
							</div>
							<?php if ($edit_state == false) {?>
							<input type="submit" name="add-user" class="btn btn-primary" value="Add">
							<?php } else {?>
								<input type="submit" name="update-user" class="btn btn-success" value="Update">
							<?php } ?>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>User role</label>
								<select class="form-control" name="type">
									<option><?php echo $u_type; ?></option>
									<option>Administrator</option>
									<option>District Health Officer</option>
									<option>Hospital Pharmacy Manager</option>
									<option>Provincial Health Officer</option>
									<option>Warehouse Manager</option>
									<option>Warehouse Officer</option>
								</select>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" maxlength="12" required="" value="<?php echo $u_username; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" required="">
							</div>
						</div>
					</form>
					<div class="col-md-8" id="User">
						<div class="table-responsive">
							<table id="table" class="table table-bordered">
								<thead>
									<tr>
										<th>Username</th>
										<th>Name</th>
										<th>Telephone</th>
										<th>Email Address</th>
										<th>Role</th>
										<th colspan="2">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = "SELECT * FROM `users` ORDER BY id DESC";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									while($row = $select->fetch_assoc()){ ?>
										<tr>
											<td><?php echo $row['username']; ?></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['telephone']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['type']; ?></td>
											<td>
												<a href="config.php?delete_user=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
												<a href="users.php?update_user=<?php echo $row['id']; ?>" class="btn btn-success">Update</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
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
	<!-- Datatables -->
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#table').DataTable({
				responsive: true
			});
		});
	</script>
	<!-- Datepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript">
		$('#datepicker1').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker2').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker3').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker4').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker5').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker6').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
	<script type="text/javascript">
		$('#datepicker7').datepicker({
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
</body>
</html>