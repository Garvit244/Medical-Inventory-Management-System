<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Manager Details </title>

</head>
<body style="background-color:skyblue">
<hr />
<center> <h2> Manager Details </h2> </center>
<hr />
<center>
<form #action="registration.php" method = "post">
<br />
<table>
<tr>
<td><br />MID &nbsp &nbsp &nbsp </td>
<td><br /><input type="name" name="manageid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
</tr>
<tr>
<td><br />Firstname &nbsp &nbsp &nbsp </td>
<td><br /><input type="name" name="fname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
<td><br />Middlename &nbsp &nbsp &nbsp </td>
<td><br /><input type="name" name="mname" /> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
<td><br />Lastname &nbsp &nbsp &nbsp </td>
<td><br /><input type="name" name="lname" /> <font color="RED" SIZE="2">*</font></td>
</tr>
<tr>
<td> <br /> Date Of Birth &nbsp &nbsp &nbsp </td>
<td> <br /><input type="name" name="dob" /> <font color="RED" SIZE="2">*(yyyy-mm-dd)</font></td>
</tr>
<tr>
<td> <br /> Sex &nbsp &nbsp &nbsp </td>
<td> <br /> <input type="radio" name="male" value="Male"> Male</td>
<td> <br /> <input type="radio" name="female" value="Female"> Female</td>
</tr>
<tr>
<td> <br /> Store ID &nbsp &nbsp &nbsp </td>
<td> <br /><input type="name" name="ssid" /> <font color="RED" SIZE="2">*</font></td>
</tr>
<tr>
<td> <br />Username &nbsp &nbsp &nbsp </td>
<td> <br /><input type="name" name="username" /><font color="RED" SIZE="2">*</font> </td>
</tr>
<tr>
<td> <br />Password &nbsp &nbsp &nbsp </td>
<td> <br /><input type="password" name="passw" /><font color="RED" SIZE="2">*</font> &nbsp &nbsp &nbsp </td>
</tr>
</table>
<input type="submit" value="Register">
</form>
</center>
<?php
	$sex = "N";
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if(isset($_POST['male']))
		$sex = "M";
	else if(isset($_POST['female']))
		$sex = "F";
		
	if ( isset ($_POST['ssid']))
	{
		$query = "SELECT * from store where SID=".$_POST['ssid'].";";
		$sql = mysql_query($query,$con);
		$row=mysql_fetch_array($sql);
		if (!empty($row))
		{
	if (isset($_POST['manageid']) && isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && isset($_POST['dob']))
		$query = "INSERT INTO managed (MID,Fname,Mname,Lname,Sex,DOB,SSID) VALUES ('$_POST[manageid]','$_POST[fname]','$_POST[mname]','$_POST[lname]','$sex','$_POST[dob]','$_POST[ssid]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";	
	}
	else
		header ("Location:index.php");
	mysql_close($con);
	
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("medical_inventory", $con)))
	{
		die ("Database Not Selected");
	}
	if (isset($_POST['username']) && isset($_POST['passw']))
		$query = "INSERT INTO login VALUES ('$_POST[username]','$_POST[passw]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";	
	}
	}
	else
		echo "<script>alert('Store does not exist!');</script>";

	}	
		?>
</body>
</html>