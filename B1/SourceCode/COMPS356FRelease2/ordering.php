<?php 
    session_start();
?>
<html>

<head>
<link rel="stylesheet" type="text/css" href="index.css">
<title>ONLINE Restaurant</title>
</head>

<body>
<div id="header">
<h1><a href="index.php"><img src="image\icon.png" /></a></h1>


<div id="container">

<?php 
    include("mysql_connection.php"); 
	date_default_timezone_set('Asia/Hong_Kong');
	$date = strftime("%c",$_SERVER['REQUEST_TIME']);
    $user = $_SESSION['username'];
	$restid = $_POST['restid'];
	$address = $_POST['address'];
	if(!empty($address)){
	/* no branch id
	$branchid = $_POST['branchid'];*/
    $total = $_POST['total'];
    $sql = 'select foodid from menu where restaurantid = "'.$restid.'"';
    $result = mysql_query($sql);
    $orderid = 0;
	$temporderid = 0;
    $sqlorderid = "SELECT `orderid` FROM `order` WHERE 1";
	$orderdet = mysql_query($sqlorderid);
    $error = 0;
	while ($roworderdet = mysql_fetch_array($orderdet)) {
	    if ($temporderid == $roworderdet['orderid']) 
		    $temporderid++;
	}	
	$orderid = $temporderid;

	while ($row1 = mysql_fetch_array($result)) {

	    $incoming[$row1[0]] = $_POST['F'.$row1[0].''];
	    if ($incoming[$row1[0]] > 0) {
		    $sqlenter = 'INSERT INTO `order`(`orderid`, `userid`, `restid`, `foodid`, `quantity`, `address`, `total`, `date`, `status`) VALUES ("'.$orderid.'", "'.$user.'", "'.$restid.'", "'.$row1[0].'", "'.$incoming[$row1[0]].'" , "'.$address.'", "'.$total.'", "'.$date.'", "waiting") ';
			if (mysql_query($sqlenter)) 
			   $error = 0;
		    else   
			   $error = 1;
		}	
	}
	if ($error == 0) {
	    echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Your ordering has been completed! Redirecting to Member Panel in 5 seconds...</p>";
 	    echo '<meta http-equiv=REFRESH CONTENT=5;url=memberpanel.php>';
    } else {
        echo 'Something went wrong...Try your order later';
		//echo '<meta http-equiv=REFRESH CONTENT=3;url=homepage.php>';	
    }	
    }else {
		echo "address cannot empty"; 	
		header("refresh:3;url=sr.php?rid=".$restid);
		}
?>	
</div>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>

</body>

<!--social botton-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

</html> 