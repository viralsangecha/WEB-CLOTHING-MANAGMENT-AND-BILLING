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
		$item_id = $_POST['item_id'];
		$item_name=$_POST['item_name'];
		$customer_name=$_POST['customer_name'];
		$quantity_sold = $_POST['quantity_sold'];
		$price=$_POST['price_per_item'];
		$total_price=$_POST['total_price'];

		$sql = "select * from inventory WHERE id='$item_id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$item = $result->fetch_assoc();
			$new_quantity = $item['quantity'] - $quantity_sold;
			//$total_price = $item['price'] * $quantity_sold;

			if ($new_quantity >= 0) 
			{
				$sql = "UPDATE inventory SET quantity='$new_quantity' WHERE id='$item_id'";
				$conn->query($sql);

				$sql = "INSERT INTO sales (item_id, item_name,customer_name, quantity_sold, total_price) VALUES ('$item_id', '$item_name','$customer_name', '$quantity_sold', '$total_price')";
				$conn->query($sql);
				
				
			} 
			else
			{
				echo "<script>alert('Not enough items in stock');</script>";
			}
		} 
		else 
		{
			echo "<script>alert('Item not found');</script>";
		}
	}

	$sql = "SELECT * FROM inventory";
	$result = $conn->query($sql);
?>

<html>
<head>
    <title>Billing</title>
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
		option
		{
			font-size:16;
		}

		form .c_n,#price_per_item,#total_price,select
		{
			width: calc(100% - 20px);
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}
		
		.submit,button 
		{
			padding: 10px 20px;
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 50px;
			cursor: pointer;
			transition: background 0.3s;
		}

		.submit:hover 
		{
			background-color: #0056b3;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}
		button:hover 
		{
			background-color: #0056b3;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}
		
		.aitable 
		{
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		.aitable, .aith, .aitd 
		{
			border: 1px solid white;
		}

		.aith, .aitd
		{
			padding: 10px;
			
		}

		.aith 
		{
			background-color: rgba(0, 0, 0, 0.7);
		}

		.aitd 
		{
			background-color: rgba( 0, 0, 0, 0.3);
		}

		a 
		{
			color: white;
			text-decoration: none;
		}
		
		.add
		{
			width:50%;
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
           <li><a href="sales.php">Sales</a></li>
		   <li><a href="Customers.php">Customers</a></li>
      
		   <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Billing</h1>
        <form action="billing.php" method="POST">
		<table class="add" >
		<tr>
			<th>
            <label for="item_id">Item ID:</label>
			<?php
							

							$connn = new mysqli("localhost","root","","admins");

							if ($connn->connect_error)
							{
								die("Connection failed: " . $conn->connect_error);
							}

							$sql1 = "SELECT * FROM inventory";
							$result1 = $connn->query($sql1);
							echo "<select id=item_id name=item_id  required>";
							echo"<option></option>";
							while($row = $result1->fetch_assoc()): 
							
							echo "<option>";
							echo "$row[ID]";
							echo "</option> ";
							
							
							endwhile;
							echo "</select>";
			?>
				</th>
				<th>
			<label for="item_name">Item Name:</label>
			<?php
							
							$connn = new mysqli("localhost","root","","admins");

							if ($connn->connect_error)
							{
								die("Connection failed: " . $conn->connect_error);
							}

							$sql1 = "SELECT * FROM inventory";
							$result1 = $connn->query($sql1);
							echo "<select id=item_name name=item_name  required>";
							echo"<option></option>";
							while($row = $result1->fetch_assoc()): 
							
							echo "<option>";
							echo "$row[item_name]";
							echo "</option> ";
							
							
							endwhile;
							echo "</select>";
			?></th></tr>
			<tr>
				<th>
			<div>
			<label for="customer_name">Customers Name:</label>
            <?php
							$connn = new mysqli("localhost","root","","admins");

							if ($connn->connect_error)
							{
								die("Connection failed: " . $conn->connect_error);
							}

							$sql1 = "SELECT * FROM customer";
							$result1 = $connn->query($sql1);
							
							echo "<input list=customer_name id=cust_name  name=customer_name class='c_n' required ><datalist  id=customer_name name=customer_name required>";
							echo"<option>   </option>";
							while($row = $result1->fetch_assoc()): 
							
							echo "<option>";
							echo "$row[name]";
							echo "</option> ";
							
							
							endwhile;
							echo "</datalist>";
			?></th>
			<th>
			</div>
            <label for="quantity_sold">Quantity Sold:</label>
            <input type="number" id="quantity_sold" class='c_n'  name="quantity_sold" min="1" required>
			</th>
			</tr>
			<tr><th>
			<label for="price_per_item">price:</label>
            <input type="number" id="price_per_item" name="price_per_item" min="1" required>
			</th>
			<th>
			<label for="total_price">Total Price:</label>
            <input type="number" id="total_price" name="total_price" min="1"  onfocus="cal()" required>
			</th></tr>
			<tr>
			<th colspan="2" align="center" >
            <input type="submit" class="submit" value="Generate Bill" onclick="Bill()">
			</th>
			</tr>
			</table>
			 </form>
			  <button onclick="invaprint()">Print Available inventory</button>
			 
		<script>
		function cal()
		{
			
			 const qu=document.getElementById('quantity_sold').value;
			 const qu1=qu.value;
			 
			 const pp=document.getElementById('price_per_item').value;
			 const pp1=pp.value;
			 
			 var tp=qu*pp;
			 
			 //document.getElementById('total_price').innerHTML=tp;
			 document.getElementById('total_price').value=tp;
		}
		function Bill()
		{
			            
            var e2 = document.getElementById("item_name");
            var value2 = e2.value;
            var text2 = e2.options[e2.selectedIndex].text;
            
            const inputele=document.getElementById('cust_name');
			
			
		   
		    var e4 = document.getElementById("quantity_sold");
            var value4 = e4.value; // No options for input number*/
			
			var e5 = document.getElementById("price_per_item");
            var value5 = e5.value;
			
			var e6 = document.getElementById("total_price");
            var value6 = e6.value;
			
			let style="<style>";
			style+="body{font-family: Arial, sans-serif;margin: 20px;}h1{color: #333;}table {width: 100%;border-collapse:collapse;}th,td{border: 0px solid #ddd;padding: 8px;text-align: left;}th {background-color: #f2f2f2;}input{padding: 10px 20px;background-color: #007bff;color: white;border: none;border-radius: 50px;cursor: pointer;transition: background 0.3s;}input:hover {background-color: #0056b3;box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);}</style>";
			
			let today = new Date();

			let year = today.getFullYear();
			let month = (today.getMonth() + 1).toString().padStart(2, '0');
			let date = today.getDate().toString().padStart(2, '0');
			let d = `${date}-${month}-${year}`;
			
			let table = `<center><h1>Invoice</h1></center>
						<h3>Address:opp.central Bank,junu Bus-stand,Ranavav.</h3>
						<h3>Contact:9878964532</h3><p align="right">Date:- ${d}</p>
						<table>
						<tr>
							<th>Item Name</th>
							<th>Customer Name</th>
							<th>Quantity Sold</th>
							<th>Price</th>
							<th>Total Price</th>
						</tr>
						<tr>
							<td> ${text2}</td>
							<td> ${inputele.value}</td>
							<td>${value4} </td>
							<td>${value5} </td>
							<td>${value6}</td>
						</tr>
						</table>`;
			
			let winobj = window.open("", "", "width=1200,height=1200,align=center");
            winobj.document.write(style);
			winobj.document.write(table);
			winobj.document.close();
			winobj.print();
			
			
		}
			
		function invaprint()
		{
			let print=document.querySelector(".print").innerHTML;
			let style="<style>";
			style+="body{font-family: Arial, sans-serif;margin: 20px;}h1{color: #333;}table {width: 100%;border-collapse: collapse;}th,td{border: 1px solid #ddd;padding: 8px;text-align: left;}th {background-color: #f2f2f2;}input{padding: 10px 20px;background-color: #007bff;color: white;border: none;border-radius: 50px;cursor: pointer;transition: background 0.3s;}input:hover {background-color: #0056b3;box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);}</style>";
			
			
			let winobj=window.open("","","width=1500,height=1500,align=center");
			
			winobj.document.write(print);
			winobj.document.write(style);
			winobj.document.close();
			winobj.print();
        }
    </script>
       <div class="print" > <h2>Available Inventory</h2>
        <table class="aitable">
            <tr class="aitr">
                <th class="aith">ID</th>
                <th class="aith">Item Name</th>
                <th class="aith">Quantity</th>
                <th class="aith">Price</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr class="aitr">
                <td class="aitd"><?php echo $row['ID']; ?></td>
                <td class="aitd"><?php echo $row['item_name']; ?></td>
                <td class="aitd"><?php echo $row['quantity']; ?></td>
                <td class="aitd"><?php echo $row['price']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
	</div>
    </div>
</body>
</html>

<?php
$conn->close();
?>