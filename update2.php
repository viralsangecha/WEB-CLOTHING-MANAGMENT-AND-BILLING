<?php
session_start();
	
	if (!isset($_SESSION['admin'])) 
	{
		
		echo "<script>alert('your are not logged in ,please log in');</script>";
		header("Location: login.html");
		exit();
		
	}
	$id = $_GET["ID"];
	$name = $_GET["name"];
	$quantity = $_GET["quantity"];
	$price = $_GET["price"];
	
	$con = mysqli_connect("localhost","root","","admins");
	$query = mysqli_query($con,"update inventory set item_name='$name', quantity=$quantity, price=$price where ID=$id");
	
	header('location:inventory.php');
?>