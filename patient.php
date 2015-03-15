<!DOCTYPE html> 
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>Patient Record Keeper</title>
  </head>
  <body>
    <h2>Your Currently Active Patients Are:</h2>
      <div>
		<?php
		include 'storedPW.php';

		$mysqli = new mysqli('oniddb.cws.oregonstate.edu','brancalr-db',$myPassword,'brancalr-db'); 
		if ($mysqli->connect_error) {
		    die('Cannot connect to SQL Database. (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}

		$dob= $_POST['dob'];
		$fname= $_POST['fname'];
		$lname= $_POST['lname'];
		$med= $_POST['med_name'];
		$strength= $_POST['strength'];
		$ae= $_POST['ae'];
		$user=$_POST['user'];

		if(!empty($dob) && !empty($fname) && !empty($lname) && !empty($user)){
			
			if(!($stmt = $mysqli->prepare("INSERT INTO user(dob, fname, lname, med_name, strength, adverse_effect, username) VALUES (?,?,?,?,?,?,?)"))){
				
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!($stmt->bind_param("dsssdss",$_POST['dob'],$_POST['fname'],$_POST['lname'],$_POST['med_name'],$_POST['strength'],$_POST['ae'],$_POST['user']))){
					//Referenced: http://php.net/manual/en/mysqli-stmt.bind-param.php	
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}
			if(!$stmt->execute()){
			
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			}

			$stmt->close(); 
			//$path = explode('/', $_SERVER['PHP_SELF'], - 1);
			//$path = implode('/', $path);
			//$redirect = "http://" . $_SERVER['HTTP_HOST'] . $path;
			//header("Location: {$redirect}/ptForm.php");

			if(empty($dob)) { 
				echo 'Birthdate is a required field. ';
			}
			if(empty($fname)) {
				echo 'First name is a required field. ';
			}
			if(empty($lname)) {
				echo 'Last name is a required field. ';
			}
			if(empty($user)) {
				echo 'Username is a required field. ';
			}
		}
		  $sql = "SELECT fname, lname, dob, med_name, strength, adverse_effect, username FROM user WHERE username = '".$user."'";
	      $result = $mysqli->query($sql);

	      if($result->num_rows > 0) {
	      	echo "<table border='1'><tr><th>Last</th><th>First</th><th>DOB</th><th>Medication Name</th><th>Strength(mg)</th><th>Adverse Effect</th></tr>";
	      	while($row = $result->fetch_assoc()) {
	      		echo "<tr><td>".$row["lname"]."</td><td>".$row["fname"]."</td><td>".$row["dob"]."</td><td>".$row["med_name"]."</td><td>"
	               .$row["strength"]."</td><td>".$row["adverse_effect"]."</td></tr>";
	      	}
	      	echo "</table>";
	      }
	    ?>
      </div>
  <a href="ptForm.php">Click here to return to Patient Form page.</a>
  </body>
</html>