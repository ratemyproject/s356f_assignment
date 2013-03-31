<?php
    session_start();
?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="vieworder_style.css">
<title>View Order - ONLINE Restaurant</title>
</head>

<body>
<div id="header">

<div id="logo"><a href="index.php"><img src="image\icon.png" /></a></div>


<div id="login">
  <?php
if (!isset($_SESSION['username'])) {
echo "<a href='login.html'>Login </a>|<a href='reg.php'> New Members </a>";
}else echo "Welcome <a href='memberpanel.php'>".$_SESSION['username']."</a> you come back! | <a href='logout.php'>Logout</a>";
?>
|<a href=''> Mobile</a></br>
</div>


 </div>


<div id="container">
<h2 style="background-color:#8A4117;
margin-top: 0;
margin-bottom:0;
color:white;
text-align:center;
border-style:solid;
border-color:#8A4117;
border-radius:21px 21px 0 0;">View Order</h2>
<?php 
    include ('mysql_connection.php');
    $user = $_SESSION['username'];
    $sql = "select * from `order` where userid ='".$user."' order by orderid";
	$result = mysql_query($sql);
     if (mysql_num_rows($result) <= 0) {
	    echo "<p> No record is found.</p>";
	} else {	
	$count = 0;
	$sqlordercount = "select count(distinct orderid) from `order` where userid ='".$user."'";
	$resultordercount = mysql_query($sqlordercount);
	$ordercount= mysql_result($resultordercount, 0);
	$sqlstart = "select min(orderid) from `order` where userid ='".$user."'";
	$startorder = mysql_result(mysql_query($sqlstart), 0);
	$sqlend = "select max(orderid) from `order` where userid ='".$user."'";
	$endorder = mysql_result(mysql_query($sqlend), 0);
    
	while ($rows = mysql_fetch_array($result)) {
	    if ($user == $rows['userid']) {
	    $sqlrest = "select rname from restaurants where rid = '".$rows['restid']."'";
		$sqlfood = "select food from menu where foodid = '".$rows['foodid']."' and restaurantid = '".$rows['restid']."'";
		$sqldistrict = "select district from restaurants where rid = '".$rows['restid']."'";
		$sqlstatus = "select distinct`status` from `order` where `userid` = '".$user."'";
		$resultt = mysql_query($sqlstatus);
		$status[$count] = mysql_result($resultt, 0);
		$rest[$count] = mysql_result(mysql_query($sqlrest), 0);
		$food[$count] = mysql_result(mysql_query($sqlfood), 0);
		$district[$count] = mysql_result(mysql_query($sqldistrict), 0);
		$orderid[$count] = $rows['orderid'];
		$address[$count] = $rows['address'];
		$quantity[$count] = $rows['quantity'];
		$total[$count] = $rows['total'];
		$date[$count] = $rows['date'];
		$userrecord[$count] = $rows['userid'];
		
		}
		$count++;	
	}	
	$max = $count-1;
   
	$count = 0;
	do {
	    if ($count <= $max ) {
		$sqlstatus = "select distinct`status` from `order` where `userid` = '".$user."' and orderid = '".$orderid[$count]."'";
		$resultt = mysql_query($sqlstatus);
		$status[$count] = mysql_result($resultt, 0);
	    echo "<table>";
		echo "<tr>";
		echo "<th id='th1'>Order ID: ".$orderid[$count]." </th>
			  <th id='th1' colspan='2'>Order Time: ".$date[$count]." </th>
			  <th id='th1'>Total: $".$total[$count]." </th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th colspan='4' align='left'>Address: ".$address[$count]."<br></br></th>";
		echo "<th colspan='4' align='left'>Order Status: ".$status[$count]."<br></br></th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Restaurant</th><th>District</th><th>Food Name</th><th>Quantity Ordered</th>";
		echo "</tr>";
		
	    do {
            
	        echo "<tr style='text-align:center'>";
		    echo "<td>".$rest[$count]."</td><td>".$district[$count]."</td><td>".$food[$count]."</td><td>".$quantity[$count]."</td>";
	        echo "</tr>";
		    $count++;
			
	    } while ($count <= $max && $orderid[$count] == $startorder && $userrecord[$count] == $user);
	    echo "</table>";
		echo "<img src='image\Seperateline.png' style='margin:0 0 30px 0'>";
		echo "<br />";
		if ($count > $max)
		    $count=$max;
		do {
		    $startorder++;
		} 	while ($startorder < $orderid[$count]) ;
		
		}

	    } while ($startorder <= $endorder);
    }
	echo "<form action=memberpanel.php>";
	echo "<input type='submit' value='Back' id='button'/>";
	echo "</form>";
	    
?>	

</div>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>

</body>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "5e507c8c-3aff-49e9-ab59-b2cc1ec3ba77", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
 
<script src="http://w.sharethis.com/button/buttons.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
// Popup window code
// register
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=400,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>

<!---search box function-->


</html> 