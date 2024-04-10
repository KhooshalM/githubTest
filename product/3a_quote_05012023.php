<?php
//  PRODUCT 3A QUOTATION PAGE //


//addtional_loading()veh_no,customer_code,class,policy num, from_date ,to date,transaction type,basic premium
//difference_between_datepicker
$dif_date="select to_date('$end_date')-to_date('$start_date')DIF_PERIOD from dual";

$difr= oci_parse($conn,$dif_date);
oci_execute($difr);
while($row=oci_fetch_assoc($difr)){
  $no_days=$row['DIF_PERIOD'];
 // echo $dif_period;

//
 }



 //LOGIC FOR 
 if($medical=="Y" && $criticall=="Y" && $dif_period < 180){

  $medical="N";
  $criticall="N";
}


//echo "<br>";

//echo $prm;
//FIND BASIC PREMIUM
//FIND BASIC PREMIUM FOR 3A PRODUCT

$sql="select cicl.pkg_premium.bp_3a_premium('$yearofmake','$capacity','$brn')as PREMIUM from dual";

$sidwk = oci_parse($conn,$sql);
oci_execute($sidwk);

//echo $sidwk;
while($row=oci_fetch_assoc($sidwk)){
 $bp=$row['PREMIUM'];
 //echo $prm;
 //echo "<br>";

}  

       
//BASIC PREMIUM END




//find Loading in premium
$loading="select cicl.pkg_premium.addtional_loading('$vehino','ABC','$class','','','','N','$prm')as ADD_LOAD from dual";

$sidload = oci_parse($conn,$loading);
oci_execute($sidload);

//echo $sidwk;
while($row=oci_fetch_assoc($sidload)){

 $add_load=$row['ADD_LOAD'];
 //echo $add_load;
 //echo "<br>";

}  
//ADDTIONAL LOADING



//

//FIND EXTENSION PREMIUM
$extsql="select cicl.pkg_premium.ep_extension_premium('$start_date','$end_date','$bp')as EXT_PREMIUM from dual";
$extid = oci_parse($conn,$extsql);
oci_execute($extid);


while($row=oci_fetch_assoc($extid)){
 $ext_prm=$row['EXT_PREMIUM'];
 //echo $ext_prm;

}     
//END



//GET TOWING
$towing_sql="select cicl.pkg_premium.proc_towing('M3','$towing')as TOWING from dual";
$towingsid = oci_parse($conn,$towing_sql);
oci_execute($towingsid);


while($row=oci_fetch_assoc($towingsid)){
 $towing_prm=$row['TOWING'];

//echo $towing_prm;
}  


//GET MEDICAL/CRITICALL COVER PREMIUM


$cover="select cicl.pkg_premium.med_cri_premium('$start_date','$end_date','$medical','$criticall','$class')as CRI_MED from dual";
$oth_cover = oci_parse($conn,$cover);
oci_execute($oth_cover);

while($row=oci_fetch_assoc($oth_cover)){
    $cri_med=$row['CRI_MED'];
   
   //echo $cri_med;
   } 
  


//OTHER PREMIUM
$other_prm="select cicl.pkg_premium.other_premium('$prod_code','$capacity','$brn')as OTH_PRM from dual";
$oth_prm= oci_parse($conn,$other_prm);
oci_execute($oth_prm);

while($row=oci_fetch_assoc($oth_prm)){
    $oth=$row['OTH_PRM'];
 
   //echo $cri_med;
   } 


//POLICY FEE

$polfee="SELECT pro_amount
FROM uw_m_prod_oth_charges a
where pro_prd_code='$prod_code'";

$oth_fee= oci_parse($conn,$polfee);
oci_execute($oth_fee);

while($row=oci_fetch_assoc($oth_fee)){
    $polfees=$row['PRO_AMOUNT'];
 
   //echo $pol_fees;
   } 

//


//PASSENGER LIABILITY

$passenger="select cicl.pkg_premium.passenger_liability_premium('$seating_capacity','$prod_code')as PASSENGER from dual";
$pssenger_fees= oci_parse($conn,$passenger);
oci_execute($pssenger_fees);

while($row=oci_fetch_assoc($pssenger_fees)){
    $tl=$row['PASSENGER'];
 
  //
   } 

//



?>