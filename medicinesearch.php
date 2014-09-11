<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><style>article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio[controls],canvas,video{display:inline-block}[hidden],audio{display:none}mark{background:#FF0;color:#000}</style>
<style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
</style>

<script type="text/javascript" src="http://static.tumblr.com/p2evvtm/Wycm17d1m/tumblr_search_box.js"></script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title> Select Option </title>
<link rel="stylesheet" href="css/ret.css">
</head>
<body>
<header>
<h1>Search Details</h1>
</header>
<br />
<h2>Search Medicine Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="batchno" > Batchno </td>
<td><input type="radio" name="name" > Name </td>
<td><input type="radio" name="category" > Category </td>
</table>
<br />

<table border="0" align="center" cellpadding="0">
<td style="width:270px;">
<input type="text"  name="MID" size="80" style="color:#808080;" maxlength="255" placeholder="Search by Batchno,Name or Category of Medicine" /></td>
<tr style="border:none;"><td style="border:none;"><input type="submit" value="Go!" /></td></tr>
</td></tr>
</table>

</form>
</center>
<br />
<br /><br />
<br /><br/>
<article>
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
		echo "<script>alert('Select one field only!');</script>";
		//header("Location:medicinesearch.php");
	}	
	else if(isset($_POST['MID']) && isset($_POST['batchno']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Medicine Batchno!');</script>";
		}
		else
		{
		$query = "SELECT medicines.Batchno,medicines.Name,Price,ExpiryDate,Category FROM medicines JOIN medicinecategory ON medicines.Batchno = medicinecategory.Batchno AND medicines.Name = medicinecategory.Name WHERE medicines.Batchno=".$_POST['MID'].";";
		}
	}
	else if(isset($_POST['MID']) && isset($_POST['name']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Medicine Name!');</script>";
		}
		else
		{
		$query = "SELECT medicines.Batchno,medicines.Name,Price,ExpiryDate,Category FROM medicines JOIN medicinecategory ON medicines.Batchno = medicinecategory.Batchno AND medicines.Name = medicinecategory.Name WHERE medicines.Name LIKE '%".$_POST['MID']."%'";
		}
	}
	else if(isset($_POST['MID']) && isset($_POST['category']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Medicine Category!');</script>";
		}
		else
		{
		$query = "SELECT medicines.Batchno,medicines.Name,Price,ExpiryDate,Category FROM medicines JOIN medicinecategory ON medicines.Batchno = medicinecategory.Batchno AND medicines.Name = medicinecategory.Name WHERE medicinecategory.Category LIKE '%".$_POST['MID']."%'";
		}
	}
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		if(isset($_POST['name']))
		{
			$query2 = "SELECT Name,Category From medicinecategory WHERE Name LIKE '%".$_POST['MID']."%'";
			if(isset($query2))
			{
				$sql2 = mysql_query($query2,$con);
			}
			if(isset($sql2))
			{
				$row = mysql_fetch_array($sql2);
				echo("<address>
				<p>".$row['Name']."</p>
				</address>");
				//echo "Category:";
				echo("<table class=meta>
				<tbody><tr>
					<th><span>Name</span></th>
					<td><span>".$row['Name']."</span></td>
				</tr>
				<tr>
					<th><span>Category</span></th>
					<td><span>".$row['Category']."</span></td>
				</tr>
			</tbody></table>");
			}	
			while($row = mysql_fetch_array($sql))
			{
			//echo "3";
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Medicine Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['Batchno'];
				echo("<tr>
						<td><span>Batchno:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['ExpiryDate'];
				echo("<tr>
						<td><span>Expiry Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				
			}
		}
	else if(isset($_POST['batchno']))
	{
		while($row = mysql_fetch_array($sql))
		{
		//echo "3";
		echo("<table class=meta>
				<tbody><tr>
					<th><span>Batch no</span></th>
					<td><span>".$row['Batchno']."</span></td>
				</tr>
				<tr>
					<th><span>Name</span></th>
					<td><span>".$row['Name']."</span></td>
				</tr>
				</tbody></table>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Medicine Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['ExpiryDate'];
				echo("<tr>
						<td><span>Expiry Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['Category'];
					echo("<tr>
						<td><span>Category:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}
	}	
	else
	{
		echo("<address>
				<p>".$_POST['MID']."</p>
			</address>");
		while($row = mysql_fetch_array($sql))
		{
		//echo "3";
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Medicine Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['Batchno'];
				echo("<tr>
						<td><span>Batch no:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['Name'];
				echo("<tr>
						<td><span>Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['ExpiryDate'];
				echo("<tr>
						<td><span>Expiry Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
		}
	}
		$sql = mysql_query($query,$con);
		$row = mysql_fetch_array($sql);
		if(empty($row))
		{
			if(isset($_POST['batchno']))
			echo"<script>alert('Enter valid Medicine Batchno!');</script>";
			else 	if(isset($_POST['name']))
			echo"<script>alert('Enter valid Medicine Name!');</script>";
			else	if(isset($_POST['category']))
			echo"<script>alert('Enter valid Medicine Category!');</script>";
		}
	}
?>
	</tbody>
	</table>
	</article>
</body>
</html>