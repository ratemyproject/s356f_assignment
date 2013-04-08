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


<div id="container">
<?php
    include("mysql_connection.php");
    $old = $_POST['old'];
    $new = $_POST['new'];
    $renew = $_POST['renew'];
    if (isset($_SESSION['username'])) {
	    $id = $_SESSION['username'];
		if ($old != null && $new != null && $renew != null) {
			$temp = "select Password from acc where UserName='".$id."'";
			$result = mysql_query($temp);
			$row = mysql_fetch_row($result);
			if ($new == $renew && $row[0] == md5($old)) {
				$sql = "update acc set Password = '".md5($new)."' where UserName = '".$id."'";
				if (mysql_query($sql)) {
					echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Password Changed! Redirecting....</p>";
					echo "<meta http-equiv=REFRESH CONTENT=2;url=memberpanel.php>";
				} else 	{
					echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Failed to change! Redirecting....</p>";
					echo "<meta http-equiv=REFRESH CONTENT=2;url=memberpanel.php>";
				}
			} else {
				echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Failed to change! Redirecting....</p>";
				echo "<meta http-equiv=REFRESH CONTENT=2;url=memberpanel.php>";
			}
		} else {
			echo "<p style='color:#0000FF; padding:25px 0 25px 15px; text-align:center'>Failed to change! Redirecting....</p>";
			echo "<meta http-equiv=REFRESH CONTENT=2;url=memberpanel.php>";
		}	  
	} else 
	    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
 
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