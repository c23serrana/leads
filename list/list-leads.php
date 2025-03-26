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
    $( "#datepicker" ).datepicker({altField: "#datepicker",altFormat: "yy-mm-dd"});
  } );
  
  $( function() {
    $( "#datepicker2" ).datepicker({altField: "#datepicker2",altFormat: "yy-mm-dd"});
  } );
  </script>
  
  <script>
$(document).ready(function () {

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData>table'), 'export.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});

</script>

<body id="list-project">


<?php
 $lead_drop='default open';
include("../includes/menu.php");


?>

<div id="content" class="content" align="lef">

<div class="inner-content">
<h3><i class="fa fa-database"></i> Leads</h3>

<br><br>




<form action="#" method="post">
<p> Search 
<?php
/**form data**/
$_POST["submit"];
  $project_drop=$_POST["project-drop"];
	$project_drop=mysqli_real_escape_string($link, $project_drop);
	if($project_drop){
		
		$pro_name=mysqli_query($link,  "SELECT * FROM `Info_Projects`  WHERE Name LIKE '%".$project_drop."%'");
	
	 $pro_namerow = mysqli_fetch_array($pro_name);
	  $procode_ID=$pro_namerow["Project_Id"];
		
	$project_drop_sql='AND Info_Leads_To_Project_Rel.Project_Id ='.$procode_ID.'';
		
		}
	
	$yet = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
 $yesterday= date("Y-m-d", $yet);
 $tod = mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
  $today= date("Y-m-d", $tod);
 
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
  
  
?>

<input value="<?php  echo $project_drop; ?>" id="tags" type="text" name="project-drop" style="width:300px; height:35px;">  



From: <input value="<?php  echo $datefrom; ?>" type="text" id="datepicker" name="datefrom" style="width:150px; height:35px;"> To: <input value="<?php  echo $dateto; ?>" type="text" id="datepicker2" name="dateto" style="width:150px; height:35px;"> <button name="submit" type="submit" style="background:none; border:none; font-size:30px; color:#333;  margin: 0 0 0 10px; cursor:pointer;"><i class="fa fa-search"></i></button></p>
 
 </form>
<br><br>

<?php

 
echo '';
//Info_Leads_To_Project_Rel.Leads_To_ProjectId IN (SELECT MAX(Info_Leads_To_Project_Rel.Leads_To_ProjectId) FROM `Info_Leads_To_Project_Rel` GROUP BY Info_Leads_To_Project_Rel.Lead_Id) AND

$sql_10=mysqli_query($link,  "

SELECT * FROM `Info_Leads_To_Project_Rel`
INNER JOIN Info_Leads ON Info_Leads.Lead_Id = Info_Leads_To_Project_Rel.Lead_Id

WHERE 

 Info_Leads_To_Project_Rel.Date_Joined BETWEEN '".$datefrom."' AND '".$dateto."'
".$project_drop_sql."

ORDER BY `Info_Leads_To_Project_Rel`.`Date_Joined` DESC

");



if($_SESSION["Session"]=="true-admin"){
	 
	echo '<div style="margin-bottom:20px;">
<a href="#" class="export">Export Leads into Excel</a></div>';
	
	}

echo'

<div class="table100" id="dvData">



<table width="100%"   border="0" class="project-table1">
<thead>
<tr>
<td>First Name</td>
<td>Last Name</td>
<td>Email</td>
<td>Phone</td>
<td>Date Joined</td>
<td>Source Code</td>
<td>Project</td>
<td>Message</td>

</tr></thead>';
	
	 
	while($row_10 = mysqli_fetch_array($sql_10)){
	$first_N=$row_10["First_Name"];
	$last_N=$row_10["Last_Name"];
	$leadID=$row_10["Lead_Id"];	
	$lead=$row_10["Email_Leads"];
	$Phone=$row_10["Phone"];
	//$Project_Id=$row_10["Project_Id"];
	$Date_Joined=$row_10["Date_Joined"];
	//$SourceCodeId=$row_10["SourceCodeId"];
	$project_ID=$row_10["Project_Id"];
	$message=$row_10["Comments"];
	echo'<tr>
	
	<td>'.$first_N.' </td>
	<td>'.$last_N.' </td>
	
	<td>'.$lead.' </td>
	<td>'.$Phone.'</td>
	
	<td>'.$Date_Joined.'</td>
	
	<td>';
	 
$source_id=$row_10["SourceCodeId"];


	
	 $source_name=mysqli_query($link,  "SELECT * FROM `Info_SourceCode` WHERE SourceCodeId='$source_id'");
	
	 $source_namerow = mysqli_fetch_array($source_name);
	echo  $sourcecode_name=$source_namerow["SourceCode"];
	
	echo'</td>
	<td>';
	$pro_name=mysqli_query($link,  "SELECT * FROM `Info_Projects` WHERE Project_Id='$project_ID'");
	
	 $pro_namerow = mysqli_fetch_array($pro_name);
	echo  $procode_name=$pro_namerow["Name"];
	
	
	 
	echo '</td>
	<td>'.$message.'</td>
	</tr>';
	
	}
		
	echo'	
</table></div>'; 
  
 
?>



</div>
<br><br>&nbsp;
</div>

	

</body>
</html>