<?php
    session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="menberpanelmenu.css">
<link rel="stylesheet" type="text/css" href="index.css">
<title>Member Panel - ONLINE Restaurant</title>
</head>

<body>
<div id="header">
<h1><a href="index.php"><img src="image\icon.png" /></a></h1>


</div>


<div id="container">
<?php
    include("mysql_connection.php");
	    $id = $_SESSION['username'];
        if ($type = $_SESSION['rest'] == 1) {
			$stat = $_POST['stat'];
			$id = $_POST['id'];
			$sql = "UPDATE  `order` SET  `status` =  '".$stat."' WHERE  `orderid` =  '".$id."'";
			if (mysql_query($sql)) 
				    $error = 0;
				else 
				    $error = 1;	
            if ($error == 0) {
                echo "<p>Order Status Changed!</p>";
                echo "<a href='memberpanel.php'>back</a>";	
            } else {
                echo "<p>Something goes wrong...Try Later</p>";
                echo "<a href='memberpanel.php'>back</a>";
            }				  
		} else {
		    echo "<p>You are not Restaurant-Type user!</p>";
            echo "<a href='memberpanel.php'>back</a>";
		}		  
 
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