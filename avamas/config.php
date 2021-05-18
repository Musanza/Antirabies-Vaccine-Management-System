<?php
require 'connect.php';

if (isset($_POST['add-facility'])) {
	$facility = $_POST['facility'];
	$query = "INSERT INTO `facility`(facility) VALUES($facility')";
	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($insert_row){
		$message = 'Facility added successfully';
	} else {
		$error = 'Error. Facility not added';
	}
}

if (isset($_POST['assign'])) {
	$province = $_POST['province'];
	$district = $_POST['district'];
	$facility = $_POST['facility'];
	$userid = $_POST['userid'];
	$query = "INSERT INTO `assign`(province, district, facility, userid) VALUES('$province', '$district', '$facility', '$userid')";
	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($insert_row){
		$message = 'User id assigned successfully';
	} else {
		$error = 'Error. User id not assigned';
	}
}

if (isset($_POST['add-user'])) {
	$name = $_POST['name'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$type = $_POST['type'];

	$query = "INSERT INTO `users`(name, telephone, email, username, password, type) VALUES('$name', '$telephone', '$email', '$username', '$password', '$type')";
	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($insert_row){
		$message = 'User added successfully';
	} else {
		$error = 'Error. User not added';
	}
}

if (isset($_GET['delete_assigned'])) {
	$delete_id = $_GET['delete_assigned'];
	$query = "DELETE FROM `assign` WHERE id = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($delete_row){
		$message = 'Deleted successfully';
		header("Location: users.php#Assign");
	} else {
		$error = 'Error occured. Try again';
	}
}


if (isset($_GET['delete_user'])) {
	$delete_id = $_GET['delete_user'];
	$query = "DELETE FROM `users` WHERE id = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($delete_row){
		$message = 'Deleted successfully';
		header("Location: users.php#User");
	} else {
		$error = 'Error occured. Try again';
	}
}

if (isset($_POST['submit'])) {
	$facility = $_POST['facility'];
	$district = $_POST['district'];
	$afp = $_POST['afp'];
	$cholera = $_POST['cholera'];
	$diarrhea = $_POST['diarrhea'];
	$tetanus = $_POST['tetanus'];
	$measles = $_POST['measles'];
	$meningitis = $_POST['meningitis'];
	$vhf = $_POST['vhf'];
	$yellow = $_POST['yellow'];
	$other = $_POST['other'];
	$province = $_POST['province'];
	$dist = $_POST['dist'];
	$year = $_POST['year'];
	$case_no = $_POST['case_no'];
	$date = $_POST['date'];
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$months = $_POST['months'];
	$days = $_POST['days'];
	$nnt = $_POST['nnt'];
	$residence = $_POST['residence'];
	$r_town = $_POST['r_town'];
	$r_district = $_POST['r_district'];
	$sex = $_POST['sex'];
	$info = $_POST['info'];
	$seen = $_POST['seen'];
	$notified = $_POST['notified'];
	$onset = $_POST['onset'];
	$no_vaccine = $_POST['no_vaccine'];
	$d_vaccine = $_POST['d_vaccine'];
	$var1 = $_POST['var1'];
	$var2 = $_POST['var2'];
	$i_o_patient = $_POST['i_o_patient'];
	$outcome = $_POST['outcome'];
	$class = $_POST['class'];
	$staff = $_POST['staff'];
	$sent = $_POST['sent'];

	$query = "INSERT INTO `form`(facility, district, afp, cholera, diarrhea, tetanus, measles, meningitis, vhf, yellow, other, province, dist, year, case_no, date, name, dob, months, days, nnt, residence, r_town, r_district, sex, info, seen, notified, onset, no_vaccine, d_vaccine, var1, var2, i_o_patient, outcome, class, staff, sent) VALUES('$facility', '$district', '$afp', '$cholera', '$diarrhea', '$tetanus', '$measles', '$meningitis', '$vhf', '$yellow', '$other', '$province', '$dist', '$year', '$case_no', '$date', '$name', '$dob', '$months', '$days', '$nnt', '$residence', '$r_town', '$r_district', '$sex', '$info', '$seen', '$notified', '$onset', '$no_vaccine', '$d_vaccine', '$var1', '$var2', '$i_o_patient', '$outcome', '$class', '$staff', '$sent')";
	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($insert_row){
		$message = 'Form sent successfully';
	} else {
		$error = 'Error. Form not sent';
	}
}

if (isset($_POST['add-vaccine'])) {
	$qty = $_POST['qty'];
	$date = $_POST['date'];

	$query = "INSERT INTO `warehouse`(qty, date) VALUES('$qty', '$date')";
	$insert_available = "INSERT INTO `available` (received) VALUES('$qty')";
	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$insert_row = $mysqli->query($insert_available) or die($mysqli->error.__LINE__);
	if($insert_row){
		$message = 'Added successfully';
	} else {
		$error = 'Error occured';
	}
}

if (isset($_GET['delete_form'])) {
	$delete_id = $_GET['delete_form'];
	$query = "DELETE FROM `form` WHERE id = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($delete_row) {
		header("Location: forms.php");
		$message = 'Request deleted successfully';
	}
}
if (isset($_GET['delete_record'])) {
	$delete_id = $_GET['delete_record'];
	$query = "DELETE FROM `warehouse` WHERE id = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($delete_row) {
		header("Location: warehouse.php");
		$message = 'Record deleted successfully';
	}
}
?>