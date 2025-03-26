<?php
include __DIR__.'/../includes/connection.php'; 
include __DIR__.'/../functions/functions-file.php'; 
require __DIR__.'/PHPMailer-master/PHPMailerAutoload.php'; 
require __DIR__.'/PHPMailer-master/class.phpmailer.php';
require __DIR__.'/../includes/variables.php';

 

$yet = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
 $yesterday= date("Y-m-d", $yet);
 $tod = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $today= date("Y-m-d", $tod);
  
    $todaytime= date("H:i:s");
 
	 	 
  
  $sql_00=mysqli_query($link, "SELECT * FROM `Info_Notification` Where TimeStamp LIKE '%$today%'" );
  
   $Recipients=array();
  array_push($Recipients, "cserrano@liveandinvestoverseas.com", "mmaloney@liveandinvestoverseas.com", "support@liveandinvestoverseas.com", "hkalashian@liveandinvestoverseas.com");
  
  $gotinfo = mysqli_num_rows($sql_00);
//$ProjectName_log=' ';
    
  while($row_00 = mysqli_fetch_array($sql_00)){
	     $ProjectName_log .= $row_00['ProjectName_log']."--";
	    $Status=$row_00['Status'];
	     $TimeStamp=$row_00['TimeStamp'];
	  
	  if($Status == "NOT SENT" ){
		
	  echo '<br>'. $ProjectName_log;
	  echo '<br>'. $Status;
	  echo '<br>'. $TimeStamp;
	echo '<br>'. $ProjectName_log2="Status NOT SENT";	  
		  
	Send_Mail_SMTP_alert($ProjectName_log2,  $yesterday, $Recipients);
		} else{echo "Successfull(Status)";}
	 
	 
	  
	  }

 

if($ProjectName_log != "Leads-to-Developers--Summary--" ){
		
	  echo '<br>File Time Out or Did Not Execute:'. $ProjectName_log;
	  
	 
		$ProjectName_log="Summary and Leads to Developers (File Time Out or Did Not Execute)";
		 
		Send_Mail_SMTP_alert($ProjectName_log,  $yesterday, $Recipients);
		
		
		
		} else{echo '<br>'."Successfull(Execute)";}


/**
	   
 	  if($gotinfo > 0){
		  
		 echo '<br> si result';
		
		} else{
			 echo '<br> no result';
			
			 echo '<br>'. $ProjectName_log="Summary and Leads to Developers";
	 echo '<br>'. $Status;
	 echo '<br>'. $TimeStamp;
	  
		 
		 
		 Send_Mail_SMTP_alert($ProjectName_log,  $yesterday, $Recipients); 
			
			}  
  **/
  ?>