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
		$price_per_item = $_POST['price_per_item'];
		$total_price=$_POST['total_price'];

		$sql = "INSERT INTO stock_ordered(Item_name, quantity, price_per_item, total_price) VALUES ('$item_name','$quantity','$price_per_item','$total_price')";
		$conn->query($sql);
	}

	$sql = "SELECT * FROM stock_ordered";
	$result = $conn->query($sql);
	
	$sql1 = "SELECT  quantity FROM stock_ordered";
	$r = $conn->query($sql1);

	$row = $r->fetch_assoc();
	$quantity=$row['quantity'];
	
?>

<html>
<head>
	<title>Stock Purchesed</title>
    
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
			<li><a href="Inventory.php">Inventory</a></li>
			<li><a href="billing.php">Billing</a></li>
		    <li><a href="sales.php">sales</a></li>
			<li><a href="Customers.php">Customers</a></li>
			<li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Purchesed Ordered Management</h1>
		<h3>Add New Purchesed Ordered Details<hr></h3>
        <form action="stock.php" method="POST">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" pattern="[A-Za-z ]+" required>
			
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
			
			<label for="price_per_item">price per item:</label>
            <input type="number" id="price_per_item" name="price_per_item" min="1" required>
            
			
			<label for="total_price">Total Price:</label>
            <input type="number" id="total_price" name="total_price" min="1"  onfocus="cal()" required>
            
			<button>Add</button>
        </form>
		
		<script>
		
		function cal()
		{
			
			 const qu=document.getElementById('quantity').value;
			 const qu1=qu.value;
			 
			 const pp=document.getElementById('price_per_item').value;
			 const pp1=pp.value;
			 
			 var tp=qu*pp;
			 
			 //document.getElementById('total_price').innerHTML=tp;
			 document.getElementById('total_price').value=tp;
		}
		</script>
        <h2>Inventory List</h2>
		<h3>Update/Delete Item<hr></h3>
		<?php 
			$con=mysqli_connect("localhost","root","","admins");
			$query=mysqli_query($con,"select * from stock_ordered");
			echo"<table>
					<tr>
						<th>ID</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Price per Item</th>
						<th>Total Price</th>
						<th>Date</th>
						
					</tr>";
					
					
				if(mysqli_num_rows($query))
				{
				while($a=mysqli_fetch_array($query))
				{
					echo "<tr>";
					echo "<td>$a[0]</td>";
					echo "<td>$a[1]</td>";
					echo "<td>$a[2]</td>";
					echo "<td>$a[3]</td>";
					echo "<td>$a[4]</td>";
					echo "<td>$a[5]</td>";
					
					
					echo "</tr>";
				}
			}
			else
			{
				echo "Records Not Found";
			}
		
		?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
