<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Store Details </title>

</head>
<body style="background-color:skyblue">
	<hr />
	<center> <h2> Store Details </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<br />
	<table>
	<tr>
	<td><br />SID &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="storeid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="name" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Street Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="streetname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br /> No Of Employee &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="noe" />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td> <br /> Location &nbsp &nbsp &nbsp </td>
	<td><br /><select name="location" multiple>
	<option value="Arunachal Pradesh">Arunachal Pradesh</option>
	<option value="Assam">Assam</option>
	<option value="Andhra Pradesh">Andhra Pradesh</option>
	<option value="Rajasthan">Rajasthan</option>
	<option value="Punjab">Punjab</option>
	<option value="Haryana">Haryana</option>
	<option value="Uttar Pradesh">Uttar Pradesh</option>
    <option value="Gujarat">Gujarat</option>
	<option value="Hyderabad">Hyderabad</option>
	<option value="Banglore">Banglore</option>
    <option value="Kerla">Kerla</option>
	<option value="Orissa">Orissa</option>
	<option value="West Bengal">West Bengal</option>
	<option value="Other">Other</option>
</select><font color="RED" SIZE="2">*</font></td>
	</tr>
	<tr>
	<td><br /> If Other &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="othr"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	</table>
	<br /><br /><input type ="submit" value="Submit">
	</center>
	</form>
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
	if (isset($_POST['storeid']) && isset($_POST['name']) && isset($_POST['streetname']) && isset($_POST['noe']))
		$query = "INSERT INTO store (SID,Name,Streetname,No_of_Employee) VALUES ('$_POST[storeid]','$_POST[name]','$_POST[streetname]','$_POST[noe]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
	}
?>
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
	if (isset($_POST['storeid']) && isset($_POST['location']))
	{
		if($_POST['location'] == "Other")
			$query = "INSERT INTO storelocation VALUES ('$_POST[storeid]','$_POST[othr]')";
		else
			$query = "INSERT INTO storelocation VALUES ('$_POST[storeid]','$_POST[location]')";
	}
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
	}
	else
		header ("Location:option.php");
?>
</body>
</html>
	