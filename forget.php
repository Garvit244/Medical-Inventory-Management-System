<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Password Recovery </title>

</head>
<body style="background-color:skyblue">
<hr />
	<center> <h2> Recover Password </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<br />
	<table>
	<tr>
	<td><br />Old Password &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="opwd" />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />New Password &nbsp &nbsp &nbsp </td>
	<td><br /><input type="password" name="npwd" />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Rewrite New Password &nbsp &nbsp &nbsp </td>
	<td><br /><input type="password" name="rnpwd" />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	</table>
	
	
<?php
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if(isset($_POST['opwd']) && isset($_POST['npwd']) && isset($_POST['rnpwd']))
	{
		$opd = $_POST['opwd'];
		$query = "SELECT * FROM login where password = '$opd'";
		$sql = mysql_query($query,$con);
		if(empty($sql))
		{
			echo"<script>alert('Enter correct username!');</script>";
		}
		else
		{
			$query1 = "SELECT * FROM login where password = '$opd'";
			$query1 = "SELECT * FROM login where password = '$opd'";
			$sql1 = mysql_query($query1,$con);
			$row = mysql_fetch_array($sql1);
				if($_POST['npwd'] == $_POST['rnpwd'])
				{
					$usr = $row['username'];
					$pwd = $_POST['npwd'];
					$query2 = "UPDATE login set password= '$pwd' WHERE username = '$usr'";	
					if(isset($query))
					$sql2 = mysql_query($query2,$con); 
					
					header("Location:index.php");
				}
				else
				{
					echo"<script>alert('Enter correct matching password!');</script>";
				}
		}
			
	}
?>
	
	
	<br /><br /><input type ="submit" value="Submit">
	</center>
	</form>
	

</body>
</html>