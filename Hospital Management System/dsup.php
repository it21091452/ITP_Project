<!DOCTYPE html>
<?php
	include_once 'config.php';

	$sql = "DELETE FROM supplier WHERE SupplierID='" . $_GET['did'] . "'";
	if (mysqli_query($con, $sql)) {
		echo '<script>alert("Record deleted successfully")</script>';
		header('location:supplierD.php');
	} else {
		echo "Error deleting record: " . mysqli_error($con);
		}
	mysqli_close($con);
?>



