<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Customer Details </title>

</head>
<body style="background-color:skyblue">
	<hr />
	<center> <h2> Customer Details </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<br />
	<table>
	<tr>
	<td><br />Customer ID. &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="cid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />First Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="fname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Middle Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="mname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Last Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="lname" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Age &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="age" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br /> Sex &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="sex" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Meicine Name &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="name" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Store id &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="sid" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br /> Buying Date &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="date" /><font color="RED" SIZE="2">*(yyyy-mm-dd)</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	<tr>
	<td><br />Quantity &nbsp &nbsp &nbsp </td>
	<td><br /><input type="name" name="qty" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
	</tr>
	
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
	if (isset($_POST['cid']) && isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && isset($_POST['age']) && isset($_POST['sex']))
	{
			$query = "INSERT INTO customer(CID,Fname,Mname,Lname,Age,Sex) VALUES ('$_POST[cid]','$_POST[fname]','$_POST[mname]','$_POST[lname]','$_POST[age]','$_POST[sex]')";
	}
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset($sql))
	{
		$cmp = $_POST['date'];
		$query12 = "SELECT Batchno,Name FROM medicines WHERE ExpiryDate < '$cmp'";
		if(isset($query12))
		{
			$sql12 = mysql_query($query12,$con);
		}
		if(isset($sql12))
		{
			$store = $_POST['sid'];
			while($row = mysql_fetch_array($sql12))
			{
				$name = $row['Name'];
				$batch = $row['Batchno'];
				$query13 = "DELETE FROM contains WHERE Medname='$name' AND Medbatchno = '$batch' AND SSID = '$store'";
				$query14 = "DELETE FROM medicines WHERE Name='$name' AND Batchno = '$batch'";
				if(isset($query13))
					mysql_query($query13,$con);
				if(isset($query14))
					mysql_query($query14,$con);
			}
		}
		$ssid = $_POST['sid'];
		$query = "SELECT * FROM contains WHERE SSID ='$ssid'";
		if(isset($query))
		{
			$sql = mysql_query($query,$con);
		}
		$row = mysql_fetch_array($sql);
		if(empty($row))
				echo "<script>alert('Store does not contain this medicine!');</script>";
		else
	{
		$query = "SELECT SUM(Qty) FROM contains GROUP BY '$ssid'";
	$sql = mysql_query($query,$con);
	$row = mysql_fetch_array($sql);
	if(empty($row))
		echo "<script>alert('Store does not contain this medicine!');</script>";
	else
	{
	if($row['SUM(Qty)'] >= $_POST['qty'])
	{
	if (isset($_POST['cid']) && isset($_POST['name']) && isset($_POST['sid']) && isset($_POST['qty']) && isset($_POST['date']))
		{		$query = "select * from contains JOIN medicines on contains.Medname=medicines.Name AND contains.Medbatchno=medicines.Batchno where Medname like '%".$_POST['name']."%' and SSID = ".$_POST['sid']." and Qty = ".$_POST['qty'].";";
			$sql = mysql_query($query,$con);
			$row = mysql_fetch_array($sql);
			if($row)
			{
				/*calculate price*/
				$cid = $_POST['cid'];
				$name = $_POST['name'];
				$qty = $_POST['qty'];
				$date = $_POST['date'];
				$price = $row['Price'] * $qty;
				mysql_query("insert into customermedicine(CCID,Medname,MedBatchno,Qty,Price,SSID,Buyingdate) values('$cid','$name','$row[Medbatchno]','$qty','$price','$row[SSID]','$date');",$con);
				mysql_query("delete from contains where Medname like '%".$_POST['name']."%' and SSID = ".$_POST['sid']." and Qty = ".$_POST['qty'].";",$con);
				mysql_query("DELETE FROM medicines WHERE Name LIKE '%".$_POST['name']."%' AND Batchno=".$row['Medbatchno'].";",$con);
				///////// write medicine code
			}
			else
			{
				$flag = "1";
				$query = "select * from contains JOIN medicines on contains.Medname=medicines.Name AND contains.Medbatchno=medicines.Batchno where Medname like '%".$_POST['name']."%' and SSID = ".$_POST['sid'].";";
				$sql = mysql_query($query,$con);
				while($row = mysql_fetch_array($sql))
				{
					$cid = $_POST['cid'];
					$name = $_POST['name'];
					$qty = $_POST['qty'];
					$date = $_POST['date'];
					//echo "djh";
					if($flag)
					{
						$new = $row['Qty'];
						$new = $new - $_POST['qty'];
						if($new > "0")
						{
							$price = $row['Price'] * $qty;
							mysql_query("insert into customermedicine(CCID,Medname,MedBatchno,Qty,Price,SSID,Buyingdate) values('$cid','$name','$row[Medbatchno]','$qty','$price','$row[SSID]','$date');",$con);
							mysql_query("UPDATE contains set Qty = $new WHERE Medname LIKE '%".$_POST['name']."%' AND Medbatchno=".$row['Medbatchno'].";",$con);
							$flag = "0";
						}
						else if($new < "0")
						{
							$price = $row['Price'] * $row['Qty'];
							mysql_query("insert into customermedicine(CCID,Medname,MedBatchno,Qty,Price,SSID,Buyingdate) values('$cid','$name','$row[Medbatchno]','$row[Qty]','$price','$row[SSID]','$date');",$con);
							mysql_query("DELETE FROM contains WHERE Medname LIKE '%".$_POST['name']."%' AND Medbatchno=".$row['Medbatchno'].";",$con);
							mysql_query("DELETE FROM medicines WHERE Name LIKE '%".$_POST['name']."%' AND Batchno=".$row['Medbatchno'].";",$con);
							$_POST['qty'] = $_POST['qty'] - $row['Qty'];
						}
						else if($new == "0")
						{
							$price = $row['Price'] * $row['Qty'];
							mysql_query("insert into customermedicine(CCID,Medname,MedBatchno,Qty,Price,SSID,Buyingdate) values('$cid','$name','$row[Medbatchno]','$row[Qty]','$price','$row[SSID]','$date');",$con);
							mysql_query("DELETE FROM contains WHERE Medname LIKE '%".$_POST['name']."%' AND Medbatchno=".$row['Medbatchno'].";",$con);
							mysql_query("DELETE FROM medicines WHERE Name LIKE '%".$_POST['name']."%' AND Batchno=".$row['Medbatchno'].";",$con);
							$flag ="0";
						}
					}
				}
			}
		}			
	}
	
	else
	{
				echo "<script>alert('Store does not contain required amount of medicine!');</script>";
				$query = "select * from contains JOIN medicines on contains.Medname=medicines.Name AND contains.Medbatchno=medicines.Batchno where Medname like '%".$_POST['name']."%' and SSID = ".$_POST['sid'].";";
				$sql = mysql_query($query,$con);
				$cid = $_POST['cid'];
				$name = $_POST['name'];
				$date = $_POST['date'];
				while($row = mysql_fetch_array($sql))
				{
					$price = $row['Price'] * $row['Qty'];
					mysql_query("insert into customermedicine(CCID,Medname,MedBatchno,Qty,Price,SSID,Buyingdate) values('$cid','$name','$row[Medbatchno]','$row[Qty]','$price','$row[SSID]','$date');",$con);
					mysql_query("DELETE FROM contains WHERE Medname LIKE '%".$_POST['name']."%' AND Medbatchno=".$row['Medbatchno'].";",$con);
					mysql_query("DELETE FROM medicines WHERE Name LIKE '%".$_POST['name']."%' AND Batchno=".$row['Medbatchno'].";",$con);
				}
				//$flag ="0";
	}
			header ("Location:option.php");
	}
	}
	}
	else
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";		
	}
	?>
	</table>
	<br /><br /><input type ="submit" value="Submit">
	</center>
	</form>
</body>
</html>
	