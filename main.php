<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Patient Record Keeper</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.2/darkly/bootstrap.min.css" rel="stylesheet">
	<script src="ajax.js"></script>
	<script src="login.js"></script>
    <style>
    	body {
    		margin-top: 20px;
    		margin: auto;
    	}
    	img.img1 {
    		float: left;
    	}
    	img.img2 {
    		float: right;
    	}
    </style>
  </head>
  <body>
  <nav class="navbar navbar-default">
	<div class="container-fluid">
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
		  <li class="active"><a href="http://www.drugs.com/pill_identification.html">Pill Identifier<span class="sr-only">(current)</span></a></li>
		  <li><a href="http://www.drugs.com/">Drugs.com</a></li>
		</ul>
	  </div>
  </nav>
  <h3>This website is designed for healthcare professionals. It keeps the most vital patient information in a clear and concise
     tabular form which allows for quick referencing during patient appointments. Please create a username and password for 
     access to the patient input form.</h3>
    <center>
	  <table>
	    <tbody>
		  <tr>
		    <td class="inner">Username:
			  <input id="username" class="form-control" type="text">
			  <br>
			  Password:
			  <input id="password" class="form-control" type="password">
			  <br>
			  <input onclick="login('login')" class="btn btn-success btn-block" type="submit" value="Login">
			  <input onclick="login('new')" class="btn btn-success btn-block" type="button" value="Create Account">
			</td>
		  </tr>
		</tbody>
	  </table>
	  <div id="statusUpdate"></div>
	</center>
	<img src="rx.jpg" class="img1" alt="Rx">
	<img src="rx.jpg" class="img2" alt="Rx">
  </body>
 </html>