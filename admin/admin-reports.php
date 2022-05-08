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
<title>Minute Burger Sales and Inventory System</title>
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
		
			<!--  start account-content -->	
			<div class="account-content">
			asdsadasd
			</div>
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
				<div class="table">

					<ul class="select"><li><a href="admin-home.php"><b>Product</b><!--[if IE 7]><!--></a><!--<![endif]-->

					</li>
				</ul>
				<div class="nav-divider">&nbsp;</div>

				<ul class="select"><li><a href="inventory.php"><b>Inventory</b><!--[if IE 7]><!--></a><!--<![endif]-->

				</li>

				<div class="nav-divider">&nbsp;</div>

				<ul class="current"><li><a href="admin-reports.php"><b>Sales Report</b><!--[if IE 7]><!--></a><!--<![endif]-->

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

echo "Date: "; 				
echo "<select name='sale_date' >";
$que = $connect->query("select distinct sale_date from orders order by sale_date desc");
while ($row1 =$que->fetch_assoc()) {
	if ($_POST['sale_date'] == $row1['sale_date']) {
		$selected = "selected";
	} else {
		$selected = '';
	}
	echo "<option value='" . $row1['sale_date'] . "' $selected>".$row1['sale_date']."</option>";
}
echo "</select>";  
echo "<input name='searchdate' type='submit' value='Search'/>";  


if (isset($_POST["searchdate"])) {
	$labels = array("Invoice Number","Product Name","Quantity","Price","Total Price","Date","Time");
	$sdate = $_POST["sale_date"];

	$sql10 = "select * from orders as o, order_item as i, product as p WHERE o.order_id=i.order_id 
	and i.product_id=p.product_id and o.sale_date = '$sdate' order by o.order_id DESC";

	echo "<table width='100%' border='1'><tr>";
	foreach($labels as $l)
		echo "<th  ><center>$l</center></th>";
	echo "</tr>";
	
	$rs = $connect->query($sql10);

	while ($row = $rs->fetch_assoc())
	{
		echo "<tr>";
		$quantity = $row['quantity_sold'];
		$price = $row['product_price'];
		$totalprice = $quantity * $price;

			echo "<td align='center' >".$row['order_id']."</td>";
			echo "<td align='left' >".$row['product_name']."</td>";
			echo "<td align='center' >".$row['quantity_sold']."</td>";
			echo "<td align='center' >".$row['product_price']."</td>";
		echo "<td align='center' >Php ".$totalprice."</td>";
			echo "<td align='center' >".$row['sale_date']."</td>";
			echo "<td align='center' >".$row['sale_time']."</td>";
		
		echo "</tr>";
	}
	echo "</table>";
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
	&copy; Copyright JRJ Motor Parts Inventory System</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
