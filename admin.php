<?php
require_once("includes/inc.session.php");
session_start();
include("includes/session-check.php");
include("includes/variables.php");
 include("includes/header.php");
include("includes/connection.php");


?>
<body>
<!--<script>
window.onload = function() {
    if (!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>-->
<?php
 
include("includes/menu.php");


?>

<div id="content" class="content" align="lef">

<div class="inner-content">
<h3><i class="fa fa-clipboard"></i>  Dashboard</h3>

<br><br>

<?php

include("includes/session-check.php");
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

  include("php-wrapper/fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

// Establish a connection to the database
//$dbhandle =  include("includes/connection.php");



 // Establish a connection to the database
 

 
 // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
 if ($dbhandle->connect_error) {
  exit("There was an error with your connection: ".$dbhandle->connect_error);
 }

$sql_rows=mysqli_query($dbhandle, "SELECT *, COUNT(Lead_Id), DATE_FORMAT(Info_Leads_To_Project_Rel.Date_Joined, '%b. %D, %Y')   FROM Info_Leads_To_Project_Rel
GROUP BY DATE_FORMAT(Info_Leads_To_Project_Rel.Date_Joined, '%b. %D, %Y')" );

  $total_rows=mysqli_num_rows($sql_rows);

  $offset = $total_rows-30;

$offset=abs($offset);
  // Form the SQL query that returns the top 10 most populous countries
  $strQuery = "SELECT *, COUNT(Lead_Id),DATE_FORMAT(Info_Leads_To_Project_Rel.Date_Joined, '%b. %D, %Y') FROM Info_Leads_To_Project_Rel
GROUP BY DATE_FORMAT(Info_Leads_To_Project_Rel.Date_Joined, '%b. %D, %Y')  
ORDER BY `Info_Leads_To_Project_Rel`.`Date_Joined` ASC   LIMIT ".$offset.",30"; 

 

  // Execute the query, or else return the error message.
  $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

  // If the query returns a valid response, prepare the JSON string
  if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
      "chart" => array(
          "caption" => "Lead Engagement Over Time",
          "paletteColors" => "#0075c2",
          "bgColor" => "#ffffff",
          "borderAlpha"=> "20",
          "canvasBorderAlpha"=> "0",
          "usePlotGradientColor"=> "0",
          "plotBorderAlpha"=> "10",
          "showXAxisLine"=> "1",
          "xAxisLineColor" => "#999999",
          "showValues" => "1",
          "divlineColor" => "#999999",
          "divLineIsDashed" => "1",
          "showAlternateHGridColor" => "0",
		  "numberscaleunit"=> "Names",
		  
		  "xAxisName"=> "Date Range",
          "yAxisName"=> "Names"
        )
    );

    $arrData["data"] = array();

    // Push the data into the array
    while($row = mysqli_fetch_array($result)) {
      array_push($arrData["data"], array(
          "label" => $row["DATE_FORMAT(Info_Leads_To_Project_Rel.Date_Joined, '%b. %D, %Y')"],
          "value" => $row["COUNT(Lead_Id)"]
          )
      );
    }

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

    $jsonEncodedData = json_encode($arrData);

    /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

    $columnChart = new FusionCharts("column2D", "myFirstChart" , 820, 400, "chart-1", "json", $jsonEncodedData);

    // Render the chart
    $columnChart->render();

    // Close the database connection
    $dbhandle->close();
  }
echo'<div id="chart-1"></div>';
?>


</div>
</div>

	

</body>
</html>