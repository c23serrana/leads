<?php
require_once("inc.session.php");
session_start();
  $_SESSION["Session"];



if(!isset($_SESSION["Session"])  or $_SESSION["Session"]=="false"){
	echo' <script type="text/javascript">
           window.location.href = "https://reporting.liveandinvestoverseas.com/leads/"
      </script>';
	  exit(); 
	
	
	}
  /**
if($_SESSION["Session"]=="false" or  !$_SESSION["Session"]){
	
	
	
 
}**/
 
	   
	   
	   
	   
	
	 
        ?>