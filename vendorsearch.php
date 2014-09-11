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
<h2>Search Vendors Details on basis of:</h2>
<br />
<center>
<form method="POST" #action="http://www.google.com/search">
<table>
<tr>
<td><input type="radio" name="vid" > Vendor ID </td>
<td><input type="radio" name="vname" > Vendor Name </td>
</table>
<br />
<div style="border:2px dotted blue;padding:4px;width:15em;">
<table border="0" align="center" cellpadding="0">
<tr><td>
<input type="text"  name="MID" size="25" style="color:#808080;" maxlength="255" placeholder="Search by ID or Name"/>
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
	if (isset($_POST['vid']) && isset($_POST['vname']))
	{
		header("Location:vendorsearch.php");
	}	
	else if(isset($_POST['MID']) && isset($_POST['vid']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Vendor ID!');</script>";
		}
		else
		{
		$query = "SELECT ID,Name,Area,Sex FROM vendors WHERE ID=".$_POST['MID'].";";
		}
	}
	else if(isset($_POST['MID']) && isset($_POST['vname']))
	{
		if ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['MID']))
		{
			echo "<script>alert('Enter valid Vendor Name!');</script>";
		}
		else
		{
		$query = "SELECT ID,Name,Area,Sex  FROM vendors WHERE Name LIKE '%".$_POST['MID']."%'";
		}
	}
	
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		//echo "2";
		while($row = mysql_fetch_array($sql))
		{
		//echo "3";
		echo("<address>
				<p>".$row['Name']."</p>
			</address>");
		echo("<table class=meta>
				<tbody><tr>
					<th><span>Vendor ID</span></th>
					<td><span>".$row['ID']."</span></td>
				</tr>
				<tr>
					<th><span>Vendor Name</span></th>
					<td><span>".$row['Name']."</span></td>
				</tr>
			</tbody></table>");
				echo("<table class=inventory>
				<thead><tr>
						<th COLSPAN=5><span>Vendor Details</span></th></tr>
				</thead>
				<tbody>");
				$new = $row['Area'];
				echo("<tr>
						<td><span>Area:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Sex'];
				echo("<tr>
						<td><span>Sex:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				/*$new = $row['Date'];
				echo("<tr>
						<td><span>Date:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Batchno'];
				echo("<tr>
						<td><span>Medicine Batchno:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Name'];
				echo("<tr>
						<td><span>Medicine Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['Price'];
				echo("<tr>
						<td><span>Price:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['ExpiryDate'];
				echo("<tr>
						<td><span>ExpiryDate:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");*/
		}
		
	if(isset($_POST['MID']) && isset($_POST['vid']))
	{
		$query = "SELECT Medname,MedBatchno,Qty,SSID,Date,Price FROM supplied JOIN medicines ON supplied.Medname=medicines.Name AND supplied.MedBatchno = medicines.Batchno WHERE XID=".$_POST['MID'].";";
	}
	else if(isset($_POST['MID']) && isset($_POST['vname']))
	{
		$query1 = "Create view temp(ID,MedBatchno,Medname,Qty,Date,SSID) AS SELECT ID,MedBatchno,Medname,Qty,Date,SSID FROM supplied JOIN vendors ON supplied.XID = vendors.ID WHERE vendors.Name LIKE '%".$_POST['MID']."%'";
		if (isset ($query1))
		{
			//echo "1";
			$sql = mysql_query($query1,$con);
		}
		if(isset($sql))
			$query = "SELECT Medname,MedBatchno,Qty,Date,SSID,Price FROM temp JOIN medicines ON temp.Medname = medicines.Name AND temp.MedBatchno=medicines.Batchno";
	}
	if (isset ($query))
	{
		//echo "1";
		$sql = mysql_query($query,$con);
	}
	if (isset($sql))
	{
		//echo "2";
		while($row = mysql_fetch_array($sql))
		{
				$new = $row['Medname'];
				echo("<tr>
						<td><span>Medicine Name:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['MedBatchno'];
				echo("<tr>
						<td><span>Medicine Batch no:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				$new = $row['Qty'];
				echo("<tr>
						<td><span>Quanity:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
				
				$new = $row['Date'];
				echo("<tr>
						<td><span>Date of exporting:</span></td>
						<td COLSPAN=4>$new</td>
					</tr>");
					$new = $row['SSID'];
				echo("<tr>
						<td><span>Store ID:</span></td>
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
?>
	</tbody>
	</table>
	</article>
</body>
</html>