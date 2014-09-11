<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title> Select Option </title>

</head>
<body style="background-color:skyblue">
	<hr />
	<center> <h2> What do u want to do? </h2> </center>	
	<hr />
	<center>
	<form #action="details.php"  method = "post">
	<table>
	<tr>
	<td> <br /> <input type="radio" name="medentry" value="medentry"> Enter Details of Medicine </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="medentrycom" value="medentrycom"> Enter Details of Medicines Produced by Companies </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="medentryven" value="medentryven"> Enter Details of Medicines Supplied by Vendors </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="customer" value="customer"> Enter Details of Customer </td>
	</tr>
	<tr>
	<td> <br /><h3> Choose an option to view details of: </h3></td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="manager" value="manager"> Manager </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="managed" value="managed"> Store Managed by Given Manager </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="storedet" value="storedet"> Store Details </td>
	</tr>
	<tr>
	<td> <br /> <input type="radio" name="storedetloc" value="storedetloc"> Store Details at given Location</td>
	</tr>
	</table>
	<br /><br /><input type ="submit" value="Proceed">
	</form>
	</center>
<?php
		if(isset($_POST['medentry']))
			header ("Location:medicine.php");
		if(isset($_POST['medentrycom']))
			header ("Location:company.php");
		if(isset($_POST['medentryven']))
			header ("Location:vendor.php");
		if(isset($_POST['customer']))
			header ("Location:customer.php");
?>
</body>
</html>