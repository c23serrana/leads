<?php
//header("Location: https://reporting.liveandinvestoverseas.com/leads/");
//die();
require_once("includes/inc.session.php");
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Leads Data Base</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>

<?php

include("includes/connection.php");
include("functions/functions-file.php");



/**if ($_POST["username"]){**/

 $user=$_POST["username"];
$user=mysqli_real_escape_string($link, $user);

$pass=$_POST["password"];
$pass=mysqli_real_escape_string($link, $pass);

$login_success=login_user ($user, $pass, $link );
$last_login=last_login ($user, $pass, $link );


if(!isset($_SESSION["Session"])  || $_SESSION["Session"]=="false"){
	$_SESSION["Session"]=$login_success;
}
 
 include("includes/session.php");

?>
	<div class="container">
    
    
		<div class="top">
        
        
			  <h1 id="title" class="hidden"><!--<span id="logo">Leads <span>Data Base</span></span>-->
              <center id="logo"><img src="https://www.liveandinvestoverseas.com/wp-content/uploads/2017/07/LIO-slogan-newsite.png" width="260" /></center> 
              </h1> 
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
            <form action="#" method="POST">
			<label for="username">Username</label>
			<br/>
			<input type="text" id="username" name="username">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" id="password" name="password">
			<br/>
			<button type="submit">Sign In</button>
            </form>
			<br/>
            <?php
			if($_GET["error"]){
				echo '<p class="small" style="color:maroon;">
            
            
            Invalid Username or Password</p>';
				
				}else{
					
					echo '<a href="#"><p class="small">
            
            
            Forgot your password?</p></a>';
					
					}
            ?>
            
			
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>