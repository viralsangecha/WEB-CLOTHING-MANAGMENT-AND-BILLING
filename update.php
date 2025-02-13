<?php
session_start();
	
	if (!isset($_SESSION['admin'])) 
	{
		
		echo "<script>alert('your are not logged in ,please log in');</script>";
		header("Location: login.html");
		exit();
		
	}
	$id = $_GET["id"];
	$con = mysqli_connect("localhost","root","","admins");
	$query = mysqli_query($con,"select * from inventory where ID=$id");
	while($temp=mysqli_fetch_array($query))
	{
		echo"<html>
		<head>
			<title>Update</title>
			<style>
			body 
			{
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
				background: url('tb.png') no-repeat center center fixed;
				background-size: cover;
				color: white;
			}

			h1 
			{
				border-bottom: 2px solid white;
				width:700px;
				padding-bottom: 10px;
			}

			form label 
			{
				display: block;
				margin: 20px 0 5px;
			}

			input 
			{
				width:25%;
				padding: 10px;
				margin-bottom: 10px;
				border: none;
				border-radius: 5px;
				box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
			}

			.Update
			{
				width:200px;
				padding: 10px 20px;
				background-color: #007bff;
				color: white;
				border: none;
				border-radius: 50px;
				cursor: pointer;
				transition:0.5s;
				
			}
			
			.Update:hover 
			{
				box-shadow: 0 0 10px rgb(0,0,0);
				background:rgb(46, 18, 174);
				
				transition:0.5s;
			}
		</style>
		</head>
		<body>
			<form action=update2.php method=GET>
			<center>
				<h1>Update Data </h1>";
					echo"<label >Enter ID : </label><input class=id type=text name=ID value=$temp[ID] ><br>";
					
					echo"<label>Enter item Name :</label> <input type=text name=name value= $temp[item_name]><br>";
					echo"<label>Enter quantity: </label><input type=text name=quantity value=  $temp[quantity]><br>";
					echo"<label>Enter price : </label><input type=text name=price value= $temp[price]><br>";
				echo"<button  class=Update type=Submit>Update</button>
			<center>
		</body>
		</html>";
	}
?>
