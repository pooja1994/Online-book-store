<?php 
 session_start();
 extract($_POST);
 extract($_SESSION);

require('includes/config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<?php
			include("includes/head.inc.php");
		?>
</head>

<body>
			<!-- start header -->
				<div id="header">
					<div id="menu">
						<?php
							include("includes/menu.inc.php");
						?>
					</div>
				</div>
				<div >
				<div id="logo">
						<?php
							include("includes/logo.inc.php");
						?>
				</div>
				</div>
				
			<!-- end header -->
 		
		<div id="logo-wrap" >

        <?php		 	
			$q= "SELECT * FROM shipping_details ORDER BY id DESC LIMIT 1 ";

		 	$exe=mysqli_query($conn,$q) or die("cant Execute");
		 	$row = mysqli_fetch_array($exe);

		 	$name = $row['name'];
		 	$address = $row['address'];
		 	$pc = $row['postal_code'];
		 	$city = $row['city'];
			$state = $row['state'];
			$phone = $row['phone'];
		?>
		<div style="padding: 25px">
			<h2>Order Details</h2>
        <p>Name: <?php echo "$name";?> </p>
         <p>Address: <?php echo "$address"; ?> </p>
         <p>Postal Code: <?php echo "$pc";?> </p>
        <p>City: <?php echo "$city";  ?> 
<select style="width: 195px;" name="city">
														
															<option>Bangalore
<option>Chennai														<option>Hyderabad
															<option>Mysore
															<option>Mumbai
														
															
														
													</select></p>
        <p>State: <?php echo "$state";  ?>
<select style="width: 195px;" name="city">
														
															<option>Maharashtra
<option>Karnataka													<option>Telangana
															<option>Tamil Nadu
															
														
															
														
													</select>
											 </p>
       	<p>Phone:<?php echo "$phone"; ?></p>
		</div>
		<a href="index.php">Go to Home</a>
        
		</div>

	</body>
</html>	
			

			