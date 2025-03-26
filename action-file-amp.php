<?php
console.log("Check Point");
print "Here we go";
printf "Here we go";

// include("functions/functions-file.php");
// ​
// include("includes/connection.php");
// ​
// include("../CODES/ipost/signup/signup.php");
// include("../CODES/ipost/system_Info.php");
//$link=connection_db ();
​

​console.log("Check Point");
print "Here we go";
printf "Here we go";

if($_POST["EmailFrom"] == $_POST["EmailConfirm"] && $_POST["EmailFrom"]){
  console.log("Check Point 1");
  $project_id=$_POST["project_id"];
  $Sales_Force=$_POST["Sales_Force"];
  $Sales_Force = mysqli_real_escape_string($link, $Sales_Force);
  $Company_URL=$_POST["Company_URL_"];
  $Company_URL=mysqli_real_escape_string($link, $Company_URL);
  $SourceCode=$_POST["SourceCode"];
  $SourceCode=mysqli_real_escape_string($link, $SourceCode);
  $First_Name=$_POST["First_Name"];
  $First_Name=mysqli_real_escape_string($link, $First_Name);
  $Last_Name=$_POST["Last_Name"];
  $Last_Name=mysqli_real_escape_string($link, $Last_Name);
  $EmailFrom=$_POST["EmailFrom"];
  $EmailFrom=mysqli_real_escape_string($link, $EmailFrom);
  $EmailConfirm=$_POST["EmailConfirm"];
  $EmailConfirm=mysqli_real_escape_string($link, $EmailConfirm);
  $Phone=$_POST["Phone"];
  $Phone=mysqli_real_escape_string($link, $Phone);

  $AutoResponder=$_POST["AutoResponder"];
  $AutoResponder=mysqli_real_escape_string($link, $AutoResponder);

  $BestTime=$_POST["BestTime"];
  if($_POST["BestTime1"]||$_POST["BestTime2"]||$_POST["BestTime3"]||$_POST["BestTime4"]){

    $BestTime=$_POST["BestTime1"].'-'.$_POST["BestTime2"].'-'.$_POST["BestTime3"].'-'.$_POST["BestTime4"];
    }else{
      $BestTime=$_POST["BestTime"];

      }


  $BestTime=mysqli_real_escape_string($link, $BestTime);
  $Country=$_POST["Country"];
  $Country=mysqli_real_escape_string($link, $Country);
  $Comments=$_POST["Comments"];
  $Comments=mysqli_real_escape_string($link, $Comments);
  $SubscribeTo=$_POST["SubscribeTo"];
  $ThankYou=$_POST["ThankYou"];
  $SaleForce=$_POST['SaleForce'];





    /***Insert and update info leads**/
$fleads_id=get_email_leads_id($EmailFrom, $link);

  if($fleads_id!=="none"){

$fupdate_leads=update_email_leads($First_Name, $Last_Name, $EmailFrom, $Phone, $BestTime, $Country, $fleads_id, $link);

  $leads_id=$fleads_id;
    }else{

$finsert_leads=insert_email_leads ($First_Name, $Last_Name, $EmailFrom, $Phone, $BestTime,$Country, $link);

      }
      /***Insert and update info lead**/

      /***Insert Xource lead***/

 $fget_sourcecode_ID=get_SourceC_ID ($SourceCode, $link);

      if($fget_sourcecode_ID!=="none"){

        $SourceCodeId=$fget_sourcecode_ID;}else{

        $insertsource= insert_SourceCode($SourceCode, $link );
        }

        /***Insert Xource lead***/


$fproject_name=get_project_name($project_id, $link);
​
​
  /**insert lead project rel**/

$leads_id=get_email_leads_id($EmailFrom, $link);
​
$SourceCodeId=get_SourceC_ID ($SourceCode, $link);
​
$fLeads_To_Project=insert_into_Leads_To_Project_Rel($leads_id, $project_id, $SourceCodeId, $Comments, $link );
​
/**insert lead project rel**/
​
​
​
/**insert lead source rel**/
​
​
​
/**$SourceCodeId=get_SourceC_ID ($SourceCode, $link);
​
$exist_lead_source_real=if_exist_Leads_SourceC($SourceCodeId, $leads_id, $link);
​
​
if($exist_lead_source_real=="none"){
​
$fleads_SourceC_Rel=insert_Leads_SourceC($SourceCodeId, $leads_id, $link);
}**/
/**insert lead source rel**/
​
​
​
/**sales**/
if($SaleForce){
​
$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

   $oid = '00Di0000000gueC';





                        /* sourcecode checkbox*/
                      $sourcecodecheckbox = 1;
​
                        $params = 'first_name=' . $First_Name .
                                  '&last_name=' . $Last_Name .
                                  '&email=' . $EmailFrom .
                                  '&phone=' . $Phone .
                                  '&00Ni000000CRLdZ=' . $BestTime .
                                  '&country=' . $country .
                                  '&00Ni000000CSBJN=' . $Comments .
                                  '&lead_source=' . $SourceCode .
                                  '&'.$SaleForce .'=' . $sourcecodecheckbox .
                                  '&oid=' . $oid;



                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

                        $json_response = curl_exec($curl);

                       $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);



                        curl_close($curl);
​

}
​
​
   /**ipost**/
     $subclient = $_POST['subclient'];
     $formdesc=$SourceCode;
    $failurl=$ThankYou;

    if($subclient){

     $call = new signup();

    $Response = $call->Signup_Contact($EmailFrom, $SourceCode, $subclient, $formdesc,$ThankYou,$failurl);

    }

  /**************/

  if($AutoResponder)
    {

  $AutomationsArray = array
        (
          'Recipients' =>
          array
          (
            'Email' => $EmailConfirm,
            'Properties' => array()
          )
        );
​
      $PropertiesArray = array('GlobalEmailStatus' => true);
      $AutomationsArray['Recipients']['Properties'] = $PropertiesArray;

      $Automationparams = json_encode($AutomationsArray);

      $params =array
      (
          'client_id'=>'appuser@liveandinvestoverseas.com',
          'client_secret'=> 'E7sSY6wv'
      );
​
           $params = json_encode($params);

           $options = array
       (
             CURLOPT_URL => "https://g001.enterprise.ipost.com/api/v1/login/",
       CURLOPT_FRESH_CONNECT => 1,
             CURLOPT_RETURNTRANSFER => 1,
             CURLOPT_POSTFIELDS => $params
        );
​
           $curl = curl_init();
           curl_setopt_array($curl, $options);
​
           $response = json_decode(curl_exec($curl));
​
           $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $AuxToken = (object)$response;


          $options = array
        (
              CURLOPT_URL => "https://g001.enterprise.ipost.com/api/v1/liosfulfillment/automations/journey/". $AutoResponder . "/addContacts/",
          CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_RETURNTRANSFER => 1,
         CURLOPT_POSTFIELDS => $Automationparams,
        CURLOPT_HTTPHEADER => array('X-Auth-Token: ' .  $AuxToken->data->token , 'Content-Type: application/json')
          );
​
          $curl = curl_init();
          curl_setopt_array($curl, $options);
​
          $Response = json_decode(curl_exec($curl));
​
          $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      echo  "https://g001.enterprise.ipost.com/api/v1/liosfulfillment/automations/journey/". $AutoResponder . "/addContacts/";
      var_dump($http_status);
  }
   /**ipost**/
​
​


if($finsert_leads || $fLeads_To_Project){
  echo' <script type="text/javascript">
           window.location.href = "'.$ThankYou.'"
      </script>';
    exit();
  }


}else{

  echo' <script type="text/javascript">
           Javascript:history.back();
      </script>';
    exit();

  }
​
​
​
?>
