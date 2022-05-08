<?php
session_start();
include('../connect.php');

if(@$_SESSION['admin_id'] != "") {

}
else {
	echo "<script>alert('Please Log in!');location.replace('index.php');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>JRJ Motor Parts Inventory System</title>
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />

<!--  jquery core -->
<script src="../js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
 
<!--  checkbox styling script -->
<script src="../js/jquery/ui.core.js" type="text/javascript"></script>
<script src="../js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="../js/jquery/jquery.bind.js" type="text/javascript"></script>


<!-- Custom jquery scripts -->
<script src="../js/jquery/custom_jquery.js" type="text/javascript"></script>
 

</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">
	
	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="../images/shared/logo.png" width="156" height="70" alt="" /></a>
	</div>
	<!-- end logo -->
	
</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			
			<a href="../logout.php" id="logout"><img src="../images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		
			
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
				<div class="table">

					<ul class="current"><li><a href="admin-home.php"><b>Product</b><!--[if IE 7]><!--></a><!--<![endif]-->

					</li>
				</ul>
				<div class="nav-divider">&nbsp;</div>

				<ul class="select"><li><a href="inventory.php"><b>Inventory</b><!--[if IE 7]><!--></a><!--<![endif]-->

				</li>

				<div class="nav-divider">&nbsp;</div>

				<ul class="select"><li><a href="admin-reports.php"><b>Sales Report</b><!--[if IE 7]><!--></a><!--<![endif]-->

				</li>
			</ul>

		
		
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">


	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	
	
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data" >
<?php


if(isset($_GET['edit'])){
	$edit = $_GET['edit'];
	
	$fetch = $connect->query("SELECT * FROM product WHERE product_id='$edit' ");
	$rows =  $fetch->fetch_assoc();
	
	?>
	EDIT PRODUCT
	<br>
		<form action='process.php' method='POST' enctype="multipart/form-data"><Br>
			Product Name: <input type='text' name='product_name' value='<?php echo $rows['product_name'];?>' required><br><br>
			Price: <input type='number' name='product_price' value='<?php echo $rows['product_price'];?>' required><br><br>
			<input type="hidden" name="product_id" value="<?php echo $rows['product_id']; ?>" required>
			<input type='submit' name='Submit' value='Update Product'>
		</form>
		<br><br><a href="admin-home.php">Go back!</a>
	<?php
}
if(isset($_GET['edit1'])){
	$inventory_edit = $_GET['edit1'];
	
	$fetch = $connect->query("SELECT * FROM inventory WHERE inventory_id='$inventory_edit' ");
	$rows = $fetch->fetch_assoc();
	
	?>
	EDIT INVENTORY
	<br>
		<form action='process.php' method='POST' enctype="multipart/form-data"><Br>
			Product:  <select name="product" required="">
							<option value="">Select Product</option>
							<?php
							$rs = $connect->query("Select * from product order by product_name");
							while ($row = $rs->fetch_assoc())
							{	
								echo "<option value='".$row['product_id']."'";
								if($row['product_id'] == $rows['product_id']) {
									echo ' selected';
								}
								echo ">".$row['product_name']."</option>";
							}

							?>
						</select><br><br>
			Quantity: <input type='number' name='quantity' value='<?php echo $rows['quantity'];?>' required><br><br>
			Date: <input type='text' name='inventory_date' value='<?php echo $rows['inventory_date'];?>' required><br><br>
			<input type="hidden" name="inventory_id" value="<?php echo $rows['inventory_id']; ?>" required>
			<input type='submit' name='Submit' value='Update Inventory'>
		</form>
		<br><br><a href="admin-home.php?">Go back!</a>
	<?php
}

if(isset($_GET['delete'])){
	 $product_id = $_GET['delete'];
	 
	$delete = $connect->query("DELETE FROM product WHERE product_id=$product_id");
	
	if($delete){
			
			echo '<script>alert("Are you sure you want to delete this product?)</script>';
			echo '<script>location.replace("admin-home.php")</script>';	
			
	}else
		echo "Error";
}
if(isset($_GET['delete1'])){
	 $item_number = $_GET['delete1'];
	 
	$delete = $connect->query("DELETE FROM inventory WHERE inventory_id=$item_number");
	if($delete){
		
			echo '<script>alert("Are you sure you want to delete this product?)</script>';
			echo '<script>location.replace("admin-home.php")</script>';	
			
	}else
		echo "Error";
}


if(isset($_POST['Submit'])){
	
	$product_id = $_POST['product_id'];
	$inventory_id = $_POST['inventory_id'];
		switch ($_POST['Submit'])
			{
				case 'Update Product':
				{
					$product_name = $_POST['product_name'];
					$price = $_POST['product_price'];
					
						$edit_query = $connect->query("UPDATE product SET product_name='$product_name',product_price='$price' WHERE product_id='$product_id' ");
						if ($edit_query)
						{
							echo '<script>alert("Product record has been successfully updated...")</script>';
							echo '<script>location.replace("admin-home.php")</script>';							
						}
						else
							echo '<script>alert("Error in saving record...");</script>';
					
				}
				break;
				case 'Update Inventory':
				{
					$product_id = $_POST['product'];
					$quantity = $_POST['quantity'];
					$inventory_date = $_POST['inventory_date'];
					
						$edit_query = $connect->query("UPDATE inventory SET product_id='$product_id',quantity='$quantity',inventory_date='$inventory_date' WHERE inventory_id='$inventory_id' ");
						if ($edit_query)
						{
							echo '<script>alert("Inventory record has been successfully updated...")</script>';
							echo '<script>location.replace("admin-home.php")</script>';							
						}
						else
							echo '<script>alert("Error in saving record...");</script>';
				}
				break;
	
	}
	
}

?>
</form>
	</table>
	<!-- end id-form  -->

	</td>
	<td>

</td>
</tr>
<tr>
<td><img src="../images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>

<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	&copy; Copyright JRJ Motor Parts Inventory System.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
