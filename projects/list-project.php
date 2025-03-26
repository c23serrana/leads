<?php
require_once("../includes/inc.session.php");
session_start();


include("../includes/session-check.php");
include("../includes/connection.php");
include("../includes/variables.php");
include("../includes/header.php");

?>
<link rel="stylesheet" href=" https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  -->
  
  

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<body id="list-project">
<?php
 $pro_drop='default open';
include("../includes/menu.php");


?>

<div id="content" class="content" align="lef">

<div class="inner-content">
<h3><i class="fa fa-tasks"></i>  Projects</h3>

<br><br>

<form action="#" method="post">
<p>
<?php
$_POST["submit"];
$project_drop=$_POST["project-drop"];
	$project_drop=mysqli_real_escape_string($link, $project_drop);
	if($project_drop){
		$project_drop_sql='WHERE  Info_Projects.Name like "%'.$project_drop.'%"';
		
		}
		
$url_drop= $_POST["url-project"];
$url_drop=mysqli_real_escape_string($link, $url_drop);
if($url_drop&&$project_drop_sql){
	$url_drop_sql='AND  Info_Projects.Project_Url like "%'.$url_drop.'%"';}elseif($url_drop){
	$url_drop_sql='WHERE  Info_Projects.Project_Url like "%'.$url_drop.'%"';
		}


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
?>
Name: <input value="<?php  echo $project_drop; ?>" id="tags" type="text" name="project-drop" style="width:300px; height:35px;">

URL: <input value="<?php  echo $url_drop;  ?>"   type="text" name="url-project" style="width:300px; height:35px;">



 <button name="submit" type="submit" style="background:none; border:none; font-size:30px; color:#333;  margin: 0 0 0 10px; cursor:pointer;"><i class="fa fa-search"></i></button> </p></form><br> 

 



<?php
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 25;
$offset = ($pageno-1) * $no_of_records_per_page;

$sql_rows=mysqli_query($link, "SELECT * FROM `Info_Projects` ".$project_drop_sql." ".$url_drop_sql."" );

$total_rows=mysqli_num_rows($sql_rows);
 $total_pages = ceil($total_rows / $no_of_records_per_page);



 
$sql_10=mysqli_query($link, "SELECT Info_Projects.Project_Id, Info_Projects.Name, Info_Projects.Project_Url,  COUNT(DISTINCT Info_Leads_To_Project_Rel.Lead_Id)  FROM `Info_Projects` LEFT OUTER JOIN Info_Leads_To_Project_Rel ON Info_Projects.Project_Id = Info_Leads_To_Project_Rel.Project_Id 
".$project_drop_sql."
".$url_drop_sql."
GROUP BY Info_Projects.Name ORDER BY `Info_Projects`.`Project_Id`  DESC LIMIT ".$offset.", ".$no_of_records_per_page."" );

echo'
<div class="table100">
<table width="100%"   border="0" class="project-table1">
<thead><tr><td width="30">&nbsp;</td><td width="50%">Name</td><td>ID</td><td>Total Leads</td><td>URL</td></tr></thead>';

 
 
	
	while($row_10 = mysqli_fetch_array($sql_10)){
		
	$Name=$row_10["Name"];
	$Project_Id=$row_10["Project_Id"];
	$project_url=$row_10["Project_Url"];
	$count=$row_10["COUNT(DISTINCT Info_Leads_To_Project_Rel.Lead_Id)"];
	
	
	
	
	echo'<tr><td><a href="/leads/projects/update-project.php?project_Id='.$Project_Id.'"><i class="fa fa-edit"></i>
	</a>
	
	</td><td>'.$Name.'</td><td>'.$Project_Id.'</td><td>'.$count.'</td><td>'.$project_url.'</td></tr>';
	
	}
	
echo'	
</table>';

 


echo'</div>';
	
	 
	
		
	 
 
 
?>

<ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>

<?php
echo " <ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) { 

 
if($pageno==$i){$disable='disabled';}else{$disable='';}


             echo "<li  class=".$disable."><a href='?pageno=".$i."'>".$i."</a></li>";  
};  
echo "</ul>";
?>



</div>
</div>

	

</body>
</html>