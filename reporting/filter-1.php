<?php
require_once("../includes/inc.session.php");
session_start();

include("../includes/session-check.php");
include("../includes/connection.php");
include("../includes/variables.php");
include("../includes/header.php");

?>
<link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  
  

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  
  
  $( function() {
    $( "#datepicker" ).datepicker({altField: "#datepicker",altFormat: "yy-mm-dd 00:00"});
  } );
  
  $( function() {
    $( "#datepicker2" ).datepicker({altField: "#datepicker2",altFormat: "yy-mm-dd 23:00"});
  } );
  </script>

<body id="list-project">


<?php
 
include("../includes/menu.php");


?>

<div id="content" class="content" align="lef">

<div class="inner-content">
<h3><i class="fa fa-pie-chart"></i> Filter #1</h3>

<br><br>




<form action="#" method="post">
<p> Search 
<?php
/**form data**/
$_POST["submit"];
if($_POST["SourceCode"]){
$source_drop=$_POST["SourceCode"];
$source_drop=mysqli_real_escape_string($link, $source_drop);

$sql_namesc=mysqli_query($link,  "SELECT * FROM `Info_SourceCode` WHERE SourceCode LIKE '%".$source_drop."%' ");

$SourceCodeIdsql='';
$SourceCodeIdsql .='AND (';

while($row_namec = mysqli_fetch_array($sql_namesc))
{$SourceCodeId=$row_namec["SourceCodeId"];

  $SourceCodeIdsql.="Info_Leads_To_Project_Rel.SourceCodeId ='".$SourceCodeId."' OR ";
}
 $SourceCodeIdsql .="Info_Leads_To_Project_Rel.SourceCodeId ='0')";
}


$project_drop=$_POST["project-drop"];
	$project_drop=mysqli_real_escape_string($link, $project_drop);
	if($project_drop){
	 	$project_drop_sql='AND  Info_Projects.Name like "%'.$project_drop.'%"';
		
		}
	
	$yet = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
 $yesterday= date("Y-m-d 00:00", $yet);
 $tod = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  $today= date("Y-m-d 23:00", $tod);
 
 	$datefrom=$_POST["datefrom"];
	
	if($datefrom){$datefrom=$_POST["datefrom"];}else{$datefrom=$yesterday;}
	
	
	$dateto=$_POST["dateto"];
	if($dateto){$dateto=$_POST["dateto"];}else{$dateto=$today;}
	
	/**form data**/
$sql_names=mysqli_query($link,  "SELECT * FROM `Info_Projects` ");
echo '<script>
  $( function() {
    var availableTags = [';
while($row_name = mysqli_fetch_array($sql_names)){
	
	
	 $name_pro=$row_name["Name"];
	$name_pro= mysqli_real_escape_string($link, $name_pro);
	echo '"'.$name_pro.'"'.', ';
	
	
	
}

echo' ];

    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>';
  
  
 /**form data source**/
$sql_namesc=mysqli_query($link,  "SELECT DISTINCT SourceCode FROM `Info_SourceCode` ");
echo '<script>
  $( function() {
    var availableTags = [';
while($row_namec = mysqli_fetch_array($sql_namesc)){
	
	
	 $name_sou=$row_namec["SourceCode"];
	$name_sou= mysqli_real_escape_string($link, $name_sou);
	echo '"'.$name_sou.'"'.', ';
	
	
	
}

echo' ];

    $( "#tagssource" ).autocomplete({
      source: availableTags
    });
  } );
  </script>'; 
 
  
  
?>

<input value="<?php  echo $project_drop; ?>" id="tags" type="text" name="project-drop" style="width:350px; height:35px;">  

<br>
<br>
From: &nbsp;<input value="<?php  echo $datefrom; ?>" type="text" id="datepicker" name="datefrom" style="width:150px; height:35px;"> To: <input value="<?php  echo $dateto; ?>" type="text" id="datepicker2" name="dateto" style="width:150px; height:35px;"> 

SourceCode <input value="<?php  echo $source_drop;  ?>" type="text" id="tagssource" name="SourceCode" style="width:150px; height:35px;">

<button name="submit" type="submit" style="background:none; border:none; font-size:30px; color:#333;  margin: 0 0 0 10px; cursor:pointer;"><i class="fa fa-search"></i></button></p>
 
 </form>
<br><br>

<?php

 /**echo "SELECT *, count(DISTINCT Info_Leads.Lead_Id) FROM `Info_Leads` 
INNER JOIN Info_Leads_To_Project_Rel ON Info_Leads.Lead_Id = Info_Leads_To_Project_Rel.Lead_Id
INNER JOIN Info_Projects ON Info_Leads_To_Project_Rel.Project_Id = Info_Projects.Project_Id
WHERE Info_Leads_To_Project_Rel.Date_Joined BETWEEN '".$datefrom."' AND '".$dateto."'
".$project_drop_sql."
".$SourceCodeIdsql."
GROUP BY Info_Leads_To_Project_Rel.Project_Id, Info_Leads_To_Project_Rel.SourceCodeId
ORDER BY `Info_Leads_To_Project_Rel`.`Date_Joined` Desc";**/


$sql_10=mysqli_query($link,  "

SELECT *, count(DISTINCT Info_Leads.Lead_Id) FROM `Info_Leads` 
INNER JOIN Info_Leads_To_Project_Rel ON Info_Leads.Lead_Id = Info_Leads_To_Project_Rel.Lead_Id
INNER JOIN Info_Projects ON Info_Leads_To_Project_Rel.Project_Id = Info_Projects.Project_Id
WHERE Info_Leads_To_Project_Rel.Date_Joined BETWEEN '".$datefrom."' AND '".$dateto."'

".$project_drop_sql."
".$SourceCodeIdsql."
GROUP BY Info_Leads_To_Project_Rel.Project_Id, Info_Leads_To_Project_Rel.SourceCodeId
ORDER BY `Info_Leads_To_Project_Rel`.`Date_Joined` Desc");



echo'
<div class="table100">
<table width="100%"   border="0" class="project-table1">
<thead>
<tr>
<td>ID#</td>
<td>Project</td>
<td>Source Code</td>
<td>Count</td>

</tr></thead>';
	
	 
	while($row_10 = mysqli_fetch_array($sql_10)){
	 
	 
	$Project_Id=$row_10["Project_Id"];
	
	$SourceCodeId=$row_10["SourceCodeId"];
	$project_name=$row_10["Name"];
	$count_l=$row_10["count(DISTINCT Info_Leads.Lead_Id)"];
	echo'
	<tr><td>'.$Project_Id.' </td>
 
	<td>'.$project_name.'</td>
	
	<td>';
	
	 $source_name=mysqli_query($link,  "SELECT * FROM `Info_SourceCode` WHERE SourceCodeId='$SourceCodeId'");
	
	 $source_namerow = mysqli_fetch_array($source_name);
	echo  $sourcecode_name=$source_namerow["SourceCode"];
	
	echo'</td>
	<td>'.$count_l.'</td></tr>';
	
	}
		
	echo'	
</table></div>'; 
  
 
?>



</div>
<br><br>&nbsp;
</div>

	

</body>
</html>