<?php
	require 'configure.php';
?>

<html>
	<head>
		<!-- add a title (a)-->
		<title>Shedule New Appointment</title>
		
		<!--add styleSheet-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="styles/Docmain.css">
		<!--<script src="js1/script1.js"> </script>-->
		<meta charset = "UTF-8">
		<meta name ="viewport" content = "width = device-width , intial-scale = 1.0">
	
	   <style>
body {
 background-image: url("images/img.jpg");
 background-repeat:no-repeat;

}

img{
	max-width :100%;
}

	.container{
	width : 700px;
	background-color:rgb(0,0,0,0.8);
	margin: auto;
	color: black;
	padding: 0.5px 0px 0.5px 0px;
	text-align: center;
	border-radius: 10px 10px 0px 0px;
}
			
.container{
	background-color:#e5e9e6;
	width : 900px;
	height :400px;
	padding:50px 50px 50px 50px;
	margin: auto ;
	border-radius: 20px 20px 20px 20px;
}
			
form{
	padding: 10px
	width: 150%;
}
.fromadd{
	color: black;
	font-size: 15px;
}
.formnijustify{
	display: flex;
	justify-content: space-between;
}


  		#appointment {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 95%;
}

#appointment  td, #appointment th {
  border: 1px solid #ddd;
  padding: 30px;
}

#appointment tr:nth-child(even){background-color: #f2f2f2;}

#appointment  tr:hover {background-color: #ddd;}

#appointment  th {
  padding-top: 20px;
  padding-bottom: 20px;
  text-align: left;
  background-color:#1e4e83 ;
  color: white;
}

.button {
  display: inline-block;
  padding: 10px 12px;
  font-size: 14px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color:#1e4e83;
  border: none;
  border-radius: 8px;
  
}

.button:hover {background-color: blue}


.button:active {
  background-color: #1e4e83;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

input[type=text] {
  width: 400px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 40%;
}
	 
	 </style>
	 </head>
	 <body>
	<div class="topnav">
		<div class="logo">
		<p> <strong> e Service </strong> </p>
		</div>
		
	    <img class = "image" src="images/logo.jpg" width="121px" height="100px">
		
		<div class = "navbar">
			<a href="#">Home</a>
			<a href="#" >About Us</a>
			<a href="#" >Contact us</a>
			<a href="#">Terms & Conditions</a>
			<a href="#" class="login">Login</a>
		</div>
		<br>
	</div>
	
	<br><br>
	<center><h1>SHEDULE NEW APPOINTMENTS</h1></center>
<center>
		<div class="container">
			
		<form method="POST" action="">

		<div class="contain1">
		Doctor Email </br> <input type="text" name="Email" >
</br> </br> </br>
		<input type="submit" class= "button" value="SEARCH " name="btnsubmit" class="button">
		</div>
		</form>
			
		
	
	<br><br>
	
	<?php

if(isset($_POST["btnsubmit"]))
{
$Email = $_POST['Email'];

$sql = "SELECT d.DoctorID  , d.First_Name ,d.Last_Name, d.Specialization ,d.Email
		FROM doctor d 
		WHERE  d.Email LIKE  '$Email' ";

 $result = $con -> query($sql);

if($result -> num_rows > 0)
{
	echo "<table id='appointment' border='1'>";
	echo "<th> DoctorID </td> <th> First_Name </th> <th> Last_Name </th>  <th> Specialization</th>  <th> Email</th>   ";
	
	//read data
	while($row = $result -> fetch_assoc())
	{
		echo "<tr>";
        echo "<td>" . $row["DoctorID"] . "</td>";
		echo "<td>" . $row["First_Name"] . "</td>";
        echo "<td>" . $row["Last_Name"] . "</td>";
		echo "<td>" . $row["Specialization"] . "</td>"; 
		echo "<td>" . $row["Email"] . "</td>";
		
		
		echo "</tr>";	
	}
	
	echo "</table>";
}

else
{
	
	echo "<script> alert('No Records!!') </script>";
	
}

}

?>
	<br><br>
	
	<div class="contain1">
		<a href="create.php">
		<input type="submit" class= "button" value="CREATE NEW APPOINTMENT" name="btnsubmit" class="button">
		</a>
		
		</div>
		</center>
<br><br><br>
	
	<!---footer--!>
	<!----------------------footer-------------------------------------------->
		<footer>
			 <img class = "image1" src="images/qr2.PNG" width="121px" height="100px">
			
		    <p>+94 712 571 22</p>
			<p>eservice@gmail.com</p>
			<p>eService PLC,nO:108,W A D Ramanayaka Mawatha,Kandy,Sri Lanka</p>
		
			<br><hr class = "hr1">
			<p class="para4"> @2022 All Rights Reserved </p><br>
			
			<div class="socialmedia">
				<ul>
					<li><a href="#" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-instagram"></a></li>
				</ul>
			</div>
			
			<br>
		</footer>
   </body>	
</head>
</html>