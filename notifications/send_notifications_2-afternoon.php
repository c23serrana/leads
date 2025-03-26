<?php 
include __DIR__.'/../includes/connection.php'; 
include __DIR__.'/../functions/functions-file.php'; 
require __DIR__.'/PHPMailer-master/PHPMailerAutoload.php'; 
require __DIR__.'/PHPMailer-master/class.phpmailer.php';


/**$yet = mktime(0, 0, 0, date("m"), date("d")-4, date("Y"));
   
 $tod = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));

 echo "<br>". $yesterday= date("Y-m-d 00:00:00", $yet);
  echo "<br>". $today= date("Y-m-d 23:59:00", $tod);**/

 $tod = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
 echo "<br>". $yesterday= date("Y-m-d 13:00:00", $tod);
  echo "<br>". $today= date("Y-m-d 23:59:00", $tod);

  echo "<br>". $todaytime= date("H:i:s");
  if($todaytime > "01:00:00" && $todaytime < "02:00:00" ){
	 echo "<br>". "right";	
 

$qproname=mysqli_query($link, "SELECT * FROM `Info_Projects` INNER JOIN `Info_Leads_To_Project_Rel` ON Info_Projects.Project_Id=Info_Leads_To_Project_Rel.Project_Id WHERE Info_Leads_To_Project_Rel.Date_Joined BETWEEN '".$yesterday."' AND '".$today."' GROUP BY Info_Projects.Project_Id");

while($rowproname = mysqli_fetch_array($qproname)){
	
	$Project_Id=$rowproname['Project_Id'];
	$Name=$rowproname['Name'];
	$Name=mysqli_real_escape_string($link, $Name);
	$nocomma= str_replace(',', '', $Name);
	$arr = explode(' ',trim($Name));
	$fname=$arr[0];

	
	
	
	/****/
			$qrecipients=mysqli_query($link, "SELECT * FROM `Info_Recipients` WHERE Project_Id='$Project_Id'");
			 $Recipients=array();
			 
			while($rowrecip=mysqli_fetch_array($qrecipients)){
			  
			  //$Recipients = $rowrecip['Recipients'].", ";
			  
			   array_push($Recipients, $rowrecip['Recipients']);
			  
			 	
				
				}
			/****/
	
	
	$qproleads=mysqli_query($link, "SELECT * FROM `Info_Leads_To_Project_Rel` WHERE Project_Id='".$Project_Id."' AND Date_Joined BETWEEN '".$yesterday."' AND '".$today."' ");
	
	$data =  "First_Name, Last_Name, Email_Leads, Phone, Time_to_Call, Country, Date_Joined, SourceCode, Comments, Project_name"."\n";
		
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
	

	
	$file = __DIR__.'/temp/leads-lios-id-'.$Project_Id.'-'.$yesterday.'.csv';
//chmod($file, 0777);
if(file_put_contents($file, $data)){echo 'file created-';}else{echo 'error';};


//mail_attachment($file, $Name, $yesterday, $Recipients);
$notify=Send_Mail_SMTP_Attach($file, $Name, $yesterday, $Recipients);}/**while rowleads**/

}else{
		 echo "<br>". "Out of schedule";
		 }

	
	

if($notify=="1"){$Status="SENT";}else{ $Status="NOT SENT";}	
$ProjectName_log="Leads-to-Developers";
	$remote_address=$_SERVER['REMOTE_ADDR'];
	$sql_noty=mysqli_query($link, "INSERT INTO Info_Notification 
	(ProjectName_log, Status, Rmt_Add) 
	VALUES 
	('$ProjectName_log', '$Status', '$remote_address')"  );	

 





    ?>