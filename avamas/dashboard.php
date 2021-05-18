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
					<li class="active"><a href="dashboard.php">Create Form</a></li>
				<?php } ?>
					<li><a href="forms.php">All Forms</a></li>
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
					<div class="col-md-12">
						<?php if ($_SESSION['type'] == 'Hospital Pharmacy Manager') {?>
							<?php
							$query = "SELECT * FROM `assign` WHERE userid = '$userId'";
							$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
							$row = $select->fetch_assoc();
							$f_name = $row['facility'];
							$d_name = $row['district'];
							$p_name = $row['province'];
							?>
							<div class="form">
								<form method="post">
									<div class="border">
										<div class="header">
											<img src="images/coat.png">
											<h3 class="text-uppercase">Ministry of Health</h3>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="facility" class="form-control" readonly="" value="<?php echo $f_name; ?>"><br>
													<label>Reporting Health Facility</label>
												</div>
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3"></div>
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="district" class="form-control" readonly="" value="<?php echo $d_name; ?>"><br>
													<label>Reporting District</label>
												</div>
											</div>
										</div>
										<center><h3>Generic Reporting Form - form Health Facility/Health Worker to Districity health Team</h3></center><br><br/>
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="afp" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>AFP</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="cholera" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Cholera</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="diarrhea" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Diarrhea with Blood/Sgigella</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="tetanus" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Neonatal Tetanus</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="measles" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Measles</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="meningitis" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Meningitis</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="vhf" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>V.H.F</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="yellow" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Yello Fever</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="other" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Other</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<p class="text-bold text-red">Official use Only</p>
											</div>
											<div class="col-md-2">
												<p>Epid Number:</p>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="province" class="form-control" readonly="" value="<?php echo $p_name; ?>"><br>
													<label>Province</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="dist" class="form-control" readonly="" value="<?php echo $d_name; ?>"><br>
													<label>District</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="year" class="form-control" readonly="" value="<?php echo date('Y'); ?>"><br>
													<label>Year Onset</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="number" name="case_no" class="form-control"><br>
													<label>Case No.</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="date" id="datepicker1" class="form-control" placeholder="MM/DD/YYYY"><br>
													<label>Received at National</label>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" name="name" class="form-control"><br>
															<label>Name(s) of patient</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<input type="text" name="dob" id="datepicker2" class="form-control" placeholder="MM/DD/YYYY"><br>
															<label>Date of Birth</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-3">
														<p>(If DOB Years known)</p>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="number" name="months" class="form-control"><br>
															<label>Months</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="number" name="days" class="form-control"><br>
															<label>Days (if<12 months)</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="number" name="nnt" class="form-control"><br>
																<label>(NNT Only)</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="residence" class="form-control"><br>
														<label>Patient's Residence: Village/Neighborhood</label>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" name="r_town" class="form-control"><br>
																<label>Town/City</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" name="r_district" class="form-control"><br>
																<label>District of Residence</label>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-2">
													<p>Sex</p>
													<div class="radio">
														<label>
															<input type="radio" name="sex" id="optionsRadios1" value="Female" checked> Female
														</label>
													</div>
													<div class="radio">
														<label>
															<input type="radio" name="sex" id="optionsRadios1" value="Male" checked> Male
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="col-md-4">
														<p>Locating information:</p>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" name="info" class="form-control"><br>
															<label>If applicable, Name of Mother and Father (In case of Neonate of child)</label>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="seen" id="datepicker3" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date seen at Health Facility</label>
													</div>
													<div class="form-group">
														<input type="text" name="notified" id="datepicker4" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date Health Facility Notified District</label>
													</div>
													<div class="form-group">
														<input type="text" name="onset" id="datepicker5" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date of Onset</label>
													</div>
												</div>
												<div class="col-md-7">
													<div class="col-md-7">
														<p>For cases of Measles, AFP NT(TT in mother), Yellow Fever, and Meningitis</p>
													</div>
													<div class="col-md-3">
														<input type="text" name="no_vaccine" class="form-control"><br>
														<label>No. of Vaccine doses received</label>
													</div>
													<div class="col-md-2">
														<p>9 = Known</p>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="d_vaccine" id="datepicker7" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date of last vaccination</label>
													</div>
													<p>[AFP, Measles, National Tetanus (TT in mother), Yellow Fever and Meningitis only]</p>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="var1" class="form-control"><br>
														<label>Blank Variable No. 1</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-4">
															<p>In/Out patient</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="i_o_patient" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = In-patient</p>
															<p>2 = Out-patient</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-2">
															<p>Outcome</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="outcome" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = Alive</p>
															<p>2 = 2</p>
															<p>3 = Known</p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="var2" class="form-control"><br>
														<label>Blank Variable No. 2</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-3">
															<p>Final Classification</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="class" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = Confirmed</p>
															<p>2 = Probable/Compatible</p>
															<p>3 = Discarded</p>
															<p>4 = Suspended</p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="staff" class="form-control" readonly="" value="<?php echo $_SESSION['name']; ?>"><br>
														<label>Person completing form (name)</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="sent" id="datepicker6" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date sent form to District</label>
													</div>
												</div>
											</div>
										</div>
										<input type="submit" name="submit" class="btn btn-primary" value="Submit">
									</form>
								</div>
							</div>
						<?php } ?>
						<?php if ($_SESSION['type'] == 'Administrator') {?>
							<div class="form">
								<form method="post">
									<div class="border">
										<div class="header">
											<img src="images/coat.png">
											<h3 class="text-uppercase">Ministry of Health</h3>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="facility" class="form-control"><br>
													<label>Reporting Health Facility</label>
												</div>
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3"></div>
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" name="district" class="form-control"><br>
													<label>Reporting District</label>
												</div>
											</div>
										</div>
										<center><h3>Generic Reporting Form - form Health Facility/Health Worker to Districity health Team</h3></center><br><br/>
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="afp" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>AFP</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="cholera" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Cholera</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="diarrhea" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Diarrhea with Blood/Sgigella</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="tetanus" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Neonatal Tetanus</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="measles" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Measles</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="meningitis" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Meningitis</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<select name="vhf" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>V.H.F</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="yellow" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Yello Fever</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="other" class="form-control">
																<option>No</option>
																<option>Yes</option>
															</select><br>
															<label>Other</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<p class="text-bold text-red">Official use Only</p>
											</div>
											<div class="col-md-2">
												<p>Epid Number:</p>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="province" class="form-control"><br>
													<label>Province</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="dist" class="form-control"><br>
													<label>District</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="year" class="form-control" readonly="" value="<?php echo date('Y'); ?>"><br>
													<label>Year Onset</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="number" name="case_no" class="form-control"><br>
													<label>Case No.</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" name="date" id="datepicker1" class="form-control" placeholder="MM/DD/YYYY"><br>
													<label>Received at National</label>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-4">
												<div class="row">
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" name="name" class="form-control"><br>
															<label>Name(s) of patient</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<input type="text" name="dob" id="datepicker2" class="form-control" placeholder="MM/DD/YYYY"><br>
															<label>Date of Birth</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-3">
														<p>(If DOB Years known)</p>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="number" name="months" class="form-control"><br>
															<label>Months</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="number" name="days" class="form-control"><br>
															<label>Days (if<12 months)</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="number" name="nnt" class="form-control"><br>
																<label>(NNT Only)</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="residence" class="form-control"><br>
														<label>Patient's Residence: Village/Neighborhood</label>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" name="r_town" class="form-control"><br>
																<label>Town/City</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" name="r_district" class="form-control"><br>
																<label>District of Residence</label>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-2">
													<p>Sex</p>
													<div class="radio">
														<label>
															<input type="radio" name="sex" id="optionsRadios1" value="Female" checked> Female
														</label>
													</div>
													<div class="radio">
														<label>
															<input type="radio" name="sex" id="optionsRadios1" value="Female" checked> Male
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="col-md-4">
														<p>Locating information:</p>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" name="info" class="form-control"><br>
															<label>If applicable, Name of Mother and Father (In case of Neonate of child)</label>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="seen" id="datepicker3" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date seen at Health Facility</label>
													</div>
													<div class="form-group">
														<input type="text" name="notified" id="datepicker4" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date Health Facility Notified District</label>
													</div>
													<div class="form-group">
														<input type="text" name="onset" id="datepicker5" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date of Onset</label>
													</div>
												</div>
												<div class="col-md-7">
													<div class="col-md-7">
														<p>For cases of Measles, AFP NT(TT in mother), Yellow Fever, and Meningitis</p>
													</div>
													<div class="col-md-3">
														<input type="text" name="no_vaccine" class="form-control"><br>
														<label>No. of Vaccine doses received</label>
													</div>
													<div class="col-md-2">
														<p>9 = Known</p>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="d_vaccine" id="datepicker7" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date of last vaccination</label>
													</div>
													<p>[AFP, Measles, National Tetanus (TT in mother), Yellow Fever and Meningitis only]</p>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="var1" class="form-control"><br>
														<label>Blank Variable No. 1</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-4">
															<p>In/Out patient</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="i_o_patient" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = In-patient</p>
															<p>2 = Out-patient</p>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-2">
															<p>Outcome</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="outcome" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = Alive</p>
															<p>2 = 2</p>
															<p>3 = Known</p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="var2" class="form-control"><br>
														<label>Blank Variable No. 2</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-3">
															<p>Final Classification</p>
														</div>
														<div class="col-md-3">
															<input type="number" name="class" class="form-control">
														</div>
														<div class="col-md-4">
															<p>1 = Confirmed</p>
															<p>2 = Probable/Compatible</p>
															<p>3 = Discarded</p>
															<p>4 = Suspended</p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="staff" class="form-control" readonly="" value="<?php echo $_SESSION['name']; ?>"><br>
														<label>Person completing form (name)</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<input type="text" name="sent" id="datepicker6" class="form-control" placeholder="MM/DD/YYYY"><br>
														<label>Date sent form to District</label>
													</div>
												</div>
											</div>
										</div>
										<input type="submit" name="submit" class="btn btn-primary" value="Submit">
									</form>
								</div>
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