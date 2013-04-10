<?php
    session_start();
?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="vieworder_style.css">
<link rel="stylesheet" type="text/css" href="menberpanelmenu.css" />
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
border-radius:21px 21px 0 0;">Restaurant View Order</h2>
<?php 
    include ('mysql_connection.php');
    $user = $_SESSION['username'];
	$sql = "select rid from restaurants where owner = '".$user."'";
	$result = mysql_query($sql);
	$rowid = mysql_fetch_row($result);
    $sql = "select * from `order` where restid ='".$rowid[0]."' order by orderid";
	$resultmain = mysql_query($sql);
     if (mysql_num_rows($resultmain) <= 0) {
	    echo "<p> No record is found.</p>";
	} else {	
	$count = 0;
	$sqlordercount = "select count(distinct orderid) as idTotal from `order` where restid ='".$rowid[0]."'";
	$resultordercount = mysql_query($sqlordercount);
	$ordercount= mysql_result($resultordercount, 0);
	$sqlstart = "select min(orderid) as minId from `order` where restid ='".$rowid[0]."'";
	$startorder = mysql_result(mysql_query($sqlstart), 0);
	$sqlend = "select max(orderid) as maxId from `order` where restid ='".$rowid[0]."'";
	$endorder = mysql_result(mysql_query($sqlend), 0);
    
	while ($rows = mysql_fetch_array($resultmain)) {
	    if ($rowid[0] == $rows['restid']) {
	    $sqlrest = "select rname from restaurants where rid = '".$rows['restid']."'";
		if (preg_match('/^[FD]/',$rows['foodid']) == 1) {
			$sqlfood = "select food from menu where foodid = '".$rows['foodid']."' and restaurantid = '".$rows['restid']."'";
		} else {
			$sqlfood = "select name from setmenu where setMenuId = '".$rows['foodid']."' and restaurantid = '".$rows['restid']."'";
		}
		$sqldistrict = "select district from restaurants where rid = '".$rows['restid']."'";
		$rest[$count] = mysql_result(mysql_query($sqlrest), 0);
		$foodResultArray = mysql_fetch_array(mysql_query($sqlfood));
		$food[$count] = $foodResultArray[0];
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
	$statusCount = 0;
	do {
	    if ($count <= $max ) {
		$sqlstatus = "select distinct`status` from `order` where `restid` = '".$rowid[0]."' and `orderid` = '".$orderid[$count]."'";
		$resultt = mysql_query($sqlstatus);
		$statusResultArray = mysql_fetch_array($resultt);
		$status[$statusCount] = $statusResultArray[0];
		$statusCount = $statusCount + 1;
	    echo "<table>";
		echo "<tr>";
		echo "<th id='th1'>Order ID: ".$orderid[$count]." </th>
			  <th id='th1' colspan='2'>Order Time: ".$date[$count]." </th>
			  <th id='th1'>Total: $".$total[$count]." </th>";
			  
		echo "</tr>";
		echo "<tr>";
		echo "<th colspan='4' align='left'>Address To Be Delivered: ".$address[$count]."<br></br></th>";
		echo "<th colspan='4' align='left'>Order Status: ".$status[$statusCount-1]."<br></br></th>";
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
		if (strcmp($status[$statusCount-1], 'waiting')==0) {
			echo "<tr>";
			echo "<td>";
			
			echo "<form action = 'restOrderCon.php' method = 'post'>
				  <input type = 'hidden' name = 'stat' value = 'accept'/>
				  <input type = 'hidden' name = 'id' id = 'button' value = '".$orderid[$count-1]."'/>

				  <input type = 'submit' value = 'accept' />
				  </form> </td>";
			echo "<td><form action = 'restOrderCon.php' method = 'post'>
				  <input type = 'hidden' name = 'stat' value = 'decline'/>
				  <input type = 'hidden' name = 'id' id = 'button' value = '".$orderid[$count-1]."'/>

				  <input type = 'submit' value = 'decline' />
				  </form> </td> </tr>";
		}
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

	echo "<a href='memberpanel.php'>back</a>";
	    
?>	
<div id="footer">
<p>Copyright@CLOUD</p>
</div>
</div>
</body>

<!--social button-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
</html> 