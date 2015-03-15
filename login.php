<?php  
include 'storedPW.php';
include 'data.php';

if (isset($_POST['username'])) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
	$request = "SELECT count(*) FROM user WHERE (username=? AND password=?)";
	$stmt = $mysqli->prepare($request);
	$stmt->bind_param('ss', $username, $password);
	$results = dbAccess($stmt, 1);

	if ($results > 0) {

		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT fname FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);

		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT lname FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);
		
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT dob FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);
		
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT med_name FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);
		
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT strength FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);
		
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "brancalr-db", $myPassword, "brancalr-db");
		$request = "SELECT adverse_effect FROM user WHERE username = ? ";
		$stmt = $mysqli->prepare($request);
		$stmt->bind_param('s', $username);
		$results = dbAccess($stmt, 1);
		echo 1;
	}
	else {
		echo 0;
	}
}
?>

