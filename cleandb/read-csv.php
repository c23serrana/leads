<?php
$link=mysqli_connect('db1.cluster-czb7nnevxblx.us-east-1.rds.amazonaws.com','ivystorm_imember','^5StkmQ0a{EH','ivystorm_leads_db_2018');

$handle = fopen('form_data(4).csv','r');


while ( $data = fgetcsv($handle)  ){
	//var_dump($data);
	echo '<br>';
	echo $EmailFrom=$data[3];
	
	echo '-id email-';
	$sql_00=mysqli_query($link, "SELECT * FROM `Info_Leads` WHERE  Email_Leads='$EmailFrom'" );
	$row_00 = mysqli_fetch_array($sql_00);
	echo $leads_id=$row_00["Lead_Id"];
	
	echo '-projectid-';	
	echo $project_id=$data[1];
	
	echo '-sourceid-';
	echo $SourceCode=$data[10];
	$sql_07=mysqli_query($link, "SELECT * FROM `Info_SourceCode` WHERE `SourceCode`='$SourceCode' ");
	$row_07 = mysqli_fetch_array($sql_07);
	if($row_07["SourceCodeId"]){
		echo $SourceCodeId=$row_07["SourceCodeId"];
		}else{
		echo $SourceCodeId=7;	
			}
			
	echo '-date-';	
	echo $date=$data[8];
		
	echo '-comments-';
	echo $Comments=$data[7];
	
	
	 	

$sql_05=mysqli_query($link, "INSERT INTO `Info_Leads_To_Project_Rel` (`Lead_Id`, `Project_Id`, `SourceCodeId`, `Date_Joined`, `Comments`) VALUES ('$leads_id', '$project_id', '$SourceCodeId', '$date', '$Comments')");

echo '-insert-';	 
	
	}

?>