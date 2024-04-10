<?php
include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 
 

error_reporting(0);



$quo_seq =  strtoupper($_POST['quo_seq']); //QUOTATION _SEQ  - FROM  ME_T_QUOTATION


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




$sql="UPDATE  me_t_quotation SET 
mtq_sum_ins='$suminsured',
mtq_yom='$yom',
mtq_capacity='$capacity',
mtq_fuel_type='$fuel_type',
mtq_mileage='$mileage', 
mtq_chassis='$chassis',
mtq_engine='$engineno',
mtq_make_model='$model_code',
mtq_ori_regist_date='$original_regist',
mtq_mts_regist_date='$mts_regist_date',
mtq_period_form='$start_date', 
mtq_period_to='$end_date',
mtq_no_days='$no_days',
mtq_seat_cap='$seating_capacity',
mtq_med='$medical', 
mtq_cri='$criticall',
mtq_cond='$condition',
mtq_towing='$towing',
mtq_tot_prm='$total_prm',
mtq_quo_status='A',
mtq_uw_status='A',
modified_date=sysdate, 
modified_by='$user',
mtq_kw='$kilotwat'
WHERE mtq_quo_seq='$quo_seq'";





$stid = oci_parse($conn,$sql); 
oci_execute($stid);
//echo $stid;


if((oci_num_rows($stid) == true )){
    echo "1";
 } 
 else {
     echo "2";
   
 }



 


?>