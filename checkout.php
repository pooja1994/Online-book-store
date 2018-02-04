<?php
 session_start();
 extract($_POST);
 extract($_SESSION);



require('includes/config.php'); 

 global $conn;	
	


	if(isset($submit))
	{
	$query="insert into shipping_details(name,address,postal_code,city,state,phone,f_id) values('$name','$address','$pc','$city','$state','$phone','$uid')";
	
	$res=mysqli_query($conn,$query) or die("Can't Execute Query...");
	header("location:payment_details.php"); 


 } ?>



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
				<div id="logo-wrap">
				<div id="logo">
						<?php
							include("includes/logo.inc.php");
						?>
				</div>
				</div>
				
			<!-- end header -->
			<!------------------------------->
			<font style="font-size:30px;margin-left:420px">Shipping Details</font>	
			<div class="container">
			
		
      <div  class="form">
    		<form id="contactform" method="post"> 
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="name" placeholder="First and last name" required="" tabindex="1" type="text"> 
    			 
    			<p class="contact"><label for="email">Address</label></p> 
    			<textarea id="address" name="address" placeholder="Address" required="" cols="40" row="10"type="email"> </textarea>
                
                <p class="contact"><label for="username">Postal Code</label></p> 
    			<input id="pc" name="pc" placeholder="201001" required="" tabindex="2" type="text" maxlength="05"> 
    			 
                <p class="contact"><label for="city">City</label></p> 
    			
                <select style="width: 195px;" name="city">
														
															<option>Bangalore
<option>Chennai														<option>Hyderabad
															<option>Mysore
															<option>Mumbai
														
															
														
													</select>


<p class="contact"><label for="state">State</label></p>		
<select style="width: 195px;" name="city">
														
															<option>Maharashtra
<option>Karnataka													<option>Telangana
															<option>Tamil Nadu
															
														
															
														
													</select>

												
            <p class="contact"><label for="phone">Mobile phone</label></p> 
<input id="phone" type='text' name='contact' size="10" maxlength="10"></td> <br>
            <h4>Currently we are working with only CASH ON DELIVERY</h4><br>
        <input class="buttom" name="submit" id="submit" tabindex="5" value="Confirm & Proceed" type="submit"> 

</form> 
</div>  
</div>
</body>