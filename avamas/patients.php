<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
$userId = $_SESSION['username'];
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
					<li class="active"><a href="patients.php">Patients</a></li>
				<?php } ?>
				<?php if ($_SESSION['type'] == 'Administrator' || $_SESSION['type'] == 'Warehouse Manager') {?>
					<li><a href="warehouse.php">Warehouse</a></li>
				<?php } ?>
					<?php if ($_SESSION['type'] == 'Administrator') {?>
						<li><a href="users.php">Users</a></li>
					<?php } ?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<main>
		<section id="form">
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
					<div class="col-md-12">
						<h3>Patients</h3>
						<div class="table-response">
								<table id="table" class="table table-bordered">
									<thead>
										<tr>
											<th>Case No.</th>
											<th>Patient</th>
											<th>Sex</th>
											<th>D.O.B</th>
											<th>Province</th>
											<th>District</th>
											<th>Residence</th>
											<th>Issued</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT * FROM `form` ORDER BY id DESC";
										$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
										while($row = $select->fetch_assoc()){
											$a_issue = $row['issued']; ?>
											<tr>
												<td><?php echo $row['case_no']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['dob']; ?></td>
												<td><?php echo $row['province']; ?></td>
												<td><?php echo $row['district']; ?></td>
												<td><?php echo $row['residence']; ?></td>
												<td>
													<?php if ($a_issue == 'No') {?> 
														<a href="forms.php?hpm_issue=<?php echo $row['id']; ?>" class="btn btn-primary">No</a>
													<?php } else {?> 
														<a href="#" class="btn btn-default">Yes</a>
													<?php } ?>
												</td>
												<td>
													<a href="config.php?delete_form=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
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