<?php
$hostdb = "db1.cluster-czb7nnevxblx.us-east-1.rds.amazonaws.com";  // MySQl host
 $userdb = "ivystorm_imember";  // MySQL username
 $passdb = "^5StkmQ0a{EH";  // MySQL password
 $namedb = "ivystorm_leads_db_2018";  // MySQL database name

$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);


$link=mysqli_connect('db1.cluster-czb7nnevxblx.us-east-1.rds.amazonaws.com','ivystorm_imember','^5StkmQ0a{EH','ivystorm_leads_db_2018'); 



?>