<?php
session_start();
include ('connect.php');


  if(@$_SESSION['admin_id'] != "") {
    echo "<script>alert('You are already logged in');location.replace('admin/admin-home.php');</script>";
  }

  if(@$_SESSION['personnel_id'] != "") {
      echo "<script>alert('You are already logged in');location.replace('personnel/personnel-home.php');</script>";
  }


?>
<!DOCTYPE html>
<html>
<head>
<title>JRJ Motor Parts Inventory System</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>


</head>
<body id="login-bg"> 
 <form name="form1" method="post">
<!-- Start: login-holder -->
<div id="login-holder">

	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" name="submit" class="submit-login" value="Submit" /></td>
		</tr>
		
		</table>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="title-system">JRJ Motor Parts Inventory System</a>
 </div>
 <!--  end loginbox -->
 
</div>
<!-- End: login-holder -->
</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){

   $username = $_POST['username'];
   $password = $_POST['password'];

   $admin = $connect->query("select * from admin where username='$username' and password='$password'");
   $personnel = $connect->query("select * from personnel where username='$username' and password='$password'");
  
   if($admin->num_rows > 0) {
        $row = $admin->fetch_assoc();
         session_start();
        $_SESSION['admin_id'] = $row['admin_id'];

        header("location:admin/admin-home.php");
   }

   else if($personnel->num_rows > 0) {
        $row = $personnel->fetch_assoc();
        session_start();
        $_SESSION['personnel_id'] = $row['personnel_id'];

        header("location:personnel/personnel-home.php");
   }

   else {
        echo "<script>alert('Invalid username and password!');</script>";

   }


  }
?>
