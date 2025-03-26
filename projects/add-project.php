<?php
require_once("../includes/inc.session.php");
session_start();

include("../includes/session-check.php");
include("../includes/connection.php");
include("../includes/variables.php");
include("../includes/header.php");

?>
  <script type='text/javascript'>
       $(document).ready(function() {
        var max_fields      = 10;
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
				 
$(wrapper).append('<div><br><input type="text" name="mytext'+ x +'"/><a href="#" class="delete">&nbsp;Delete</a></div>'); //add input box
            }
      else
      {
      alert('You Reached the limits')
      }
        });

        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>

<body>
<?php
$pro_drop='default open';
include("../includes/menu.php");


?>

<div id="content" class="content" align="lef">

<div class="inner-content">
<h3><i class="fa fa-tasks"></i>  Add New Project</h3>

<br><br>

<form id="add-project" action="#" method="post" >
<?php

echo 'Project: '.$_POST["name-pro"].' has been added';

 if($_POST["name-pro"]){$display='none';}

?>

<table width="100%" style="display:<?php  echo $display;?>;">
<tr><td width="25%">
Name: </td><td width="35%"><input name="name-pro" type="text" width="100%"> </td></tr>
<!--<tr><td>
Sale Force Code: </td><td> <input name="sales-force" type="text" width="100%"></td></tr>-->
<tr><td>
Project URL: </td><td> <input name="project-url" type="text" width="100%"></td></tr>

<tr><td colspan="2" ></td></tr>

<tr><td valign="top">
E-mail notification recipients: </td><td> 

<div class="container1">

<div><input type="text" name="mytext1"></div>
<button class="add_form_field">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button><br>
</div>




</td></tr>
<tr><td colspan="2">
<input type="submit" name="newsubmit" value="Save Project"></td></tr>
</table>
</form>

<?php
 
if($_POST["newsubmit"]) {
	
	$name_pro=$_POST["name-pro"];
	$name_pro = mysqli_real_escape_string($link, $name_pro);
	
	$project_url=$_POST["project-url"];
	$project_url = mysqli_real_escape_string($link, $project_url);
	
	if($name_pro ||  $project_url){
		$sql_pj=mysqli_query($link, "INSERT INTO `Info_Projects`(`Name`, `Project_Url`) VALUES ('$name_pro','$project_url')"  ); 
	
	 
		
		}
		
		
	$sql_pjId=mysqli_query($link, "SELECT * FROM `Info_Projects` WHERE  `Name` ='$name_pro' ");
	$row_pjId = mysqli_fetch_array($sql_pjId);
	 $Project_Id=$row_pjId["Project_Id"];
	 
	
	
	if($mytext1=$_POST["mytext1"]){
		$mytext1=mysqli_real_escape_string($link, $mytext1);
		
		$mytext1_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext1')"  ); 
				
		}
	if($mytext2=$_POST["mytext2"]){
		$mytext2=mysqli_real_escape_string($link, $mytext2);
		$mytext2_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext2')"  ); }
	
	if($mytext3=$_POST["mytext3"]){
		$mytext3=mysqli_real_escape_string($link, $mytext3);
		$mytext3_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext3')"  ); }
	
	if($mytext4=$_POST["mytext4"]){
		$mytext4=mysqli_real_escape_string($link, $mytext4);
		$mytext4_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext4')"  ); }	
	
	if($mytext5=$_POST["mytext5"]){
		$mytext5=mysqli_real_escape_string($link, $mytext5);
		$mytext5_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext5')"  ); }
	
	if($mytext6=$_POST["mytext6"]){
		$mytext6=mysqli_real_escape_string($link, $mytext6);
		$mytext6_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext6')"  ); }
	
	if($mytext7=$_POST["mytext7"]){
		$mytext7=mysqli_real_escape_string($link, $mytext7);
		$mytext7_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext7')"  ); }
			
	if($mytext8=$_POST["mytext8"]){
		$mytext8=mysqli_real_escape_string($link, $mytext8);
		$mytext8_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext8')"  ); }
	
	if($mytext9=$_POST["mytext9"]){
		$mytext9=mysqli_real_escape_string($link, $mytext9);
		$mytext9_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext9')"  ); }
	
	if($mytext10=$_POST["mytext10"]){
		$mytext10=mysqli_real_escape_string($link, $mytext10);
		$mytext10_insert=mysqli_query($link, "INSERT INTO `Info_Recipients`
	(`Project_Id`, `Recipients`) VALUES ('$Project_Id', '$mytext10')"  ); }
		
	
	
	
	
	}

?>


</div>
</div>

	

</body>
</html>