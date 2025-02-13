<?php
	session_start();

	if (!isset($_SESSION['admin']))
	{
		header("Location: login.html");
		exit();
	}

	
	$conn = new mysqli("localhost","root","","admins");

	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$name = $_POST['name'];
		$number = $_POST['number'];

		$sql = "INSERT INTO customer (name, number) VALUES ('$name', $number)";
		$conn->query($sql);
	}

	$sql = "SELECT * FROM customer";
	$result = $conn->query($sql);
	
	

?>

<html>
<head>
	<title>Customers Management</title>
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

		
		.sidebar 
		{
			width: 230px;
			height: 660px;
			background-color: rgba(0, 0, 0, 0.7);
			padding: 20px;
			position: fixed;
			box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
		}

		.sidebar h2 
		{
			color: white;
			text-align: center;
			margin-bottom: 20px;
		}

		.sidebar h2 a
		{
			color: white;
			text-decoration: none;
		}

		.sidebar ul 
		{
			list-style: none;
			padding: 0;
		}

		.sidebar ul li 
		{
			margin: 10px 0;
		}

		.sidebar ul li a 
		{
			display: block;
			padding: 10px;
			color: white;
			text-decoration: none;
			transition: background 0.3s;
			transition: 0.5s;
		}

		.sidebar ul li a:hover 
		{
			background-color: rgba(255, 255, 255, 0.2);
			transform: translateX(20px);
			transition: 0.7s;
		}

		
		.main-content 
		{
			margin-left: 270px;
			padding: 20px;
			background-color: rgba(255, 255, 255, 0.1);
			overflow-y: auto;
		}

		.main-content h1 
		{
			border-bottom: 2px solid white;
			padding-bottom: 10px;
		}

		form 
		{
			margin-bottom: 20px;
		}

		label 
		{
			display: block;
			margin: 10px 0 5px;
		}

		input 
		{
			width: calc(100% - 20px);
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}

		button 
		{
			padding: 10px 20px;
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 50px;
			cursor: pointer;
			transition: background 0.3s;
		}

		button:hover 
		{
			background-color: #0056b3;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}
		

		
		table 
		{
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			
		}

		

		th 
		{
			background-color: rgba(0, 0, 0, 0.7);
			padding: 10px;
			border: 1px solid white;
		}

		td 
		{
			background-color: rgba( 0, 0, 0, 0.3);
			padding: 10px;
			border: 1px solid white;
		}

		

		
		h3
		{
			width:200px;
		}
	</style>
</head>
<body>
    <div class="sidebar">
	<?php echo"Hello👋,$_SESSION[admin]";?>
        <h2><a href="dashboard.php">WEB Clothing:Management and Billing</a></h2>
        <ul>
            <li><a href="inventory.php">Inventory</a></li>
			<li><a href="stock.php">stock Purchesed</a></li>
			<li><a href="billing.php">Billing</a></li>
		    <li><a href="sales.php">sales</a></li>
			
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Customers Management</h1>
		<h3>Add New Customers<hr></h3>
        <form action="Customers.php" method="POST">
			
			<label for="name">Customers Name:</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z ]+" required>
            
			<label for="Number">Mobile Number:</label>
            <input type="text" id="number" name="number" pattern="[0-9]{10}" maxlength="10" required>
			
			<button type="submit">Add To List</button>
        </form>
        <h2>Customers List</h2>
		<h3>Update/Delete Data<hr></h3>
		<?php 
			echo"<table>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Number</th>
						<th>Total buying</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>";
					 while($row = $result->fetch_assoc()): 
					 echo"<tr>";
						echo"<td> $row[ID] </td>";
						echo"<td> $row[name] </td>";
						echo"<td> $row[number] </td>";
						echo "<td>";
						$sql1 = "SELECT total_price FROM sales WHERE customer_name = '$row[name]'";
						$result1 = $conn->query($sql1);
						
						if ($result1->num_rows > 0)
						{
							$t=0;
							while($row1 = $result1->fetch_assoc()) 
							{
								
								$t+=$row1['total_price'];
							}
							echo $t;
						}
						else 
						{
							echo "No results";
						}
						
						echo "</td>";
						echo"<td> <center><a href=udatecusto.php?id=$row[ID]><img  src=update.png width=25px></a></td>";
						echo"<td> <center><a href=deletecustomer.php?id=$row[ID]><img  src=delete.jpg width=25px></a></td>";
					echo"</tr>";
					 endwhile;
			echo"</table>";
		?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
