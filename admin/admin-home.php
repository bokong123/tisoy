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

				<div class="nav-divider">&nbsp;</div>
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
						<a href="addproduct.php">Add Product</a>
						
						<?php
					
						echo "<table width='100%' border='1' id='product-table'>";
						echo "<br>";
						echo "<tr>";
						echo "<th width='35' scope='col'><center>No.</center></th>";

						echo "<th  ><center>Product Name</center></th>";
						echo "<th  ><center>Price</center></th>";
						echo "<th  ><center>Quantity in stock</center></th>";
						echo "<th  ><center>Action</center></th>";
						echo "</tr>";
						$i = 1;
						$sql_product = $connect->query("select * from product");
						while($row = $sql_product->fetch_assoc()) {	
							echo "<tr><td align='center' >$i</td>";
							echo "<td align='left' >".$row['product_name']."</td>";
							echo "<td >".$row['product_price']."</td>";

							$product_id = $row['product_id'];
							$sql_inventory = $connect->query("select sum(quantity) as quantity from inventory where product_id=$product_id");
							$row_inventory = $sql_inventory->fetch_assoc();
							$quantity = $row_inventory['quantity'];

							$sql_order = $connect->query("select sum(quantity_sold) as quantity_sold from order_item where product_id=$product_id");
							$row_order = $sql_order->fetch_assoc();
							$quantity_sold = $row_order['quantity_sold'];

							$stocks = $quantity-$quantity_sold;
							echo "<td >".$stocks."</td>";

							echo "<td align='left'><a href='process.php?edit=".$row['product_id']."'>Edit</a> <a href='process.php?delete=".$row['product_id']."'>Delete</a></td>";
							$i++;
						}
						echo "</table>";


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
	&copy; Copyright 2021 JRJ Motor Parts Inventory System.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->

</body>
</html>
