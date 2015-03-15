<?php
include "storedPW.php";

$mysqli = new mysqli('oniddb.cws.oregonstate.edu','brancalr-db',$myPassword,'brancalr-db'); 
if ($mysqli->connect_error) {
    die('Cannot connect to SQL Database. (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_POST['fname'] && $_POST['lname']) {
	if(!($stmt = $mysqli->prepare("DELETE FROM user WHERE fname = ? AND lname = ?"))){
		//Prepare INSERT query
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ss",$_POST['fname'], $_POST['lname']))){
			//Referenced: http://php.net/manual/en/mysqli-stmt.bind-param.php	
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
	// Execute query
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	}
}
else{
	echo "Please enter the Patient's first and last name before clicking submit!";
	echo "<br><a href='ptForm.php'>Click here to return to Patient Form page.</a>";
}

$stmt->close(); // Redirect back to main page now that insert query is done
$path = explode('/', $_SERVER['PHP_SELF'], - 1);
$path = implode('/', $path);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $path;
header("Location: {$redirect}/ptForm.php");

?>

