<?php
include_once('../connectdb.php');
session_start();

$cusid= $_POST['cus_id'];

$me = $_SESSION['me_code'];
$user = $_SESSION['me_fname'];
$brn = $_SESSION['me_brn'];
$class = $_POST['class_code'];
$product = $_POST['product'];
$risk = $_POST['risk'];
$risk = preg_replace('/[^A-Za-z0-9. -]/', '', $risk);
$current_insurer = $_POST['current_insurer'];
$sum_insured = $_POST['sum_insured'];
$premium = $_POST['premium'];
$renewal_date =date("d-M-Y",strtotime($_POST['policy_renewal_date']));
$followup_date =date("d-M-Y",strtotime($_POST['policy_followup_date']));
$road_tax = date("d-M-Y",strtotime($_POST['road_tax']));
$leasing_com = $_POST['leasing_com'];
$type_of_pros = $_POST['type_of_pros'];
$promotion = $_POST['promotion'];
$remarks = $_POST['remarks'];
$client = $_POST['user'];
$pol_num=$_POST['pol_num'];
$pol_sq=$_POST['pol_sq'];

//echo"<script>
//alert('$me'+'$user'+'$brn'+'$class'+'$product'+'$risk'+'$current_insurer'+'$sum_insured'+'$premium'+
//'$renewal_date'+'$followup_date'+'$road_tax'+'$leasing_com'+'$type_of_pros'+'$promotion'+'$remarks'+'$cusid'+'$client'+'$pol_num'+'$pol_sq');
//</script>";

//echo"<script>
//alert('$me'+'$user'+'$brn'+'$class'+'$product'+'$risk'+'$current_insurer'+'$sum_insured'+'$premium'+
//'$renewal_date'+'$followup_date'+'$road_tax'+'$leasing_com'+'$type_of_pros'+'$promotion'+'$remarks'+'$cusid'+'$client'+'$pol_num'+'$pol_sq');
//</script>";

//CHECKING TO RESTRICT TO INPUT SAME BUSINESS AND PRODUCT AND VEHCILE NUMBER

$sql_check="SELECT COUNT(a.mtb_seq)AS TOTAL_BUS from me_t_risks a
WHERE a.mtb_vehi_no='$risk' 
AND  a.mtb_product='$product'
and a.mtb_class='$class'
AND a.me_code='$me'
AND mtb_status='A'
AND mtb_bus_status='R'
";

$stm = oci_parse($conn, $sql_check);
oci_execute($stm);
if ($row = oci_fetch_assoc($stm)) {
    $tt_bus = $row['TOTAL_BUS'];
    if ($tt_bus > 0) {
        echo "0"; // Business already exists
    }

  else {
       $sql="INSERT INTO me_t_risks
       (mtb_mmc_id,
       mtb_vehi_no,
       mtb_insurer,
       mtb_sum_insured,
       mtb_premium,
       mtb_leasing_com,
       mtb_follow_up_date,
       mtb_pol_renewal_date,
       mtb_class,
       mtb_product,
       mtb_road_tax_date,
       mtb_sp_promotion_code,
       mtb_remarks,
       mtb_type_of_prospective,
       me_code,
       created_by,
       modified_by,
       created_date,
       mtb_status,
       mtb_insured_name,
       mtb_bus_status,
       mtb_pol_seq,
       mtb_pol_no)
       VALUES ('$cusid',
       '$risk',
       '$current_insurer',
       '$sum_insured',
       '$premium',
       '$leasing_com',
       '$followup_date',
       '$renewal_date',
       '$class',
       '$product',
       '$road_tax',
       '$promotion',
       '$remarks',
       '$type_of_pros',
       '$me',
       '$user',
       '$user',
       sysdate,
       'A',
       '$client',
       'R',
       '$pol_sq',
       '$pol_num'
       )";
      $stid = oci_parse($conn,$sql); 
      oci_execute($stid);
     if((oci_num_rows($stid) == true )){
      echo "1";
  }


   if($type_of_pros=="PROSPECTIVE"){
       $sqlcheck="SELECT * FROM me_m_customers WHERE mmc_id='$cusid'";
       $result=oci_parse($conn, $sqlcheck);
       oci_execute($result);
       while($row=oci_fetch_assoc($result))
       
       {
           $cus_id=$row['MMC_ID'];
           $title=$row['MMC_TITLE'];
           $fname=$row['MMC_FIRSTNAME'];
           $surname=$row['MMC_SURNAME'];
           $mobno=$row['MMC_MOBILENO'];
           $nic=$row['MMC_NICNO'];
           $number=$row['MMC_PHONENO'];
           $email=$row['MMC_EMAIL'];
           $address1=$row['MMC_ADDRESS1'];
           $address2=$row['MMC_ADDRESS2'];
           $address3=$row['MMC_ADDRESS3'];
           $city=$row['MMC_CITY'];
           $district=$row['MMC_DISTRICT'];
           $ocupation=$row['MMC_BUSINESS_OCC'];
           $referal_id=$row['MMC_REF_ID'];
   
   
       if(!empty($title)  && !empty($fname) && !empty($surname)  && !empty($mobno) && !empty($nic) && !empty($number) && !empty($email) && !empty($address1) && !empty($city) && !empty($district) && !empty($ocupation) ){
           //echo "All Data Filled";
           $sqlupdate="UPDATE me_m_customers SET mmc_status='I' WHERE mmc_id='$cusid'";
           $stidup = oci_parse($conn,$sqlupdate); 
           oci_execute($stidup);
           if((oci_num_rows($stidup) == true )){
               echo "All Details Filled .. Record Will Be Inactivate";
           }
       }
   
   }
   }






   }






 
 

}

?>





