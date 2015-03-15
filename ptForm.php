<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Patient Record Keeper</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.2/darkly/bootstrap.min.css" rel="stylesheet"/>
    <style>
      div.display {
        margin-top:500px;
        text-align: justify;
      }
      table.tab {
        border: double;
        border-collapse collapse;
        table-layout: fixed;
        margin: 0 auto;
        padding: 15px;
        width: 80%;
        height: 50px;
      }
      th {
        text-align: left;
        border-color: green;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-default">
    <p class="navbar-text">Patient Enrollment/Deletion</p>
    <div class="container-fluid navbar-right">
      <div class="navbar-header">
       <a class="navbar-brand" href="http://web.engr.oregonstate.edu/~brancalr/main.php">Logout</a>
      </div>
    </div>
  </nav>
    <br>
    <br>
    <br>
  	<form action="ptForm.php" method="post" id="patient">
		  <div class="ptInfo">
          <label class="col-sm-3 control-label">Enter Patient Information Here or Simply Enter the Username Who's Patients
          You'd Like to See:</label>
          <div class="col-sm-3">
            <input class="form-control" id="user" name="user" placeholder="Username" type="password">
            <input class="form-control" id="fname" name="fname" placeholder="First name" type="text">
            <input class="form-control" id="lname" name="lname" placeholder="Last name" type="text">
            <input class="form-control" id="dob" name="dob" placeholder="Birthdate" type="date">
            <input class="form-control" id="med_name" name="med_name" placeholder="Medication Name" type="text">
            <input class="form-control" id="strength" name="strength" placeholder="Strength (no units)" type="number" min='0'>
            <input class="form-control" id="ae" name="ae" placeholder="Adverse Effect" type="text">
		      </div>
		  </div>
        <div class="form-group">
          <div class="col-sm-2 col-sm-offset-8">
           <button type="submit" class="btn btn-success btn-block">Submit</button>
          </div>
        </div>
    </form>
    <br>
    <br>
    <form action="deletePT.php" method="post" id="delete"/>
      <div class="delete">
        <label class="col-sm-3 control-label">Delete Patient. Enter First and Last Name:</label>
        <div class="col-sm-3">
            <input class="form-control" id="fname" name="fname" placeholder="Patient's First Name" type="text">
            <input class="form-control" id="lname" name="lname" placeholder="Patient's Last Name" type="text">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 col-sm-offset-8">
         <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
      </div>
    </form> 
    <div class="display">
    <h2>Your Currently Active Patients Are:</h2>
      <div class="innerDisp">
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
          include 'login.php';
          $sql = "SELECT fname, lname, dob, med_name, strength, adverse_effect, username FROM user WHERE username = '".$user."'";
            $result = $mysqli->query($sql);

            if($result->num_rows > 0) {
              echo "<table class='tab' border='3'><tr><th>Last</th><th>First</th><th>DOB</th><th>Medication Name</th><th>Strength(mg)</th><th>Adverse Effect</th></tr>";
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["lname"]."</td><td>".$row["fname"]."</td><td>".$row["dob"]."</td><td>".$row["med_name"]."</td><td>"
                     .$row["strength"]."</td><td>".$row["adverse_effect"]."</td></tr>";
              }
              echo "</table>";
            }
        ?>
        </div> 
    </div> 
  </body>
</html>