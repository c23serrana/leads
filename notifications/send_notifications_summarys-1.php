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
  
  echo $todaytime= date("H:i:s");
  
  if($todaytime > "02:50:00" && $todaytime < "04:30:00" ){
	 echo "right";
 

$qproname=mysqli_query($link, "SELECT * FROM `Info_Projects` INNER JOIN `Info_Leads_To_Project_Rel` ON Info_Projects.Project_Id=Info_Leads_To_Project_Rel.Project_Id WHERE Info_Leads_To_Project_Rel.Date_Joined BETWEEN '".$yesterday."' AND '".$today."' GROUP BY Info_Projects.Project_Id");

while($rowproname = mysqli_fetch_array($qproname)){
	
	 $Project_Id=$rowproname['Project_Id'];
	$Name=$rowproname['Name'];
	$Name=mysqli_real_escape_string($link, $Name);
	$Name_Subject='Summary Report';
	$nocomma= str_replace(',', '', $Name);
	$arr = explode(' ',trim($Name));
	$fname=$arr[0];
	
	
	/**
			$qrecipients=mysqli_query($link, "SELECT * FROM `Info_Recipients` WHERE Project_Id='$Project_Id'");
			while($rowrecip=mysqli_fetch_array($qrecipients)){}**/
			 $Recipients=array();
			 
			
			  
			  //$Recipients = $rowrecip['Recipients'].", "   ;
			  
			    array_push($Recipients, 'lsimon@liveandinvestoverseas.com','kpeddicord@liveandinvestoverseas.com','hkalashian@liveandinvestoverseas.com','cserrano@liveandinvestoverseas.com','mwalsh@liveandinvestoverseas.com','jackson@investgps.com' );
			  
			 	 
					  
				
			/****/
	
	
	$qproleads=mysqli_query($link, "SELECT distinct Lead_Id, Project_Id, SourceCodeId, Date_Joined,  Comments  FROM `Info_Leads_To_Project_Rel`  WHERE Project_Id='".$Project_Id."' AND Date_Joined BETWEEN '".$yesterday."' AND '".$today."' ");
	
	$data .=  "First_Name, Last_Name, Email_Leads, Phone, Time_to_Call, Country, Date_Joined, SourceCode, Comments, Project_name"."\n";
		
		while($rowleads = mysqli_fetch_array($qproleads)){
			
	 		$Lead_Id=$rowleads['Lead_Id'];
			$Date_Joined= $rowleads['Date_Joined'];
			$Comments=$rowleads['Comments'];
			$Comments=mysqli_real_escape_string($link, $Comments);
			$Comments= str_replace(',', '', $Comments);
			
			$SourceCodeId=$rowleads['SourceCodeId'];
			$qsource=mysqli_query($link, "SELECT * FROM `Info_SourceCode` WHERE SourceCodeId=".$SourceCodeId."");
			$rowsource = mysqli_fetch_array($qsource);
			$SourceName=$rowsource['SourceCode'];
			
			
				$qproleads_details=mysqli_query($link, "SELECT * FROM `Info_Leads` WHERE `Lead_Id` = '".$Lead_Id."' ");
	
					while($rowleads_details = mysqli_fetch_array($qproleads_details)){
						
						$First_Name=$rowleads_details['First_Name'];
						$First_Name=mysqli_real_escape_string($link, $First_Name);
						$Last_Name=$rowleads_details['Last_Name'];
						$Last_Name=mysqli_real_escape_string($link, $Last_Name);
						$Email_Leads=$rowleads_details['Email_Leads'];
						$Email_Leads=mysqli_real_escape_string($link, $Email_Leads);
						$Phone=$rowleads_details['Phone'];
						$Phone=mysqli_real_escape_string($link, $Phone);
						$Time_to_Call=$rowleads_details['Time_to_Call'];
						$Time_to_Call=mysqli_real_escape_string($link, $Time_to_Call);
						$Country=$rowleads_details['Country'];
						$Country=mysqli_real_escape_string($link, $Country);
						
						$data .= $First_Name.",".$Last_Name.",".$Email_Leads.",".$Phone.",".$Time_to_Call.",".$Country.",".$Date_Joined.",".$SourceName.",".$Comments.",".$nocomma."\n";
						
						}
	
	}
	
	
	}


  

	$file = __DIR__.'/temp/leads-lios-id-summary-'.$yesterday.'.csv';
//chmod($file, 0777);
if(file_put_contents($file, $data)){echo 'file created-';}else{echo 'error';};

$file_link='https://'.$domain.'/leads/notifications/temp/leads-lios-id-summary-'.$yesterday.'.csv';


 


  


$notify=Send_Mail_SMTP($file_link, $Name_Subject, $yesterday, $Recipients);
//mail_link($file_link, $Name_Subject, $yesterday, $Recipients);
//mail_attachment($file, $Name, $yesterday, $Recipients);

}else{
		 echo "Out of schedule";
		 }

if($notify=="1"){$Status="SENT";}else{ $Status="NOT SENT";}	

$ProjectName_log="Summary";

	$remote_address=$_SERVER['REMOTE_ADDR'];
	$sql_noty=mysqli_query($link, "INSERT INTO Info_Notification 
	(ProjectName_log, Status, Rmt_Add) 
	VALUES 
	('$ProjectName_log', '$Status', '$remote_address')"  );	

    ?>