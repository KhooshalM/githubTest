<?php
include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 
 
error_reporting(0);


$bus_id =  strtoupper($_POST['bus_id']); //MTB_SEQ  - FROM  ME_T_RISK TABLE

$cus_id = strtoupper($_POST['cus_id']); // MMC_ID - FROM  CUSTOMER TABLE

$yom = strtoupper($_POST['yom']); // YEAR OF MAKE FIELD

$capacity = strtoupper($_POST['capacity']);

$suminsured = $_POST['suminsured'];

$fuel_type = strtoupper($_POST['fuel_type']); 

$engineno  = strtoupper($_POST['engineno']); 

$mileage = strtoupper($_POST['mileage']); 

$chassis = strtoupper($_POST['chassis']); 

$start_date =  date("d-M-Y", strtotime($_POST['start_date'])); //INSURANCE START PERIOD

$end_date =  date("d-M-Y", strtotime($_POST['end_date'])); //INSURANCE END PERIOD

$modeldesc = strtoupper($_POST['modeldesc']); 

$model_code = strtoupper($_POST['model_code']); 

$no_days = strtoupper($_POST['no_days']); 

$seating_capacity = strtoupper($_POST['seating_capacity']); 

$original_regist = date("d-M-Y", strtotime($_POST['original_regist']));

$mts_regist_date = date("d-M-Y", strtotime($_POST['mts_regist_date']));

$towing = strtoupper($_POST['towing']); 

$condition = strtoupper($_POST['condition_desc']);

$criticall = strtoupper($_POST['criticall']);

$kilotwat = strtoupper($_POST['kilotwat']);

$medical = strtoupper($_POST['medical']);

$total_prm = $_POST['total_prm'];

$polsts =$_POST['polsts']; // not yet added in table




$quot_check="SELECT mtb_seq FROM ME_T_QUOTATION WHERE mtb_seq='$bus_id'";
$stmt=oci_parse($conn,$quot_check); 
oci_execute($stmt);

while($row=oci_fetch_assoc($stmt))
                            
{
  $chk_quote=$row['MTB_SEQ']; 
  //echo $chk_quote;

}

if($chk_quote == ""){
 

$sql="INSERT into me_t_quotation (

mtb_seq,
mmc_id,
mtq_sum_ins,
mtq_yom,
mtq_capacity,
mtq_fuel_type,
mtq_mileage, 
mtq_chassis,
mtq_engine,
mtq_make_model,
mtq_ori_regist_date,
mtq_mts_regist_date,
mtq_period_form, 
mtq_period_to,
mtq_no_days,
mtq_seat_cap,
mtq_med, 
mtq_cri,
mtq_cond,
mtq_towing,
mtq_tot_prm,
mtq_quo_status,
mtq_uw_status,
created_date, 
created_by,
mtq_kw
)

VALUES 
(

 '$bus_id',
 '$cus_id',
 '$suminsured',
 '$yom',
 '$capacity',
 '$fuel_type',
 '$mileage',
 '$chassis',
 '$engineno',
 '$model_code',
 '$original_regist',
 '$mts_regist_date',
 '$start_date',
 '$end_date',
 '$no_days',
 '$seating_capacity',
 '$medical',
 '$criticall',
 '$condition',
 '$towing',
 '$total_prm',
 'A',
 'A',
 sysdate,
 '$user',
 '$kilotwat')";





$stid = oci_parse($conn,$sql); 
oci_execute($stid);

if((oci_num_rows($stid) == true )){
    echo "1";
 } else {
     echo "2";
   
 }
}

else {
    echo "3";
}


 


?>