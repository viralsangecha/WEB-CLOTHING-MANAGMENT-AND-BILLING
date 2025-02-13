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
		$item_name = $_POST['item_name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];

		$sql = "INSERT INTO inventory (item_name, quantity, price) VALUES ('$item_name', '$quantity', '$price')";
		$conn->query($sql);
	}

	$sql = "SELECT * FROM inventory";
	$result = $conn->query($sql);
	
	$sql1 = "SELECT  quantity FROM inventory";
	$r = $conn->query($sql1);

	$row = $r->fetch_assoc();
	$quantity=$row['quantity'];
	if($quantity < 5)
	{
		echo "<script> alert('stocke is less')</script>";
	}
?>

<html>
<head>
	<title>Inventory Management</title>
    
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

		form label 
		{
			display: block;
			margin: 10px 0 5px;
		}

		form input 
		{
			width: calc(100% - 20px);
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}

		form button 
		{
			padding: 10px 20px;
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 50px;
			cursor: pointer;
			transition: background 0.3s;
		}

		form button:hover 
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

		table, th, td 
		{
			border: 1px solid white;
		}

		th, td
		{
			padding: 10px;
			
		}

		th 
		{
			background-color: rgba(0, 0, 0, 0.7);
		}

		td 
		{
			background-color: rgba( 0, 0, 0, 0.3);
		}

		table a 
		{
			color: white;
			text-decoration: none;
		}

		table img 
		{
			vertical-align: middle;
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
			<li><a href="stock.php">stock Purchesed</a></li>
            <li><a href="billing.php">Billing</a></li>
		    <li><a href="sales.php">sales</a></li>
			<li><a href="Customers.php">Customers</a></li>
			
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Inventory Management</h1>
		<h3>Add New Item<hr></h3>
        <form action="inventory.php" method="POST">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" pattern="[A-Za-z ]+"  required>
			
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
            
			<label for="price">Price:</label>
            <input type="number" id="price" name="price" min="1" required>
            
			<button type="submit">Add Item</button>
        </form>
        <h2>Inventory List</h2>
		<h3>Update/Delete Item<hr></h3>
		<?php 
			echo"<table>
					<tr>
						<th>ID</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>update</th>
						<th>delete</th>
					</tr>";
					 while($row = $result->fetch_assoc()): 
					 echo"<tr>";
						echo"<td> $row[ID] </td>";
						echo"<td> $row[item_name] </td>";
						echo"<td> $row[quantity] </td>";
						echo"<td> $row[price] </td>";
						echo"<td> <center><a href=update.php?id=$row[ID]><img  src=update.png width=25px></a></td>";
						echo"<td> <center><a href=delete.php?id=$row[ID]><img  src=delete.jpg width=25px></a></td>";
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
