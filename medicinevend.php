<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Medicine Details </title>

</head>
<body style="background-color:skyblue">
	<hr />
	<center> <h2> Medicine Buy From Vendor Details </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<br />
	<table>
	<tr>
	<td><br />Vendor ID. &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="vid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="vname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Area &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="area" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Sex &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="sex" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Date &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="date" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Store ID &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="sid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Medicine Batch No. &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="batchno" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Medicine Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="name" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Price &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="price" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<tr>
	<td><br />Quantity &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="qty" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
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
	$x=0;
	if ( isset ($_POST['sid']))
	{
	 $query = "SELECT * from store where SID=".$_POST['sid'].";";
		$sql = mysql_query($query,$con);
		$row=mysql_fetch_array($sql);
	
	if (!empty($row))
	{
	if (isset($_POST['batchno']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['exirydate']))
		$query = "INSERT INTO medicines (Batchno,Name,Price,ExpiryDate) VALUES ('$_POST[batchno]','$_POST[name]','$_POST[price]','$_POST[exirydate]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
	}
	if (isset($_POST['batchno']) && isset($_POST['name']) && isset($_POST['sid']) && isset($_POST['qty']))
		$query = "INSERT INTO contains (SSID,Medbatchno,Medname,Qty) VALUES ('$_POST[sid]','$_POST[batchno]','$_POST[name]','$_POST[qty]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
				
	if (isset($_POST['vid']) && isset($_POST['vname']) && isset($_POST['area']) && isset($_POST['sex']))
		$query = "INSERT INTO vendors (ID,Name,Area,Sex) VALUES ('$_POST[vid]','$_POST[vname]','$_POST[area]','$_POST[sex]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
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
	else
		header ("Location:option.php");
		
		if (isset($_POST['vid']) && isset($_POST['name']) && isset($_POST['batchno']) )
			$query = "INSERT INTO te(ID,Medname,MedBatchno) VALUES ( '".$_POST['vid']."','".$_POST['name']."','".$_POST['batchno']."')";
		if (isset ($query))
			$sql = mysql_query($query,$con);
		if (isset ($sql))
		if (!$sql)
		{
			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
		}
		if (isset($_POST['vid']) && isset($_POST['name']) && isset($_POST['batchno']) && isset($_POST['qty']) && isset($_POST['sid']) && isset($_POST['date']) )
			$query = "INSERT INTO supplied(XID,Medname,MedBatchno,Qty,SSID,Date) VALUES( '".$_POST['vid']."','".$_POST['name']."','".$_POST['batchno']."','".$_POST['qty']."','".$_POST['sid']."','".$_POST['date']."')";
		if (isset ($query))
			$sql = mysql_query($query,$con);
		if (isset ($sql))
		if (!$sql)
		{
			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
		}	
		//unset($_POST['sid']);
	}
	
		else
		{
			echo"<script>alert('Store does not exist!');</script>";
		}
	}
?>
</body>
</html>