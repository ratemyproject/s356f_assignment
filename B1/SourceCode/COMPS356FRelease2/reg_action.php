<?php
require_once("mysql_connection.php");
//=============Starting Registration Script==========
$status = 0;
 
$userName    =    mysql_real_escape_string($_POST['username']);
$check = mysql_query("select * from acc where UserName='$userName'");
$num_rows =  mysql_num_rows($check);
if($num_rows){ trigger_error('Username exists.', E_USER_WARNING); 
$status = 1; echo "<script> alert('Username exists'); </script>"; }
 
$password    =    mysql_real_escape_string($_POST['pwd']);
$restTel	 =    mysql_real_escape_string($_POST['tel']);
$email=    mysql_real_escape_string($_POST['email']); 

$userType    =    (isset($_POST['type'])) ? $_POST['type'] : null;
if($userType == null || $userType == ''){ trigger_error('Type of user must be chosen.', E_USER_WARNING); 
$status = 1; echo "<script> alert('Type of user must be chosen'); </script>"; }

$temp = mysql_query("select username from acc");
$id 		 =   mysql_num_rows($temp);
if($id == null || $id == '') $id = 0; 
 
//============New Variable of Password is Now with an Encrypted Value========
if($status == 0){
	if(isset($_POST['btnRegister'])){
	$password = md5($password);
	$query    =    "insert into acc(Id,UserName,Password,Tel,email,Type)values('$id','$userName','$password','$restTel','$email','$userType')";
	$res    =    mysql_query($query);
	$message = "for success register: 
Thanks for your register! Please attend the following content!

Dear customer:

You had registered as member of ONLINE Restaurant. If you have any problem, please contact us at the following email:online_restaurant@xxx.com
You do not need to reply this email.

Thank you.



Cheers,
ONLINE Restaurant";
mail($email, 'Online Restaurant - Register Successful', $message);
	header('location:success_register.php');
}
} else {
	echo "<button type=\"button\" onclick=\"window.history.back(-1)\">Back to register page</button>";
}
?>