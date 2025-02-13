<?php
	session_start();
	
	if (!isset($_SESSION['admin'])) 
	{
		
		echo "<script>alert('your are not logged in ,please log in');</script>";
		header("Location: login.html");
		exit();
		
	}
?>
<html>
<head>
    <title>Dashboard - Clothing Store Management</title>
	<link rel="stylesheet" href="styles.css">	
    <style>
				 
		body 
		{
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background: url('tb.png') no-repeat center center fixed;
			background-size: cover;
			color: white;
			background-color:black;
			
		}
		
		.dashboard-container 
		{
			
			display: flex;
			height: 663px;
		}
		

		.sidebar 
		{
			height:100%; 
			position:fixed;
			width: 250px;
			background-color: rgba(0, 0, 0, 0.7);
			padding: 20px;
			box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
		}

		.sidebar h2
		{
			color: white;
			text-align: center;
			margin-bottom: 20px;
		}

		.sidebar ul
		{
			padding: 0;
		}
		

		.sidebar ul a 
		{
			display: block;
			padding: 10px;
			color: white;
			text-decoration: none;
			transition: background 0.3s;
			transition: 0.5s;
		}

		.sidebar ul a:hover 
		{
			background-color: rgba(255, 255, 255, 0.2);
			transform: translateX(20px);
			transition: 0.7s;
		}

		.main-content
		{
			flex: 1;
			padding: 20px;
			margin-left:20%;
			background-color: rgba(255, 255, 255, 0.1);
			
		}

		header h1 
		{
			margin-top: 0;
			border-bottom: 2px solid white;
			padding-bottom: 15px;
		}

		section h2
		{
			margin-top: 0;
			width:150px;
			border-bottom: 2px solid white;
			padding-bottom: 10px;
		}

		.card 
		{
			background-color: rgba(0, 0, 0, 0.6);
			border-radius: 10px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 8px 5px 8px rgba(0, 0, 0, 0.3);
		}

		.card h3 
		{
			margin-top: 0;
		}

		.card p 
		{
			margin: 0;
			color: #ffcc00;
		}

		
		#overview .card 
		{
			display: inline-block;
			width: 35%;
			margin-right: 4%;
		}

		#overview .card:last-child
		{
			margin-right: 0;
		}
		
		span
		{
			 
		}
		.admin-setting
		{
			font-size:16;
			font-align:right;
			text-decoration:none;
			color:white;
		}
		span
		{
			font-size:18;
		}
		
		.modal 
		{
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content 
		{
			color:white;
            background-color: white;
            padding: 20px;
            border-radius: 30px;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .close 
		{
			color:black;
            float: right;
            font-size: 35px;
            font-weight: bold;
        }
        .close:hover,.close:focus 
		{
            color: red;
			text-decoration: none;
            cursor: pointer;
        }
		.modal
		{
			color:black;
		}
		#admin input
		{
			width: calc(100% - 20px);
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
		}
		
		
		
		.container ,#note-container
		{
			border-radius: 30px;
			background: url('tb.png') no-repeat center center fixed;
			background-color: white;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		#note-container
		{
			width:35%;
			height:45%;
		}
		h2
		{
			margin-bottom: 20px;
		}

		label 
		{
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		input[type="text"], input[type="password"]
		{
			width: 100%;
			padding: 8px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 4px;
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
		.note
		{
			display: block;
            position: fixed;
			border-radius: 50px;
            left: 1250;
            top: 550;
            width: 5%;
            height: 10%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
			cursor:pointer;
			transition: transform 0.6s 
		}
		.note-data
		{
			display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
		}
		textarea
		{
			width:85%;
			height:55%;
			display:flex;
		}
		img:hover
		{
			transform: scale(1.1);
			filter:drop-shadow(0 15px 25px);
			transition: transform 0.6s 
		}
		.note:hover
		{
			transform: rotate(360deg);
			box-shadow: 0 2px 35px white;
			transition: transform 0.9s 
		}
		
		
	</style>
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
			
			<input type="hidden" id="v1" name="v1" value="<?php echo"$_SESSION[password]";?>">
			<?php echo"Welcome😃,$_SESSION[admin]";?>
			
            <h2>WEB Clothing:Management and Billing</h2>
            <ul>
                
                <a href="Inventory.php">Inventory</a>
				<a href="stock.php">Stock Purchesed</a>
				<a href="billing.php">Billing</a>
                <a href="sales.php">Sales</a>
				<a href="Customers.php">Customers</a>
                
				<a href="logout.php">Log Out</a>
            </ul>
        </nav>
		<div class="main-content">
            <header>
			
                <h1>Dashboard &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="admin-setting" onclick="verifyadmin()"><img style=" float: right" style="border-radius:80px" src="adminicon.png" width="50px" height="50px">Admin Settings</a></h1>
            </header>
            <section id="overview">
                <h2>Overview</h2>
                    <div class="card">
                        <h3>Total Sales</h3>
                        <p><?php
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
                    <div class="card">
                        <h3>Total Orders</h3>
                        <p><?php
								$conn = new mysqli("localhost","root","","admins");

								if ($conn->connect_error) 
								{
									die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT  quantity_sold FROM sales";
								$result = $conn->query($sql);

								$totalorder = 0;

								if ($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										$totalorder += $row['quantity_sold'];
									}
									echo "Total sales order : " . $totalorder;
								} 
								else 
								{
									echo "0 results";
								}

								$conn->close();
								?></p>
                    </div>
                    <div class="card">
                        <h3>Total Customers</h3>
                        <p><?php
								$conn = new mysqli("localhost","root","","admins");

								if ($conn->connect_error) 
								{
									die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT  name FROM customer";
								$result = $conn->query($sql);

								$tc=$result ;
								if ($result->num_rows > 0)
								{
									echo "Total Customers  : ".$result->num_rows ;
								} 
								else 
								{
									echo "0 results";
								}

								$conn->close();
								?>
						</p>
					</div>
					<div class="card">
                        <h3>Total T-shirts Sale</h3>
                        <p><?php
								$conn = new mysqli("localhost","root","","admins");

								if ($conn->connect_error) 
								{
									die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT quantity_sold  FROM sales where item_name='T-shirt'";
								$result = $conn->query($sql);

								$totalt = 0;

								if ($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										$totalt+= $row['quantity_sold'];
									}
									echo "Total todays sales: " . $totalt;
									
								} 
								else 
								{
									echo "Total todays sales: " . $totalt;
								}
								?>
						</p>
						</div>
						<div class="card">
                        <h3>Total shirts Sale</h3>
                        <p><?php
								$conn = new mysqli("localhost","root","","admins");

								if ($conn->connect_error) 
								{
									die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT quantity_sold  FROM sales where item_id='2'";
								$result = $conn->query($sql);

								$totalt = 0;

								if ($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										$totalt+= $row['quantity_sold'];
									}
									echo "Total todays sales: " . $totalt;
									
								} 
								else 
								{
									echo "Total todays sales: " . $totalt;
								}
								?>
						</p>
						
                   
                    </div>
					<h2>Todays Sales</h2>
					
                    <div class="card">
                        <h3>Total Sales</h3>
                        <p><?php
								$conn = new mysqli("localhost","root","","admins");

								if ($conn->connect_error)
								{
									die("Connection failed: " . $conn->connect_error);
								}
								
								$d=date("Y-m-d");
								$sql ="select total_price from sales where Date='$d'";
								$result = $conn->query($sql);

								$totalPrice = 0;

								if ($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										$totalPrice += $row['total_price'];
									}
									echo "Total todays sales: ₹" . $totalPrice;
									
								} 
								else 
								{
									echo "Total todays sales: ₹" . $totalPrice;
								}

								$conn->close();
								?>
					</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
	<img src="20546695_6306478.jpg"id="note" class="note" onclick="shownote()">
	<div id="admin" class="modal">
        <div class="modal-content">
		<div class="container">
            
			
			<form id="updateForm" action="updateuser.php" method="post">
			<span class="close" onclick="closeadmin()">&times;</span>
			<h2>Update User</h2>
			<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $_SESSION['admin'];?>" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $_SESSION['password'];?>" required>

			<label for="q1">Select Question:</label>
            <input list="qu" id="q1"  name="qu" value="<?php echo$_SESSION['que']; ?>" required>
			<datalist id="qu" name="qu" required>
					<option>First car number?</option>
					<option>Best Friend Name</option>
					<option>Most Likely School Teacher name</option>
			</datalist>
			<label for="ans">Answer:</label>
            <input type="text" id="ans" name="ans" value="<?php echo$_SESSION['ans']; ?>" required>
			
            <button type="submit" name="updateUser">Update</button>
        </form>
		<table>
			<tr><td><button id="addUserBtn">Add New User</button>
				<td><button id="showadminlist" onclick="showlist()">Show Admin List</button>
		</table>
		<div id="adminlist">
		<h3>Admins/User List<hr></h3>
		<p style="color:green">🟢 - Currunt Login User</p>
		<?php 
			
			$conn = new mysqli("localhost","root","","admins");

			$sql ="select *from admin ";
			$result = $conn->query($sql);

			

			
			echo"<table border width=80% >
					<tr>
						<th style=padding:15px colspan=2>Username</th>
					</tr>";
					 while($row= $result->fetch_assoc()): 
					 echo"<tr>";
						echo"<td> <input type=text value=$row[Username] readonly></td>";
						
						if($_SESSION['admin']==$row['Username'])
						{	
							echo " 🟢 ";

						}
						else 
						{
							echo '<td style="padding:20px"><center><a style="text-decoration:none" href="logout.php">Login</a></center></td>';
						}
						echo"</tr>";
					 endwhile;
			echo"</table>";
		?></div>
        <form id="newUserForm" action="register.php" method="post" style="display:none;">
		<h2>Add New User(Admin)</h2>
            <label for="newUsername">New Username:</label>
            <input type="text" id="newUsername" name="newusername" required>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newpassword" required>
			
			<label for="q1">Select Question:</label>
            <input list="qu" id="q1"  name="qu" required>
			<datalist id="qu" name="qu" required>
					<option>First car number?</option>
					<option>Best Friend Name</option>
					<option>Most Likely School Teacher name</option>
			</datalist>
			<label for="ans">Answer:</label>
            <input type="text" id="ans" name="ans" required>

            <button type="submit" name="addUser" id="addUser" onclick="verifyadmin()">Add User</button>
           
        </form>
			<button type="submit" name="Back" id="Back">Back</button>
		</div>
		</div>
	</div>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$conn = new mysqli("localhost","root","","admins");
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}
			$note=$_POST['notecontent'];
			$sql ="Update admin set Note='$note' where Username='$_SESSION[admin]'";
			$result = $conn->query($sql);
			
		}
		
	?>
	<div id="noteshow" class="note-data">
		<div id="note-container">
		    <span class="close" onclick="closeadmin()">&times;</span>
		<form action="dashboard.php" method="post">
			<h2>Admin <?php echo"$_SESSION[admin]'s";?> Notes:</h2>
			<textarea  name="notecontent" " cols="50" rows="50"><?php 
												$connn = new mysqli("localhost","root","","admins");
												if ($connn->connect_error)
												{
													die("Connection failed: " . $conn->connect_error);
												}
												$sql1 = "SELECT Note FROM admin where Username='$_SESSION[admin]'";
												$result1 = $connn->query($sql1);
												while($row = $result1->fetch_assoc()): 
												echo "$row[Note]";
												endwhile;
			?></textarea><br>
			<button>Save Note</button><br>
		</form>
		</div>
	</div>
</body>
</html>

    <script>
	
		function verifyadmin()
		{
			const p1=document.getElementById('v1').value;
			var ans=prompt("Enter Your Password:");
			if(ans!=null)
			{
				if(ans==p1)
				{
					showadmin();
				}
				else
				{
					alert('wrong password!');
					verifyadmin();
				}
			}
		}
        function showadmin()
		{
			document.getElementById('admin').style.display = 'flex';
			document.getElementById('adminlist').style.display = 'none';
				document.getElementById('Back').style.display = 'none';
			
		}

        function closeadmin()
		{
            document.getElementById('admin').style.display = 'none';
            document.getElementById('noteshow').style.display = 'none';
						
        }

        window.onclick = function(event) {
            const modal = document.getElementById('admin');
            if (event.target === modal) {
                closeadmin();
            }
        }
		
		document.getElementById('addUserBtn').addEventListener('click', function() {
			verifyadmin();
		var newUserForm = document.getElementById('newUserForm').style.display = 'block';
			document.getElementById('Back').style.display = 'block';
		
		//newUserForm.style.display = newUserForm.style.display === 'none' ? 'block' : 'none';
	
		var UserForm = document.getElementById('updateForm').style.display = 'none';
		document.getElementById('addUserBtn').style.display = 'none';
		document.getElementById('noteshow').style.display = 'none';
		document.getElementById('adminlist').style.display = 'none';
		document.getElementById('showadminlist').style.display = 'none';
		});
		
		document.getElementById('Back').addEventListener('click', function() {
		var UserForm = document.getElementById('newUserForm').style.display = 'none';
		document.getElementById('updateForm').style.display = 'block';
		document.getElementById('addUserBtn').style.display = 'block';
		document.getElementById('adminlist').style.display = 'block';
		document.getElementById('showadminlist').style.display = 'block';
		document.getElementById('adminlist').style.display = 'none';
			document.getElementById('Back').style.display = 'none';
		});
		
		function shownote()
		{
			document.getElementById('noteshow').style.display = 'flex';
		}
		
		function showlist()
		{
			document.getElementById('adminlist').style.display = 'block';
			document.getElementById('Back').style.display = 'block';
			document.getElementById('showadminlist').style.display = 'none';
			document.getElementById('updateForm').style.display = 'none';
			document.getElementById('addUserBtn').style.display = 'none';
			
		}
    </script>