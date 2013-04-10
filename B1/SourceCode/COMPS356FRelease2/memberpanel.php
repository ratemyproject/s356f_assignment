<?php
session_start();
if(!isset($_SESSION['username'])){
	header ('location:index.php');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="menberpanelmenu.css">
<link rel="stylesheet" type="text/css" href="index.css">
<title>Member Panel - ONLINE Restaurant</title>
<style type="text/css">
a.normalLink {
	border-bottom:1px solid #069;
	color:#069;
}
</style>
</head>

<body>
<div id="header">

<div id="logo"><a href="index.php"><img src="image\icon.png" /></a></div>

 </div>

<div id="container">
<!--search bar(new version)-->
<div id="search">

		<form action="searchbox.php" method="GET" style=" color: orange; margin-bottom: -1px;">
		<b>Search Restaurant </b>
		<select name="district">
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
<div id="login">
  <?php
if (!isset($_SESSION['username'])) {
echo "<a href='login.html'>Login </a>|<a href='reg.php'> New Members </a>";
}else echo "Welcome <a href='memberpanel.php'>".$_SESSION['username']."</a> | <a href='logout.php'>Logout</a>";
?>

</div>
</div>
<div id='memberpanel' style=" margin: 30px; ">
<h2>Member Panel</h2>
<ul id="nav">
<li><a href="memberpanel.php?ad=changepw">Change Password</a></li>
<li> <a href="#">Change information</a>
<ul><li><a href="memberpanel.php?ad=changeTel">Change Telephone No.</a></li>
<?php
if($_SESSION['rest'] == 1){
	echo "<li><a href=\"memberpanel.php?ad=createRest\">Create Restaurant(s) Record</a></li>";
	echo "<li><a href=\"memberpanel.php?ad=updateRest\">Update Restaurant(s) Details</a></li>";
}
?>
</ul>
</li>
<?php
if($_SESSION['rest'] == 1){ 
echo 
"<li><a href=\"#\">Manage Menu</a>
<ul>
<li><a href='memberpanel.php?ad=addmenu'>Add Menu</a></li>
<li><a href='memberpanel.php?ad=delmenu'>Delete Menu</a></li>
</ul>
</li>"; ?>
<li><a href='memberpanel.php?ad=manage_set_menu'>Manage Set Menu</a></li>
<?php
}
?>
<?php
if($_SESSION['rest'] == 1){ 
echo 
"<li><a href=\"#\">View Order</a>
<ul>
<li><a href='restViewOrder.php'>View Order</a></li>
</ul>
</li>";
} else {
echo 
"<li><a href=\"#\">View Order</a>
<ul>
<li><a href='vieworder.php'>View Order</a></li>
</ul>
</li>";}

?>

<li><a href="logout.php">Logout</a></li>
</ul>

<?php
if(isset($_GET['ad'])){
require_once("mysql_connection.php");
if($_GET['ad'] == "changepw"){
		echo "<form id='form1' method='post' action='updatepass.php' >";
		echo "<p>Old Password: <input type='password' name='old' /></p>";
		echo "<p>New Password: <input type='password' name='new' /></p>";
		echo "<p>Confirm New Password: <input type='password' name='renew' /></p><br/><br/>";
		echo "<p class='submit'>
			  <input type='submit' name='changepwd' id='button' value='Submit' id='s1'/>
			  <p/>
		      </form>";
}else if($_GET['ad'] == "delmenu"){
		$sql = "SELECT foodid, food, price FROM menu where restaurantid = (SELECT rid FROM restaurants where owner = '".$_SESSION['username']."')";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
		echo "<form action=\"delMenu.php\" method=\"post\">";
		echo "<h3>Delete Menu Items</h3>";
		echo "<table>";
		echo "<tr><td>Name</td><td>Price</td><td>Delete from website</td></tr>";
		while($row = mysql_fetch_array($result)){
			echo "<tr><td>".$row['food']."</td><td>".$row['price']."</td><td><input type=\"checkbox\" name=\"del[]\" value=".$row['foodid']."></td></tr>";
		}
		echo "<tr><td colspan='3'><input type='submit' value='Delete' /></td><tr>";
		echo "</form></table>";
		}else echo "No item found in our database.";
}else if($_GET['ad'] == "addmenu"){
		    echo "<h3> Add Menu </h3>";
			echo "<form action = 'addMenuProcess.php' method = 'post'>
			          <table>
					      <tr>
						      <th>Type</th>
							  <th>Name</th>
							  <th>Price</th>
						  </tr>
                          <tr>
                              <td><select name = 'type1'><option value='Food'>Food</option>
                                          <option value='Drink'>Drink</option>
                                  </select></td>
                              <td><input type = 'text' name = 'name1' value = '' /></td>
                              <td><input type = 'text' name = 'price1' value = '' /></td>
                          </tr>	
                          <tr>
                              <td><select name = 'type2'><option value='Food'>Food</option>
                                          <option value='Drink'>Drink</option>
                                  </select></td>
                              <td><input type = 'text' name = 'name2' value = '' /></td>
                              <td><input type = 'text' name = 'price2' value = '' /></td>
                          </tr>	
                          <tr>
                              <td><select name = 'type3'><option value='Food'>Food</option>
                                          <option value='Drink'>Drink</option>
                                  </select></td>
                              <td><input type = 'text' name = 'name3' value = '' /></td>
                              <td><input type = 'text' name = 'price3' value = '' /></td>
                          </tr>		
                          <tr>
                              <td><select name = 'type4'><option value='Food'>Food</option>
                                          <option value='Drink'>Drink</option>
                                  </select></td>
                              <td><input type = 'text' name = 'name4' value = '' /></td>
                              <td><input type = 'text' name = 'price4' value = '' /></td>
                          </tr>		
                          <tr>
                              <td><select name = 'type5'><option value='Food'>Food</option>
                                          <option value='Drink'>Drink</option>
                                  </select></td>
                              <td><input type = 'text' name = 'name5' value = '' /></td>
                              <td><input type = 'text' name = 'price5' value = '' /></td>
                          </tr>			
                      </table>	
                      <input type = 'submit' value = 'Add' />
                  </form>";	
}else if($_GET['ad']=='changeTel'){
		echo "<form id='form1' method='post' action='updateinfo.php' style='margin-top:0'>";
		echo "Password: <input type='password' name='pass' /><br/>";
		echo "Re-Enter Password: <input type='password' name='repass' /><br/>";
		echo "Telephone: <input type='text' name='tel' /><br/>";
		echo "<input type='submit' id='button' value='Submit'/></form>";
		
}else if($_GET['ad']=='updateRest'){
		$sql = "select * from restaurants where owner = '".$_SESSION['username']."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_array($result)){
		echo "<form method = 'post' action = 'updaterestinfo.php'>
		    <label for = 'restName'>Restaurant</label>
			<input type = 'text' name ='restName' value = '".$row['rname']."' /></br>
			<label for = 'restTel'>Telephone</label>
			<input type = 'text' name ='restTel' value = '".$row['rtel']."' /></br>
			<label for = 'restDes'>Description</label>
			<textarea rows='4' cols='50' name ='restDes'>".$row['rdes']."
			</textarea></br>
			<input type = 'submit' value = 'update' />
		</form>	";
		}
		}
}else if($_GET['ad']=='createRest'){ ?>
			<form action="upload_file.php" method="post"
			enctype="multipart/form-data" id="uploadImgForm">Upload Image:<br />
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Submit">
			</form>
            <?php
			echo "<form action = 'addrestprocess.php' method = 'post'>
			      <label for = 'restName'>Restaurant Name</label>
			      <input type = 'text' name ='restName' value = '' />
                  <br />
			      <label for = 'restTel'>Telephone</label>
			      <input type = 'text' name ='restTel' value = '' />
                  <br />
				  <label for = 'restAdd'>Address</label>
				  <input type = 'text' name ='restAdd' value = '' />
				  <br />
				  <label for = 'restDes'>Description</label>
				  <br />
			      <textarea rows='4' cols='50' name ='restDes'>Please Enter Your Description Here...
				  </textarea>
				  <br />
				  <label for = 'area'>Area</label>
				  <select name='area'>
				  <option value='Hong Kong Island'>Hong Kong Island</option>
				  <option value='Kowloon'>Kowloon</option>
				  <option value='New Territories'>New Territories</option>
				  </select>
				  <label for = 'dist'>District</label>
				  <select name='dist'>
				  <option value=''>-Hong Kong Island-</option>
				  <option value='The Peak'>The Peak</option>
		          <option value=''>-Kowloon-</option>
		          <option value='Kwun Tong'>Kwun Tong</option>
		          <option value='Sham Shui Po'>Sham Shui Po</option>
		          <option value=''>-New Territories-</option>
		          <option value='Tuen Mun'>Tuen Mun</option>
				  </select>
                  <br />
			      <input type = 'submit' value = 'Create!' />";
			if (isset($_SESSION['logo_name'])) {
				echo "<input type = 'hidden' name='logo_name' value = '".$_SESSION['logo_name']."'/>";
				unset($_SESSION['logo_name']);
			}
			echo  "</form>";
} else if ($_GET['ad']=='manage_set_menu') { 
	$rid_sql = 'select rid from restaurants where owner = "'.$_SESSION['username'].'"';
	$result = mysql_query($rid_sql);
	$row = mysql_fetch_array($result);
	$rid = $row['rid'];
?>
	<a href="addNewSetMenu.php?rid=<?php echo $rid; ?>" class="normalLink">add a new set menu</a>
	<img src='image\Seperateline.png'/ style="display:block;">
<?php
	$result = mysql_query('select setMenuId, name from setmenu where restaurantid = (select rid from restaurants where owner = "'.$_SESSION['username'].'")');
	if(mysql_num_rows($result) > 0){ ?>
	<form action="setMenuManager.php" method="post">
	<h3>Existing Set Menus</h3>
<?php		while($row = mysql_fetch_array($result)){
?>
<input type="checkbox" name="selected[]" value="<?php echo $row['setMenuId']; ?>"><?php echo $row['name']; ?>
<br/>
<?php } ?>
	<input type="hidden" name="rid" value="<?php echo $rid; ?>"/>
	<input type="submit" name="manageFormSubmit" value="modify"/>
	<input type="submit" name="manageFormSubmit" value="delete"/>
	</form>
<?php } else { ?>
	<p>No Set Menu stored</p>
<?php }
}
?>
<?php
mysql_close();
}
?>
</div>
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