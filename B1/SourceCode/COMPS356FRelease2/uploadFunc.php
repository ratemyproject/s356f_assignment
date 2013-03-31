<html>
<head>
<link rel="stylesheet" type="text/css" href="menberpanelmenu.css">
<link rel="stylesheet" type="text/css" href="">
<title>Member Panel - ONLINE Restaurant</title>
</head>

<body>
<div id="header">
<h1><a href="index.php"><img src="image\icon.png" /></a></h1>

<div id="socialbuttton"><br/>
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>
</div>

<!--search bar(new version)-->
<div id="searchbar"><br/>
<form action="searchbox.php" style='margin:0px' method="GET">
搜尋 
<select name="district">
<option value="" selected>選擇地區</option>
<option value="all">--全香港--</option>
<option value="香港島">-香港島-</option>
<option value="太平山">太平山</option>
<option value="九龍">-九龍-</option>
<option value="觀塘">觀塘</option>
<option value="深水埗">深水埗</option>
<option value="新界">-新界-</option>
<option value="屯門">屯門</option>
</select>

<select name="keywordstype">
<option value="name" selected>名稱</option>
<option value="address">地址</option>
<option value="tel">電話</option>
</select>

<input type="text" name="keyword"></input>
<button type="submit">submit</button>
</form>
</div>
</div>

<div id="container">
<?php 
session_start();
require_once("mysql_connection.php");
// Make sure the user actually
// selected and uploaded a file
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

// Temporary file name stored on the server
$tmpName = $_FILES['image']['tmp_name'];
$size = $_FILES['image']['size'];
$sql = "select rid from restaurants where owner = '".$_SESSION['username']."'";
$result = mysql_query($sql);
$rid = mysql_result($result, 0);
$type =  $_FILES['image']['type'];
// Read the file
$fp = fopen($tmpName, 'r');
$data = fread($fp, filesize($tmpName));
$data = addslashes($data);
fclose($fp);


// Create the query and insert
// into our database.
$query = "INSERT INTO images (rid, size, type, image) VALUES ('$rid', '$size', '$type', '$data')";
$results = mysql_query($query) or die ("query error");

// Print results
echo "<p>Thank you, your file has been uploaded.<p>";

}
else {
echo "<p>No image selected/uploaded<p>";
}
mysql_close();
?>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>
</div>
</body>

<!--social button-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$('#upload').load('uploadFunc.php'); 
</script>
</html> 