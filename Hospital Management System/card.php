<?php

session_start();

	require 'config.php';

	$pid = $_SESSION["user_id"];
	$name = $_POST['name'];
	$cardno = $_POST['number'];
	$cvv = $_POST['cvv'];
	$date = $_POST['date'];

	$sql = "INSERT INTO card(Card_Name, CardNo, CVV, Expire_Date, PatientID) VALUES ('$name','$cardno','$cvv','$date', '$pid')";
	

	if ($con -> query($sql)) {
		echo"Inserted Succesfully";
		$sql1 = "INSERT INTO payment(CardNo,Status) VALUES ('$cardno','Not Paid')";
		$con -> query($sql1);
	}
	else {
		echo"Error Inserting", $con -> error;
	}
	
	$con ->close();
?>