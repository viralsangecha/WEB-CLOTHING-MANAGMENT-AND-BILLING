<?php
	$user=$_POST['username'];
	session_start();
	$conn = new mysqli("localhost","root","","admins");

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}

	
	$_SESSION['user']=$user;
	
	$query = mysqli_query($conn,"SELECT Username FROM admin WHERE Username = '$user'");
	
	mysqli_num_rows($query);

	if (mysqli_num_rows($query)> 0) 
	{
		echo "<script>alert('username is found goto update password');
		window.location.href='que-ans.php';</script>";
		
	} 
	else 
	{
		echo "<script>alert('username not found !');
		window.location.href='login.html';</script>";
	}

	$conn->close();
?>