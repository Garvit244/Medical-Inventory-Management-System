<!DOCTYPE html>
<html>
<body>
<hr>
<body style="background-color:skyblue"><h1 align="center">Company Details</h1>
<hr>
<center>
<form #action="companysubmit.php" method = "post">

<table>
<tr>
<td><br />ID &nbsp &nbsp &nbsp </td>
<td><br /><input type="text" name="ID" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td>
</tr>
<tr>
<td><br />Name &nbsp &nbsp &nbsp </td>
<td><br /><input type="text" name="Name" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td></tr>
<tr><td><br />Location &nbsp &nbsp &nbsp </td>
<td><br /><input type="text" name="Location" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
</tr>
<tr>
<td><br /> Medicine Name &nbsp &nbsp &nbsp </td>
<td><br /><input type="text" name="MedicineName" /><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td></tr>
<tr>
<td><br />Batch No. &nbsp &nbsp &nbsp </td>
<td><br /><input type="text" name="BatchNo"><font color="RED" SIZE="2">*</font>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td></tr> 
<tr></td><td> <br />Date &nbsp &nbsp &nbsp </td>
<td> <br /><input type="text" name="ExpiryDate" /> <font color="RED" SIZE="2">*(yyyy-mm-dd)</font></td>
</tr>
</table>
<br /><input type="Submit" value="Submit"></center>
</form>

<?php
	$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die("Connection Failed");
	}
	if(!(mysql_select_db("employee_record", $con)))
	{
		die ("Database Not Selected");
	}
	if(isset($_POST['ID']) && isset($_POST['Name']) && isset($_POST['Location']) && isset($_POST['MedicineName']) && isset($_POST['BatchNo']) && isset($_POST['ExpiryDate']))
		$query = "INSERT INTO COMPANY(ID,Name,Location,MedicineName,BatchNo,Date)
            VALUES('$_POST[ID]','$_POST[Name]','$_POST[Location]','$_POST[MedicineName]','$_POST[BatchNo]','$_POST[ExpiryDate]')";
	if (isset ($query))
		$sql = mysql_query($query,$con);
	if (isset ($sql))
	if (!$sql)
	{
		echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<font size='2' color='red'>*Required Fields are Mandotary</font>";	
	}	
?>

</body>
</html>