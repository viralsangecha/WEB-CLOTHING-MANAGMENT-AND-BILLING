<?php
		session_start();
		if (!isset($_SESSION['admin']))
		{
			header("Location: login.html");
			exit();
		}
		
			?>	
<html>
<head>
    <title>Oders</title>
	<link rel="stylesheet" href="style.css">	
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
			width: 240px;
			height: 660px;
			background-color: rgba(0, 0, 0, 0.7);
			padding: 20px;
			position: fixed;
			box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
		}

		.sidebar h2 
		{
			text-align: center;
		}

		.sidebar h2 a
		{
			color: white;
			
			margin-bottom: 20px;
			color: white;
			text-decoration: none;
		}

		.sidebar ul 
		{
			list-style: none;
			padding: 0;
		}

		.sidebar ul a
		{
			margin: 10px 0;
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
			
		}

		.st
		{
			border-bottom: 2px solid white;
			width:150px;
		}
		h1 
		{
			border-bottom: 2px solid white;
			padding-bottom: 10px;
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

		a 
		{
			color: white;
			text-decoration: none;
		}
		.card 
		{
			background-color: rgba(0, 0, 0, 0.6);
			border-radius: 10px;
			padding: 20px;
			width:25%;
			color: #ffcc00;
			margin-bottom: 20px;
			box-shadow: 8px 5px 8px rgba(0, 0, 0, 0.3);
		}
		form input,SELECT
		{
			width:200px;
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
		
	</style>
</head>
<body>
    <div class="sidebar">
	<?php echo"Hello👋,$_SESSION[admin]";?>
        <h2><a href="dashboard.php">WEB Clothing:Management and Billing</a></h2>
        <ul>
           <li><a href="Inventory.php">Inventory</a></li>
		   <li><a href="stock.php">stock Purchesed</a></li>
		   <li><a href="billing.php">Billing</a></li>
		   <li><a href="Customers.php">Customers</a></li>
           
		   <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Sales</h1>
        <h2 class="st">Sales Track</h2>
		<form action="sales.php" method="POST">
		<h4 class="l">Search Records By:</h4>
		<SELECT name="s">
			<option value="Bill_no">Bill no</option>
			<option value="Date">Date</option>
			<option value="customer_name">Customers Name</option>
			<option value="item_name">Item Name</option>
		</select>
		<input type="text" name="nm" id="search_bil"  class="search_bi" required >
			
		<button>Search</button>
		</form>
		<form action="sales.php" method="get">
		<button>Reset</button>
		</form>
		<table>
				<tr>
					<th>Bill no</th>
					<th>Inventory Item ID</th>
					<th>Item Name</th>
					<th>Customers Name</th>
					<th>quntity</th>
					<th>price</th>
					<th>Date</th>
				</tr>
        <?php
			$con=mysqli_connect("localhost","root","","admins");
			$query=mysqli_query($con,"select * from sales");
		
			
			$counter=0;
		if ($_SERVER['REQUEST_METHOD'] == 'get') 
		{
			$counter=0;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			$counter+=1;
			$s=$_POST['s'];
			$nm = $_POST['nm'];
			
			$con1=mysqli_connect("localhost","root","","admins");
			$query1=mysqli_query($con1,"select * from sales where $s='$nm'");
		
		
		if(mysqli_num_rows($query1))
			{
				while($a=mysqli_fetch_array($query1))
				{
					echo "<tr>";
					echo "<td>$a[0]</td>";
					echo "<td>$a[1]</td>";
					echo "<td>$a[2]</td>";
					echo "<td>$a[3]</td>";
					echo "<td>$a[4]</td>";
					echo "<td>$a[5]</td>";
					echo "<td>$a[6]</td>";
					
					echo "</tr>";
				}
			}
			else
			{
				echo "Records Not Found";
			}
		}
		if($counter==0)
		{
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
					echo "<td>$a[6]</td>";
					
					echo "</tr>";
				}
			}
			else
			{
				echo "Records Not Found";
			}
		}
			?>
		<p class="card">	
			<?php
			$conn = new mysqli("localhost","root","","admins");

			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT  total_price FROM sales";
			$result = $conn->query($sql);

			$totalPrice = 0;

			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
				{
					$totalPrice += $row['total_price'];
				}
				echo "Total Income: ₹" . $totalPrice;
			} 
			else 
			{
				echo "0 results";
			}

			$conn->close();
		?>
		</p>
	</div>
</body>
</html>

<?php
$con->close();
?>

