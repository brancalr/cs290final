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
      include "storedPW.php";
      include "patient.php";

      //$user = $_POST["userName"];
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
    <a href='ptForm.php'>Click here to return to the Patient Form page.</a>
</body>
</html>