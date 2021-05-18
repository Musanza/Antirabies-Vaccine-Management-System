<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
	header("location: login.php");
}
$userId = $_SESSION['username'];

if (isset($_GET['a_dho'])) {
	$update_id = $_GET['a_dho'];
	$query = "UPDATE `form` SET dho='Approved' WHERE id='$update_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Request approved successfully';
	}
}
if (isset($_GET['a_pho'])) {
	$update_id = $_GET['a_pho'];
	$query = "UPDATE `form` SET pho='Approved' WHERE id='$update_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Request approved successfully';
	}
}
if (isset($_GET['a_mswo'])) {
	$update_id = $_GET['a_mswo'];
	$query = "UPDATE `form` SET mswo='Approved' WHERE id='$update_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Request approved successfully';
	}
}
if (isset($_GET['issue_mswm'])) {
	$update_id = $_GET['issue_mswm'];
	$query = "UPDATE `form` SET i_mswm='Yes' WHERE id='$update_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Request approved successfully';
	}
}

if (isset($_GET['mswo_issue'])) {
	$update_id = $_GET['mswo_issue'];
	$select_query = "SELECT * FROM `form` WHERE id = '$update_id'";
	$fetch = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	$row = $fetch->fetch_assoc();
	$order_id = $row['id'];
	$facility = $row['facility'];
	$district = $row['district'];
	$province = $row['province'];
	$received = 5;
	$insert_query = "INSERT INTO `stores` (order_id, facility, district, province, received) VALUES('$order_id', '$facility', '$district', '$province', '$received')";
	$insert_available = "INSERT INTO `available` (issued) VALUES(5)";
	$update_query = "UPDATE `form` SET i_mswo='Yes' WHERE id='$update_id'";
	$update_row = $mysqli->query($update_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($insert_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($insert_available) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Vaccine issued successfully';
	}
}

if (isset($_GET['pho_issue'])) {
	$update_id = $_GET['pho_issue'];
	$select_query = "SELECT * FROM `form` WHERE id = '$update_id'";
	$fetch = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	$row = $fetch->fetch_assoc();
	$order_id = $row['id'];
	$facility = $row['facility'];
	$district = $row['district'];
	$province = $row['province'];
	$received = 5;
	$insert_query = "INSERT INTO `stores` (order_id, facility, district, province, p_issued) VALUES('$order_id', '$facility', '$district', '$province', '$received')";
	$update_query = "UPDATE `form` SET i_pho='Yes' WHERE id='$update_id'";
	$update_row = $mysqli->query($update_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($insert_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Vaccine issued successfully';
	}
}

if (isset($_GET['dho_issue'])) {
	$update_id = $_GET['dho_issue'];
	$select_query = "SELECT * FROM `form` WHERE id = '$update_id'";
	$fetch = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	$row = $fetch->fetch_assoc();
	$order_id = $row['id'];
	$facility = $row['facility'];
	$district = $row['district'];
	$province = $row['province'];
	$received = 5;
	$insert_query = "INSERT INTO `stores` (order_id, facility, district, province, d_issued) VALUES('$order_id', '$facility', '$district', '$province', '$received')";
	$update_query = "UPDATE `form` SET i_dho='Yes' WHERE id='$update_id'";
	$update_row = $mysqli->query($update_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($insert_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Vaccine issued successfully';
	}
}
if (isset($_GET['hpm_issue'])) {
	$update_id = $_GET['hpm_issue'];
	$select_query = "SELECT * FROM `form` WHERE id = '$update_id'";
	$fetch = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	$row = $fetch->fetch_assoc();
	$order_id = $row['id'];
	$facility = $row['facility'];
	$district = $row['district'];
	$province = $row['province'];
	$received = 5;
	$insert_query = "INSERT INTO `stores` (order_id, facility, district, province, issued) VALUES('$order_id', '$facility', '$district', '$province', '$received')";
	$update_query = "UPDATE `form` SET issued='Yes' WHERE id='$update_id'";
	$update_row = $mysqli->query($update_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($insert_query) or die($mysqli->error.__LINE__);
	$update_row = $mysqli->query($select_query) or die($mysqli->error.__LINE__);
	if ($update_row) {
		$message = 'Vaccine issued successfully';
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
					<li class="active"><a href="forms.php">All Forms</a></li>
					<?php if ($_SESSION['type'] == 'Administrator' || $_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
					<li><a href="patients.php">Patients</a></li>
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
					<div class="col-md-9">
						<h3>Requests</h3>
						<?php if ($_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
							<div class="table-response">
								<table id="table" class="table table-bordered">
									<thead>
										<tr>
											<th>Health facility</th>
											<th>Case No.</th>
											<th>Patient</th>
											<th>Sex</th>
											<th>Province</th>
											<th>District</th>
											<th>Status</th>
											<th>Issued</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT * FROM `form` ORDER BY id DESC";
										$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
										while($row = $select->fetch_assoc()){
											$status = $row['mswo'];
											$p_issue = $row['i_dho'];
											$a_issue = $row['issued']; ?>
											<tr>
												<td><?php echo $row['facility']; ?></td>
												<td><?php echo $row['case_no']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['province']; ?></td>
												<td><?php echo $row['district']; ?></td>
												<td>
													<?php if ($status == 'pending') {?> 
														<a href="#" class="btn btn-primary">Pending</a>
													<?php } else { ?>
														<a href="#" class="btn btn-default">Approved</a>
													<?php } ?>
												</td>
												<td>
													<?php if ($p_issue == 'Yes' AND $a_issue == 'No') {?> 
														<a href="forms.php?hpm_issue=<?php echo $row['id']; ?>" class="btn btn-primary">No</a>
													<?php } elseif ($p_issue == 'No' AND $a_issue == 'No') { ?>
														<a href="#" class="btn btn-warning">Pending</a>
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
						<?php } ?>
						<?php if ($_SESSION['type'] == 'District Health Officer') {?>
							<div class="table-response">
								<table id="table" class="table table-bordered">
									<thead>
										<tr>
											<th>Health facility</th>
											<th>Case No.</th>
											<th>Patient</th>
											<th>Sex</th>
											<th>Province</th>
											<th>District</th>
											<th>Status</th>
											<th>Issued</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT * FROM `form` ORDER BY id DESC";
										$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
										while($row = $select->fetch_assoc()){
											$status = $row['dho'];
											$p_issue = $row['i_pho'];
											$a_issue = $row['i_dho']; ?>
											<tr>
												<td><?php echo $row['facility']; ?></td>
												<td><?php echo $row['case_no']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['province']; ?></td>
												<td><?php echo $row['district']; ?></td>
												<td>
													<?php if ($status == 'pending') {?> 
														<a href="forms.php?a_dho=<?php echo $row['id']; ?>" class="btn btn-primary">Pending</a>
													<?php } else { ?>
														<a href="#" class="btn btn-default">Approved</a>
													<?php } ?>
												</td>
												<td>
													<?php if ($p_issue == 'Yes' AND $a_issue == 'No') {?> 
														<a href="forms.php?dho_issue=<?php echo $row['id']; ?>" class="btn btn-primary">No</a>
													<?php } elseif ($p_issue == 'No' AND $a_issue == 'No') { ?>
														<a href="#" class="btn btn-warning">Pending</a>
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
						<?php } ?>
						<?php if ($_SESSION['type'] == 'Provincial Health Officer') {?>
							<div class="table-response">
								<table id="table" class="table table-bordered">
									<thead>
										<tr>
											<th>Health facility</th>
											<th>Case No.</th>
											<th>Patient</th>
											<th>Sex</th>
											<th>Province</th>
											<th>District</th>
											<th>Status</th>
											<th>Issued</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT * FROM `form` ORDER BY id DESC";
										$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
										while($row = $select->fetch_assoc()){
											$pre = $row['dho'];
											$status = $row['mswo'];
											$p_issue = $row['i_mswo'];
											$a_issue = $row['i_pho'];
											?>
											<tr>
												<td><?php echo $row['facility']; ?></td>
												<td><?php echo $row['case_no']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['province']; ?></td>
												<td><?php echo $row['district']; ?></td>
												<td>
													<?php if ($status == 'pending' AND $pre == 'Approved') {?> 
														<a href="forms.php?a_pho=<?php echo $row['id']; ?>" class="btn btn-primary">Pending</a>
													<?php } else { ?>
														<a href="#" class="btn btn-default">Approved</a>
													<?php } ?>
												</td>
												<td>
													<?php if ($p_issue == 'Yes' AND $a_issue == 'No') {?> 
														<a href="forms.php?pho_issue=<?php echo $row['id']; ?>" class="btn btn-primary">No</a>
													<?php } else { ?>
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
						<?php } ?>
						<?php if ($_SESSION['type'] == 'Warehouse Officer') {?>
							<div class="table-response">
								<table id="table" class="table table-bordered">
									<thead>
										<tr>
											<th>Health facility</th>
											<th>Case No.</th>
											<th>Patient</th>
											<th>Sex</th>
											<th>Province</th>
											<th>District</th>
											<th>Status</th>
											<th>Issued</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT * FROM `form` ORDER BY id DESC";
										$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
										while($row = $select->fetch_assoc()){
											$pre = $row['pho'];
											$status = $row['mswo'];
											$p_issue = $row['i_mswm'];
											$a_issue = $row['i_mswo']; ?>
											<tr>
												<td><?php echo $row['facility']; ?></td>
												<td><?php echo $row['case_no']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['province']; ?></td>
												<td><?php echo $row['district']; ?></td>
												<td>
													<?php if ($status == 'pending' AND $pre == 'Approved') {?> 
														<a href="forms.php?a_mswo=<?php echo $row['id']; ?>" class="btn btn-primary">Pending</a>
													<?php } else { ?>
														<a href="#" class="btn btn-default">Approved</a>
													<?php } ?>
												</td>
												<td>
													<?php if ($p_issue == 'Yes' AND $a_issue == 'No') {?> 
														<a href="forms.php?mswo_issue=<?php echo $row['id']; ?>" class="btn btn-primary">No</a>
													<?php } else { ?>
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
						<?php } ?>
						<?php if ($_SESSION['type'] == 'Warehouse Manager') {
							$query = "SELECT * FROM `form` ORDER BY id DESC";
							$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
							while($row = $select->fetch_assoc()){
								$status = $row['mswo'];
								if ($status == 'Approved') { ?>
									<div class="table-response">
										<table id="table" class="table table-bordered">
											<thead>
												<tr>
													<th>Health facility</th>
													<th>Case No.</th>
													<th>Patient</th>
													<th>Sex</th>
													<th>Province</th>
													<th>District</th>
													<th>Issue</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query = "SELECT * FROM `form` ORDER BY id DESC";
												$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
												while($row = $select->fetch_assoc()){
													$issue = $row['i_mswm'];
													?>
													<tr>
														<td><?php echo $row['facility']; ?></td>
														<td><?php echo $row['case_no']; ?></td>
														<td><?php echo $row['name']; ?></td>
														<td><?php echo $row['sex']; ?></td>
														<td><?php echo $row['province']; ?></td>
														<td><?php echo $row['district']; ?></td>
														<td>
															<?php if ($issue == 'No') {?> 
																<a href="forms.php?issue_mswm=<?php echo $row['id']; ?>" class="btn btn-primary">Pending</a>
															<?php } else { ?>
																<a href="#" class="btn btn-default">Approved</a>
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
								<?php } } } ?>
								<?php if ($_SESSION['type'] == 'Administrator') {?>
									<div class="table-response">
										<table id="table" class="table table-bordered">
											<thead>
												<tr>
													<th>Health facility</th>
													<th>Case No.</th>
													<th>Patient</th>
													<th>Sex</th>
													<th>Province</th>
													<th>District</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query = "SELECT * FROM `form` ORDER BY id DESC";
												$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
												while($row = $select->fetch_assoc()){
													$status = $row['mswo']; ?>
													<tr>
														<td><?php echo $row['facility']; ?></td>
														<td><?php echo $row['case_no']; ?></td>
														<td><?php echo $row['name']; ?></td>
														<td><?php echo $row['sex']; ?></td>
														<td><?php echo $row['province']; ?></td>
														<td><?php echo $row['district']; ?></td>
														<td>
															<?php if ($status == 'pending') {?> 
																<a href="#" class="btn btn-primary">Pending</a>
															<?php } else { ?>
																<a href="#" class="btn btn-default">Approved</a>
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
								<?php } ?>
							</div>
							<?php if ($_SESSION['type'] == 'Warehouse Manager' || $_SESSION['type'] == 'Warehouse Officer' || $_SESSION['type'] == 'Administrator') {?>
								<div class="col-md-3">
									<h3>Vaccines</h3>
									<?php
									$query = "SELECT * FROM `available`";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									$rec = 0;
									$iss = 0;
									while($row = $select->fetch_assoc()){
										$rec += $row['received'];
										$iss += $row['issued'];
									}?>
									<p>Available: <b><?php echo $total = $rec-$iss; ?></b></p>
								</div>
							<?php } ?>
							<?php if ($_SESSION['type'] == 'Provincial Health Officer') {?>
								<div class="col-md-3">
									<h3>Vaccines</h3>
									<?php
									$query = "SELECT * FROM `stores`";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									$rec = 0;
									$iss = 0;
									while($row = $select->fetch_assoc()){
										$rec += $row['received'];
										$iss += $row['p_issued'];
									}?>
									<p>Available: <b><?php echo $total = $rec-$iss; ?></b></p>
								</div>
							<?php } ?>
							<?php if ($_SESSION['type'] == 'District Health Officer') {?>
								<div class="col-md-3">
									<h3>Vaccines</h3>
									<?php
									$query = "SELECT * FROM `stores`";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									$rec = 0;
									$iss = 0;
									while($row = $select->fetch_assoc()){
										$rec += $row['p_issued'];
										$iss += $row['d_issued'];
									}?>
									<p>Available: <b><?php echo $total = $rec-$iss; ?></b></p>
								</div>
							<?php } ?>
							<?php if ($_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
								<div class="col-md-3">
									<h3>Vaccines</h3>
									<?php
									$query = "SELECT * FROM `stores`";
									$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
									$rec = 0;
									$iss = 0;
									while($row = $select->fetch_assoc()){
										$rec += $row['d_issued'];
										$iss += $row['issued'];
									}?>
									<p>Available: <b><?php echo $total = $rec-$iss; ?></b></p>
								</div>
							<?php } ?>
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