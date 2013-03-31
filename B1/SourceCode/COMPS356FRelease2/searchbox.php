<?php
require_once("mysql_connection.php");
session_start();
	
$district = $_GET['district'];
$keywordstype = $_GET['keywordstype'];
$keywords = $_GET['keyword'];

function imglink($rid,$rname){
$sql = "SELECT rlogo from restaurants where rid = '$rid'";
$result = mysql_query($sql);
$rlogo = mysql_result($result, 0);
$path = "temporary/";
return "<img src='".$path.$rlogo."' alt='$rname' style='width:150px; height:150px'/>";
}


if($keywordstype == 'name'){
	if(!empty($keywords) && !empty($district) && $district != 'all' ){
		$sql = "SELECT * FROM restaurants WHERE district ='".$district."'and rname like '%".$keywords."%' ORDER BY rid";
	}
	else if(empty($keywords) && !empty($district) && $district != 'all'){
		$sql = "SELECT * FROM restaurants WHERE district ='".$district."' ORDER BY district";
	}
	else if(!empty($keywords) && (empty($district) || $district != 'all')){
		$sql = "SELECT * FROM restaurants WHERE rname like '%".$keywords."%'ORDER BY rname"; 
	}
}else if($keywordstype == 'address'){
	if(empty($keywords)){
		$sql = "SELECT * FROM restaurnts ORDER BY district";
	}
	else $sql = "SELECT * FROM restaurants WHERE raddr like '%".$keywords."%' ORDER BY rid";
}else if($keywordstype == 'tel'){
	if(empty($keywords)){
		$sql = "SELECT * FROM restaurnts ORDER BY rtel";
	}
	$sql = "SELECT * FROM restaurants WHERE rtel like '%".$keywords."%' ORDER BY rid";
}

  $result = mysql_query($sql);
?>
  
<html>

<head>
<link rel='stylesheet' type='text/css' href='index.css'>";
<title>Order Food - Search result</title>
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

<div id="share">
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_email_large' displayText='Email'></span>
</div>

<!--search bar(new version)-->
<div id="search">

		<form action="searchbox.php" method="GET">
		Search<select name="district">
		<option value="" selected>Select District</option>
		<option value="all">--Hong Kong--</option>
		<option value="Hong Kong Island">-Hong Kong Island-</option>
		<option value="The Peak">The Peak</option>
		<option value="Kowloon">-Kowloon-</option>
		<option value="Kwun Tong">Kwun Tong</option>
		<option value="Sham Shui Po">Sham Shui Po</option>
		<option value="New Territories">-New Territories-</option>
		<option value="Tuen Mun">Tuen Mun</option>
		</select>

<select name="keywordstype">
<option value="name" selected>Name</option>
<option value="address">Address</option>
<option value="tel">Telephone</option>
</select>

<input type="text" name="keyword"></input>
<button type="submit">submit</button>
</form>

</div>
</div>

<div id='container'>
<div id="recommendation">
<h2>Search result(s)</h2>
<?php
if(mysql_num_rows($result) == 0){
	echo "Sorry，There are no results match。</br>";
	echo "You may use the following method to search again<ul><li><a href=''>Advanced search</a></li></ul>";
}
else{
	$count = 0;
	while($row = mysql_fetch_assoc($result)) {
	echo "<div id='rest".$count."'>";
	echo imglink($row['rid'],$row['rname']);
	echo "<div class='randomcontent'><ul style='list-style-type:none'>";
	echo "<li><b>".$row['rname']."</b></li>";
	echo "<li> District: ".$row['district']."</li>";
	echo "<li> Telphone: ".$row['rtel']."</li>";
	echo "<li> Address: ".$row['raddr']."</li>";
	echo "<li><a href='sr.php?rid=".$row['rid']."'>view menu</a></li></ul></div>";
	echo "</div>";
	$count++;
}
}
?>
</div>
</div>
<div id='footer'>
<p>Copyright@CLOUD</p>
</div>
</body>

<script type='text/javascript'>var switchTo5x=true;</script>
<script type='text/javascript' src='http://w.sharethis.com/button/buttons.js'></script>

<script src='http://w.sharethis.com/button/buttons.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

</html>