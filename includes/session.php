<?php
require_once("inc.session.php");
session_start();

$_SESSION["Session"];

if($login_success=="true" or $login_success=="true-admin" or $_SESSION["Session"]=="true" or $_SESSION["Session"]=="true-admin"){
	
	 echo' <script type="text/javascript">
          window.location.href = "/leads/admin.php";
      </script>'; 
	  exit();
	}

 

	  
	
	 
        ?>