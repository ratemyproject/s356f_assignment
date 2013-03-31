<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="reg.css" />
<title>Registration - ONLINE Restaurant</title>

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


 </div>
  <div id="container">
<!--Registration form-->
<h2>Please enter the following information</h2>
<div id="regform">
            <form id="form1" name="form1" method="post" action="reg_action.php" onsubmit="return checkForm(this);">
               Username : <input type="text" id="uesrname" name="username" /><br />
               Password : <input type="password" name="pwd" id="pwd" /><p class="explain">(6-32 characters, must contain uppercase and lowercase letter)</p><br />
               Re-enter Password : <input type="password" name="repwd" id="repwd" /><br />
               Members type : </br>
               <input type="radio" name="type" value="1" id="type" />Restaurant Member<br />
               <input type="radio" name="type" value="0" id="type" />Normal Member<br />
               Telephone:<input type="text" name="tel" id="tel" /><br />
               E-mail:<input type="email" name="email" id="email" /><br /><br /><br />
               <input class="submit" type="submit" name="btnRegister" value="Registration" />
               <input class="button" type="button" onclick="formReset()" value="Reset" />
            </form>
         </div>
</div>
<div id="footer">
<p>Copyright@CLOUD</p>
</div>
</body>
<!--extra
<script>
function setElementVisibility(elementToSet){
   elementToSet.style.display = "inline";
   elementToSet.style.visibility = "visible";
}
function showlist(){
 setElementVisibility(document.getElementById("speciallist"));
}
-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

<!--register checking function-->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
  function checkPassword(str)
  {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
    return re.test(str);
  }

  function checkForm(form)
  {
    if(form.txtUser.value == "") {
      alert("Error: Username cannot be blank!");
      form.txtUser.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.txtUser.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.txtUser.focus();
      return false;
    }
    if(form.txtPassword.value != "" && form.txtPassword.value == form.rePassword.value) {
      if(!checkPassword(form.txtPassword.value)) {
        alert("The password you have entered is not valid!");
        form.txtPassword.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.txtPassword.focus();
      return false;
    }
    return true;
  }
</script>
<!--register checking function end-->

<!---reset register form with id="form1"-->
<script>
function formReset()
{
document.getElementById("form1").reset();
}
</script>
</html>