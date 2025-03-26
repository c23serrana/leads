<?php
$link=mysqli_connect('db1.cluster-czb7nnevxblx.us-east-1.rds.amazonaws.com','ivystorm_imember','^5StkmQ0a{EH','ivystorm_leads_db_2018');

 
	
	
	for($x = 0; $x <= 5; $x+1){		
	 
$sql_05=mysqli_query($link, "DELETE FROM Info_Leads WHERE Lead_Id IN (
 SELECT * FROM (
    SELECT Lead_Id FROM Info_Leads GROUP BY Email_Leads HAVING ( COUNT(Email_Leads) > 1 )
 ) AS q
)");	
	}
 
?>