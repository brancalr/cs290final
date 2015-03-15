<?php
include "storedPW.php";
include "data.php";

if (isset($_POST['username'])) {
	
    $username = $_POST['username'];
	$password = $_POST['password'];
	
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
	$request = "SELECT count(*) FROM user WHERE username = ?";
	$stmt = $mysqli->prepare($request);
	$stmt->bind_param('s', $username);
	$results = dbAccess($stmt, 1);
	
	if ($results > 0) {
		echo 0;
	}
	else {
		$fname = "";
		$lname = "";
		$dob = "";
		$med_name = "";
		$strength = "";
		$adverse_effect = "";
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "INSERT INTO user(username, password, fname, lname, dob, med_name, strength, adverse_effect) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('ssssdsds', $username, $password, $fname, $lname, $dob, $med_name, $strength, $adverse_effect);
		dbAccess($stmt, 0);
		echo 1;
	}
}
?>