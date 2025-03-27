<?php

function last_login ($user, $pass, $link){
	$today = date("Y-m-d H:i:s");
	
$sql_23=mysqli_query($link, "UPDATE `Info_Users` SET `Last_login` = '$today' WHERE `User`='$user' AND `Password`='$pass'");
	
	
	
}


	 /**************/

function get_email_leads_id($EmailFrom, $link) {
	$sql_00=mysqli_query($link, "SELECT * FROM `Info_Leads` WHERE  Email_Leads='$EmailFrom'" );
	
	if($row_00 = mysqli_fetch_array($sql_00)){
	$Lead_Id=$row_00["Lead_Id"];}else{
		$Lead_Id="none";}
	
		
	 return $Lead_Id;
	}
	
/**************/

function update_email_leads($First_Name, $Last_Name, $EmailFrom, $Phone, $BestTime, $Country, $fleads_id, $link) {
	
	$sql_02=mysqli_query($link, "UPDATE `Info_Leads` SET 
	`First_Name`=('$First_Name'), `Last_Name`=('$Last_Name'), `Email_Leads`=('$EmailFrom'),
	`Phone`=('$Phone'), `Time_to_Call`=('$BestTime'), `Country`=('$Country') WHERE  Lead_Id='$fleads_id'");
	 
	 return mysqli_affected_rows($link);
}

/**************/

function insert_email_leads ($First_Name, $Last_Name, $EmailFrom, $Phone, $BestTime,$Country, $link){

$sql_03=mysqli_query($link, "INSERT INTO Info_Leads 
	(First_Name, Last_Name, Email_Leads, Phone, Time_to_Call, Country ) 
	VALUES 
	('$First_Name', '$Last_Name', '$EmailFrom', '$Phone', '$BestTime', '$Country' )"  );	
	
	return $sql_03;}
	
/********
	


/**************/

function get_project_name($project_id, $link){
	
	$sql_04=mysqli_query($link, "SELECT * FROM `Info_Projects` WHERE  `Project_Id` ='$project_id' ");
	
	$row_04 = mysqli_fetch_array($sql_04);
	$Project_Name=$row_04["Name"];
	return $Project_Name;
 
	}


/**************/

function insert_SourceCode($SourceCode, $link ){
	$sql_06=mysqli_query($link, "INSERT INTO `Info_SourceCode`(`SourceCode`) VALUES ('$SourceCode')");
	
	return $sql_06;
	
	}
/**************/




function get_SourceC_ID ($SourceCode, $link){
	$sql_07=mysqli_query($link, "SELECT * FROM `Info_SourceCode` WHERE `SourceCode`='$SourceCode' ");
	
	if($row_07 = mysqli_fetch_array($sql_07)){
	$SourceCodeId=$row_07["SourceCodeId"];}else{
		$SourceCodeId="none";}
	
	return $SourceCodeId;
	
	}

/**************/
function insert_Leads_SourceC($SourceCodeId, $leads_id, $link){
	
	$sql_08=mysqli_query($link, "INSERT INTO `Info_Leads_SourceC_Rel`(`SourceCodeId`, `Lead_Id`) VALUES ($SourceCodeId, $leads_id)");
	
	
	}
	
function if_exist_Leads_SourceC($SourceCodeId, $leads_id, $link){	

$sql_09=mysqli_query($link, "SELECT * FROM `Info_Leads_SourceC_Rel` WHERE `SourceCodeId`='$SourceCodeId' AND `Lead_Id`='$leads_id' ");
if($row_09 = mysqli_fetch_array($sql_09)){
$exist="true";	
}else{$exist="none";}

return $exist;

}
	
	
	/**************/

function insert_into_Leads_To_Project_Rel($leads_id, $project_id, $SourceCodeId, $Comments, $link ){
	
	$sql_05=mysqli_query($link, "INSERT INTO `Info_Leads_To_Project_Rel` (`Lead_Id`, `Project_Id`, `SourceCodeId`, `Comments`) VALUES ('$leads_id', '$project_id', '$SourceCodeId', '$Comments')");
	
	return mysqli_affected_rows($link);
	}


/**************/


function login_user ($user, $password, $link ){
	
$sql_10=mysqli_query($link, "SELECT * FROM `Info_Users` WHERE User='$user' AND Password='$password' ");

if($row_10 = mysqli_fetch_array($sql_10)){
	
	
	$quser=$row_10["User"];
	$qpass=$row_10["Password"];
	$qlevel=$row_10["User_level"];
	
	if($qlevel){
		$login="true-admin";
		}else{
			$login="true";
			}
	
	//$login="true";
	
	return $login;
	 
		 
	
	}else{
		
		$login="false";
	
	return $login;
		
	 
		}
	
}
 
 
 function mail_attachment($file, $Name, $yesterday, $Recipients){
/**	
$filename = "Internal.csv";
$path = "attach/";**/
$to=$Recipients;
//$file_attachment=$path.$filename;
$file_attachment=$file;

$subject = "Leads Data Transfer Project: ".$Name." ".$yesterday."";
	$from = "Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>";
	
	//The Attachment
	if (is_file($file_attachment)) {
		$file_name = basename($file_attachment);
		$data = file_get_contents($file_attachment);	
		$path_parts = pathinfo($file_name);
		$type = "application/vnd.ms-excel";
		$file_type = 1;
	}
	
	$attachments[] = Array(
	   'data' => $data,
	   'name' => $file_name,
	   'type' => $type
	);
	
	// email body
	$text = "<p>Please see the attached file.</p>";
    $text .= "To request past leads, or if you have any question, please contact us at  <a href='mailto:leads@techmail.liveandinvestoverseas.com'>leads@techmail.liveandinvestoverseas.com</a>.</p>";
	$text .= "<p>Regards,</p>";
	$text .= "<p style='line-height:25px;'><img src='https://www.liveandinvestoverseas.com/CODES/Cmember--455225-2016/images/logo.jpg' width='200'><br />www.liveandinvestoverseas.com<br /><span style='font-size:12px'>1-888-627-8834 +(507) 209-8748</span></p>";
	
	//Generate a boundary string
	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
	
	
	//Add the headers for a file attachment
	$headers = "MIME-Version: 1.0\n" .
			   "From: {$from}\n" .
			   "Content-Type: multipart/mixed;\n" .
			   " boundary=\"{$mime_boundary}\"";
	
	
	//Add a multipart boundary above the plain message
	$message = "This is a multi-part message in MIME format.\n\n" .
			  "--{$mime_boundary}\n" .
			  "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
			  
			   "Reply-To: Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>\n" .
			   "Return-Path: Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>\n" .
			   
			   "Organization: Live and Invest Overseas Inc\n".
			   
			  "X-Priority: 3\n" .
			   
			   "X-Mailer: PHP". phpversion()."\n" . 
			  
			  "Content-Transfer-Encoding: 7bit\n\n" .
			  $text . "\n\n";


	//Add sttachments
	foreach($attachments as $attachment){
	   $data = chunk_split(base64_encode($attachment['data']));
	   $name = $attachment['name'];
	   $type = $attachment['type'];
	
	   $message .= "--{$mime_boundary}\n" .
				  "Content-Type: {$type};\n" .
				  " name=\"{$name}\"\n" .              
				  "Content-Transfer-Encoding: base64\n\n" .
				  $data . "\n\n" ;
	}
	
	$message .= "--{$mime_boundary}--\n";
	if (mail(implode(',', $to), $subject, $message, $headers)){ 
	 echo "mail send ... OK"; // or use booleans here
 } else {
 echo "mail send ... ERROR!";
 }
} 
 
 
 
 
 
 
 
 
 
 
 function mail_link($file_link, $Name_Subject, $yesterday, $Recipients){
 
$to=$Recipients;
$subject = "Leads Data Transfer Project: ".$Name_Subject." ".$yesterday."";
	$from = "Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>";
	
	 
	// email body
	$text = "<p>Please <a href=".$file_link.">click here to download the daily summary report</a>.</p>";
    $text .= "To request past leads, or if you have any question, please contact us at <a href='mailto:leads@techmail.liveandinvestoverseas.com'>leads@techmail.liveandinvestoverseas.com</a>.</p>";
	$text .= "<p>Regards,</p>";
	$text .= "<p style='line-height:25px;'><img src='https://www.liveandinvestoverseas.com/CODES/Cmember--455225-2016/images/logo.jpg' width='200'><br />www.liveandinvestoverseas.com<br /><span style='font-size:12px'>1-888-627-8834 +(507) 209-8748</span></p>";
	
	//Generate a boundary string
	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
	
	
	//Add the headers for a file attachment
	$headers = "MIME-Version: 1.0\n" .
			   "From: {$from}\n" .
			   "Content-Type: multipart/mixed;\n" .
			   " boundary=\"{$mime_boundary}\"";
	 	
	
	//Add a multipart boundary above the plain message
	$message = "This is a multi-part message in MIME format.\n\n" .
			  "--{$mime_boundary}\n" .
			  "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
			  
			   "Reply-To: Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>\n" .
			   "Return-Path:  Leads | Live and Invest Overseas <leads@techmail.liveandinvestoverseas.com>\n" .
			   
			   "Organization: Live and Invest Overseas Inc\n".
			   
			  "X-Priority: 3\n" .
			   
			   "X-Mailer: PHP". phpversion()."\n" . 
			  
			  "Content-Transfer-Encoding: 7bit\n\n" .
			  $text . "\n\n";


	 
	
	$message .= "--{$mime_boundary}--\n";
	if (mail(implode(',', $to), $subject, $message, $headers)){ 
	 echo "mail send ... OK"; // or use booleans here
 } else {
 echo "mail send ... ERROR!";
 }
} 
 /****SMTP**/
 
 function Send_Mail_SMTP($file_link, $Name_Subject, $yesterday, $Recipients)
	{
		
 
		
	$subject = "Project: ".$Name_Subject." ".$yesterday."";	
		
	$text = "<p>Please <a href=".$file_link.">click here to download the daily summary report</a>.</p>";
    $text .= "To request past leads, or if you have any question, please contact us at  <a href='mailto: leadsnotifications@liveandinvestoverseas.com'> leadsnotifications@liveandinvestoverseas.com</a>.</p>";
	$text .= "<p>Regards,</p>";
	$text .= "<p style='line-height:25px;'><img src='https://www.liveandinvestoverseas.com/CODES/Cmember--455225-2016/images/logo.jpg' width='200'><br />www.liveandinvestoverseas.com<br /><span style='font-size:12px'>1-888-627-8834 +(507) 209-8748</span></p>";	
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtppro.zoho.com';
		/*Set the SMTP port number - likely to be 25, 465 or 587*/
		$mail->Port = 587;				
		/*Set the encryption system to use - ssl (deprecated) or tls		*/
		$mail->SMTPSecure = 'tls';
		/*Whether to use SMTP authentication*/
		$mail->SMTPAuth = true;
		/*Username to use for SMTP authentication*/
		
		$mail->Username = 'support.catchall@liveandinvestoverseas.com';
		/*Password to use for SMTP authentication */
		$mail->Password = "";
		/*Set who the message is to be sent from*/
		$mail->setFrom('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");
		/*Set an alternative reply-to address*/
		$mail->addReplyTo('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");	
		//Set who the message is to be sent to
		
		$arrlength = count($Recipients);

		for($x = 0; $x < $arrlength; $x++) {
    	$Recipients[$x];
    	$mail->addAddress($Recipients[$x]);
		}
		
		
		
		//Set the subject line
		$mail->Subject = $subject;
		 
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body		echo "read_file";
		//$mail->msgHTML(file_get_contents('html_msg_1.html'), dirname(__FILE__));		
		//Replace the plain text body with one created manually
		$mail->msgHTML($text);
		//$mail->AltBody =  readfile('Plain_text_msg.txt');
		//Attach an image file
		if($addAttachment){
		$mail->addAttachment($addAttachment);}
		
		//send the message, check for errors
		if (!$mail->send())
		 {  echo 'NOT ENVIADO'; 
			return false;
			
		} 
		else 
		{    echo 'ENVIADO';
			return true;
		}
		
	}
 
  /****SMTP**/
  
  
  function Send_Mail_SMTP_Attach($file, $Name, $yesterday, $Recipients)
	{
		
	 

	 

		
	$subject = "Project: ".$Name." ".$yesterday."";
		
	$text = "<p>Please see the attached file.</p>";
    $text .= "To request past leads, or if you have any question, please contact us at  <a href='mailto: leadsnotifications@liveandinvestoverseas.com'> leadsnotifications@liveandinvestoverseas.com</a>.</p>";
	$text .= "<p>Regards,</p>";
	$text .= "<p style='line-height:25px;'><img src='https://www.liveandinvestoverseas.com/CODES/Cmember--455225-2016/images/logo.jpg' width='200'><br />www.liveandinvestoverseas.com<br /><span style='font-size:12px'>1-888-627-8834 +(507) 209-8748</span></p>";	
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtppro.zoho.com';
		/*Set the SMTP port number - likely to be 25, 465 or 587*/
		$mail->Port = 587;				
		/*Set the encryption system to use - ssl (deprecated) or tls		*/
		$mail->SMTPSecure = 'tls';
		/*Whether to use SMTP authentication*/
		$mail->SMTPAuth = true;
		/*Username to use for SMTP authentication*/
		
		$mail->Username = 'support.catchall@liveandinvestoverseas.com';
		/*Password to use for SMTP authentication */
		$mail->Password = "";
		/*Set who the message is to be sent from*/
		$mail->setFrom('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");
		/*Set an alternative reply-to address*/
		$mail->addReplyTo('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");
		//Set who the message is to be sent to
		
		$arrlength = count($Recipients);

		for($x = 0; $x < $arrlength; $x++) {
    	$Recipients[$x];
    	$mail->addAddress($Recipients[$x]);
		}
		
		
		
		//Set the subject line
		$mail->Subject = $subject;
		 
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body		echo "read_file";
		//$mail->msgHTML(file_get_contents('html_msg_1.html'), dirname(__FILE__));		
		//Replace the plain text body with one created manually
		$mail->msgHTML($text);
		//$mail->AltBody =  readfile('Plain_text_msg.txt');
		//Attach an image file
		$mail->addAttachment($file); 
		
		//send the message, check for errors
		if (!$mail->send())
		 {  echo 'NOT ENVIADO'; 
			return false;
			
		} 
		else 
		{    echo 'ENVIADO';
			return true;
		}
		
	}
	
	
 function Send_Mail_SMTP_alert($ProjectName_log,  $yesterday, $Recipients)	
 {
		
 
		
	$subject = "Notification: Leads were not sent today";
		
	$text = "<p><strong>The scheduled notification: ".$ProjectName_log.".</strong></p>";
    $text .= "Please contact <a href='mailto: leadsnotifications@liveandinvestoverseas.com'> leadsnotifications@liveandinvestoverseas.com</a> for more information.</p>";
	$text .= "<p>Regards,</p>";
	$text .= "<p style='line-height:25px;'><img src='https://www.liveandinvestoverseas.com/CODES/Cmember--455225-2016/images/logo.jpg' width='200'><br />www.liveandinvestoverseas.com<br /><span style='font-size:12px'>1-888-627-8834 +(507) 209-8748</span></p>";
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtppro.zoho.com';
		/*Set the SMTP port number - likely to be 25, 465 or 587*/
		$mail->Port = 587;				
		/*Set the encryption system to use - ssl (deprecated) or tls		*/
		$mail->SMTPSecure = 'tls';
		/*Whether to use SMTP authentication*/
		$mail->SMTPAuth = true;
		/*Username to use for SMTP authentication*/
		
		$mail->Username = 'support.catchall@liveandinvestoverseas.com';
		/*Password to use for SMTP authentication */
		$mail->Password = "";
		/*Set who the message is to be sent from*/
		$mail->setFrom('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");
		/*Set an alternative reply-to address*/
		$mail->addReplyTo('support.catchall@liveandinvestoverseas.com', "Leads | Live and Invest Overseas");	
		//Set who the message is to be sent to
		
		$arrlength = count($Recipients);

		for($x = 0; $x < $arrlength; $x++) {
    	$Recipients[$x];
    	$mail->addAddress($Recipients[$x]);
		}
		
		
		
		//Set the subject line
		$mail->Subject = $subject;
		 
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body		echo "read_file";
		//$mail->msgHTML(file_get_contents('html_msg_1.html'), dirname(__FILE__));		
		//Replace the plain text body with one created manually
		$mail->msgHTML($text);
		//$mail->AltBody =  readfile('Plain_text_msg.txt');
		//Attach an image file
		if($addAttachment){
		$mail->addAttachment($addAttachment);}
		
		//send the message, check for errors
		if (!$mail->send())
		 {  echo 'NOT ENVIADO'; 
			return false;
			
		} 
		else 
		{    echo 'ENVIADO';
			return true;
		}
		
	}
	
	
	
	

?>
