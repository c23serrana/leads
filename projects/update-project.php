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


if($project_Id=$_GET["project_Id"]){
 
$sql_pjed=mysqli_query($link, "SELECT * FROM `Info_Projects` WHERE  `Project_Id` ='$project_Id' ");
	$row_pjed = mysqli_fetch_array($sql_pjed);
	
	 $project_Id=$row_pjed["Project_Id"];
	 $Project_Name=$row_pjed["Name"];

	 $Project_Url=$row_pjed["Project_Url"];
	 
	

  
 
?>

<form id="add-project" action="update-project-action.php" method="post">
<table width="100%">
<tr><td width="25%">
Name: </td><td width="35%"><input name="name-pro" type="text" width="100%" value="<?php echo $Project_Name; 
?>"> </td></tr>
<!--<tr><td>
Sale Force Code: </td><td> <input name="sales-force" type="text" width="100%"></td></tr>-->
<tr><td>
Project URL: </td><td> <input name="project-url" type="text" width="100%" value="<?php
echo $Project_Url; ?>"></td></tr>

<tr><td colspan="2" >  <input name="project-id" type="hidden" width="100%" value="<?php
echo $project_Id; ?>"></td></tr>

<tr><td valign="top">
E-mail notification recipients: </td><td> 

<div class="container1">

 
<?php 
$sql_pjre=mysqli_query($link, "SELECT * FROM `Info_Recipients` WHERE `Project_Id`='$project_Id'");	
 
	
	
	 
	 for ($x = 1; $x <= 10; $x++){
		  $row_pjre = mysqli_fetch_array($sql_pjre); 
		  
		 $Info_Recipients_Id=$row_pjre["Info_Recipients_Id"];
		 $reci=$row_pjre["Recipients"];
			
		echo '<input type="text" name="mytext'.$x.'" value="'.$reci.'"><input type="hidden" name="idmytext'.$x.'" value="'.$Info_Recipients_Id.'"><br><br>';
		}
		
		
		  
}else{
	echo' <script type="text/javascript">
           window.location.href = "https://'.$domain.'/leads/projects/list-project.php"
      </script>';
	  exit();
	
	}

?>

 
</div>




</td></tr>
<tr><td colspan="2">
<input type="submit" name="newsubmit" value="Save Project"></td></tr>
</table>
</form>

</div>
</div>

	

</body>
</html>