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
<h2>Search Customer Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="custid" > Customer ID </td>
<td><input type="radio" name="custname" > Customer Name </td>
</table>
<br />
<div style="border:2px dotted blue;padding:4px;width:15em;">
<table border="0" align="center" cellpadding="0">
<tr><td>
<input type="text"  name="CID" size="25" style="color:#808080;" maxlength="255" placeholder="Search by ID or Name"/>
<input type="submit" value="Go!" />
</td></tr>
</table>
</div>
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
	if (isset($_POST['custid']) && isset($_POST['custname']))
	{
		echo "<script>alert('Select one field only!');</script>";
	}	
	else if(isset($_POST['CID']) && isset($_POST['custid']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['CID']))
		{
			echo "<script>alert('Enter valid Customer ID!');</script>";
		}
		else
		{
		$query = "SELECT CID,Fname,Mname,Lname,Sex,Age FROM customer WHERE CID=".$_POST['CID'].";";
		}
	}
	else if(isset($_POST['CID']) && isset($_POST['custname']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['CID']))
		{
			echo "<script>alert('Enter valid Customer name!');</script>";
		}
		else
		{
		$query = "SELECT CID,Fname,Mname,Lname,Sex,Age FROM customer  WHERE Fname LIKE '%".$_POST['CID']."%' OR Mname LIKE '%".$_POST['CID']."%' OR Lname LIKE '%".$_POST['CID']."%'";
		}
	}
	
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		$row = mysql_fetch_array($sql);
		if(!empty($row))
	{
		$sql = mysql_query($query,$con);
		while($row = mysql_fetch_array($sql))
		{
			//echo "3";
			echo("<table class=meta>
				<tbody><tr>
					<th><span>Customer ID</span></th>
					<td><span>".$row['CID']."</span></td>
				</tr>
				<tr>
					<th><span>Name</span></th>
					<td><span>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</span></td>
				</tr>
			</tbody></table>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Customer Details</span></th></tr>
				</thead>
				<tbody>");
				
				$new = $row['Sex'];
				if($new == "M")
					$new1 = "Male";
				else
					$new1 = "Female";
				echo("<tr>
						<td><span>Gender:</span></td>
						<td COLSPAN=4>$new1 </td>
					</tr>");
					$new = $row['Age'];
				echo("<tr>
						<td><span>Age:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				/*$new = $row['Medname'];
				echo("<tr>
						<td><span>Medname:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['MedBatchno'];
				echo("<tr>
						<td><span>MedBatchno:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Qty'];
				echo("<tr>
						<td><span>Qty:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Date'];
				echo("<tr>
						<td><span>Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");*/
		}
			if(isset($_POST['custid']))
				$query = "SELECT Medname,MedBatchno,Qty,Price,SSID FROM customermedicine WHERE CCID=".$_POST['CID'].";";
			else
				$query = "SELECT Medname,MedBatchno,Qty,Price,SSID FROM customermedicine JOIN customer ON customer.CID = customermedicine.CCID WHERE Fname LIKE '%".$_POST['CID']."%' OR Mname LIKE '%".$_POST['CID']."%' OR Lname LIKE '%".$_POST['CID']."%'";
			if(isset($query))
			{
				$sql = mysql_query($query,$con);
			}
			if(isset($sql))
			{
				$flag ="1";
				while($row = mysql_fetch_array($sql))
				{
				if($flag)
				{
					$new = $row['SSID'];
					echo("<tr>
						<td><span>Store ID:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$flag = "0";
				}
				$new = $row['Medname'];
				echo("<tr>
						<td><span>Medname:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['MedBatchno'];
				echo("<tr>
						<td><span>MedBatchno:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Qty'];
				echo("<tr>
						<td><span>Quantity:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				}
			}
	}	
		else
			if(isset($_POST['custid']))
			echo"<script>alert('Enter valid Customer ID !');</script>";
			else if(isset($_POST['custname']))
			echo"<script>alert('Enter valid Customer Name !');</script>";
	}
?>
	</tbody>
	</table>
	</article>
</body>
</html>