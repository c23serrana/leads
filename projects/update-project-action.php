<?php
require_once("../includes/inc.session.php");
session_start();


include("../includes/session-check.php");
include("../includes/connection.php");
include("../includes/variables.php");
include("../includes/header.php");

?>

<body id="list-project">
<?php
  $pro_drop='default open';
include("../includes/menu.php");


?>

<div id="style-2" class="content" align="lef" >

<div class="inner-content">
<h3><i class="fa fa-tasks"></i> Update  Project</h3>

<br><br>

 
 

 
<?php 
/**insert but update**/ 
		if($_POST["newsubmit"]) {
			
	
	$name_pro=$_POST["name-pro"];
	$name_pro = mysqli_real_escape_string($link, $name_pro);
	
	$project_url=$_POST["project-url"];
	$project_url = mysqli_real_escape_string($link, $project_url);
	
	$project_id=$_POST["project-id"];
	
	$mytext1=$_POST["mytext1"];
	$idmytext1=$_POST["idmytext1"];
	$mytext1=mysqli_real_escape_string($link, $mytext1);
	
	$mytext2=$_POST["mytext2"];
	$idmytext2=$_POST["idmytext2"];
	$mytext2=mysqli_real_escape_string($link, $mytext2);
	
	$mytext3=$_POST["mytext3"];
	$idmytext3=$_POST["idmytext3"];
	$mytext3=mysqli_real_escape_string($link, $mytext3);
	
	$mytext4=$_POST["mytext4"];
	$idmytext4=$_POST["idmytext4"];
	$mytext4=mysqli_real_escape_string($link, $mytext4);
	
	$mytext5=$_POST["mytext5"];
	$idmytext5=$_POST["idmytext5"];
	$mytext5=mysqli_real_escape_string($link, $mytext5);
	
	$mytext6=$_POST["mytext6"];
	$idmytext6=$_POST["idmytext6"];
	$mytext6=mysqli_real_escape_string($link, $mytext6);
	
	$mytext7=$_POST["mytext7"];
	$idmytext7=$_POST["idmytext7"];
	$mytext7=mysqli_real_escape_string($link, $mytext7);
	
	$mytext8=$_POST["mytext8"];
	$idmytext8=$_POST["idmytext8"];
	$mytext8=mysqli_real_escape_string($link, $mytext8);
	
	$mytext9=$_POST["mytext9"];
	$idmytext9=$_POST["idmytext9"];
	$mytext9=mysqli_real_escape_string($link, $mytext9);
	
	$mytext10=$_POST["mytext10"];
	$idmytext10=$_POST["idmytext10"];
	$mytext10=mysqli_real_escape_string($link, $mytext10);
	
 	if($name_pro ){
		$sql_pj=mysqli_query($link, "UPDATE `Info_Projects` SET  `Name`='$name_pro' WHERE `Project_Id`='$project_id' "  ); 
	
	
		
		}
	if($project_url){
		$sql_pj=mysqli_query($link, "UPDATE `Info_Projects` SET  `Project_Url`='$project_url' WHERE `Project_Id`='$project_id' "  ); 
	
	 
		
		}
		
		
	/*$sql_pjId=mysqli_query($link, "SELECT * FROM `Info_Projects` WHERE  `Name` ='$name_pro' ");
	$row_pjId = mysqli_fetch_array($sql_pjId);
	$project_id=$row_pjId["Project_Id"]; **/
	 

	
if($mytext1&&$idmytext1){
	$mytext1_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext1' WHERE `Info_Recipients_Id`='$idmytext1'"  ); 
		
		 		
		}else if($mytext1){
			$mytext1_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext1')"  ); 
			
			}else {$mytext1_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext1'");}
			
if($mytext2&&$idmytext2){
	$mytext2_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext2' WHERE `Info_Recipients_Id`='$idmytext2'"  ); 
		
		 		
		}else if($mytext2){
			$mytext2_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext2')"  ); 
			
			}else {$mytext2_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext2'");}
			
if($mytext3&&$idmytext3){
	$mytext3_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext3' WHERE `Info_Recipients_Id`='$idmytext3'"  ); 
		
		 		
		}else if($mytext3){
			$mytext3_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext3')"  ); 
			
			}else {$mytext3_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext3'");}
			
if($mytext4&&$idmytext4){
	$mytext4_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext4' WHERE `Info_Recipients_Id`='$idmytext4'"  ); 
		
		 		
		}else if($mytext4){
			$mytext4_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext4')"  ); 
			
			}else {$mytext4_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext4'");}

if($mytext5&&$idmytext5){
	$mytext5_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext5' WHERE `Info_Recipients_Id`='$idmytext5'"  ); 
		
		 		
		}else if($mytext5){
			$mytext5_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext5')"  ); 
			
			}else {$mytext5_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext5'");}			


if($mytext6&&$idmytext6){
	$mytext6_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext6' WHERE `Info_Recipients_Id`='$idmytext6'"  ); 
		
		 		
		}else if($mytext6){
			$mytext6_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext6')"  ); 
			
			}else {$mytext6_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext6'");}
			
if($mytext7&&$idmytext7){
	$mytext7_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext7' WHERE `Info_Recipients_Id`='$idmytext7'"  ); 
		
		 		
		}else if($mytext7){
			$mytext7_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext7')"  ); 
			
			}else {$mytext7_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext7'");}
			
if($mytext8&&$idmytext8){
	$mytext8_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext8' WHERE `Info_Recipients_Id`='$idmytext8'"  ); 
		
		 		
		}else if($mytext8){
			$mytext8_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext8')"  ); 
			
			}else {$mytext8_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext8'");}
									
if($mytext9&&$idmytext9){
	$mytext9_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext9' WHERE `Info_Recipients_Id`='$idmytext9'"  ); 
		
		 		
		}else if($mytext9){
			$mytext9_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext9')"  ); 
			
			}else {$mytext9_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext9'");}	
			
if($mytext10&&$idmytext10){
	$mytext10_insert=mysqli_query($link, "UPDATE `Info_Recipients` SET `Recipients`= '$mytext10' WHERE `Info_Recipients_Id`='$idmytext10'"  ); 
		
		 		
		}else if($mytext10){
			$mytext10_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$project_id', '$mytext10')"  ); 
			
			}else {$mytext10_insert=mysqli_query($link, "DELETE FROM `Info_Recipients` WHERE `Info_Recipients`.`Info_Recipients_Id` ='$idmytext10'");}							
	 
		 
		 
		 
	 }
	 
	 if($name_pro||$project_url){
	echo '<form id="add-project"> Project: '.$name_pro.' has been updated </form>' ; }else{
		
	echo '<form id="add-project"> Project has NOT been updated </form>' ;	}
	

?>

 
</div>




 

</div>
</div>

	

</body>
</html>