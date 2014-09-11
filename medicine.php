<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Medicine Details </title>

</head>
<body style="background-color:skyblue">
	<hr />
	<center> <h2> Medicine Details </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<br />
	<table>
	<tr>
	<td><br />Batch No. &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="batchno" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="name" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Price &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="price" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br /> Expiry Date &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="exirydate" /><font color="RED" SIZE="2">*(yyyy-mm-dd)</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td> <br /> Category &nbsp &nbsp &nbsp </td>
	<td><br /><select name="category" multiple>
	<option value="Anti-inflammatory">Anti-inflammatory</option><
	<option value="Analgesic">Analgesic</option>
	<option value="Antipyretic">Antipyretic</option>
	<option value="Antitussive">Antitussive</option>
	<option value="Antiviral">Antiviral</option>
	<option value="Antifungal">Antifungal</option>
	<option value="Antibiotic">Antibiotic</option>
    <option value="Anaesthetic">Anaesthetic</option>
	<option value="Surfactant">Surfactant</option>
	<option value="Laxative">Laxative</option>
    <option value="Antihypertensive">Antihypertensive</option>
	<option value="Vaccine">Vaccine</option>
	<option value="Vitamin supplement">Vitamin supplement</option>
	<option value="Antacids">Antacids</option>
	<option value="Antidotes">Antidotes</option>
	<option value="Antipsychotics">Antipsychotics</option>
	<option value="Antimetabolites">Antimetabolites</option>
	<option value="Catecholamines">Catecholamines</option>
	<option value="Antihistamines">Antihistamines</option>
	<option value="Other">Other</option>
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
	if (isset($_POST['batchno']) && isset($_POST['name']) && isset($_POST['category']))
	{
		if($_POST['category'] == "Other")
			$query = "INSERT INTO medicinecategory(Batchno,Name,Category) VALUES ('$_POST[batchno]','$_POST[name]','$_POST[othr]')";
		else
			$query = "INSERT INTO medicinecategory(Batchno,Name,Category) VALUES ('$_POST[batchno]','$_POST[name]','$_POST[category]')";
	}
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
	}
	?>
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
	if (isset($_POST['batchno']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['exirydate']))
		$query = "INSERT INTO medicines (Batchno,Name,Price,ExpiryDate) VALUES ('$_POST[batchno]','$_POST[name]','$_POST[price]','$_POST[exirydate]')";
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
	