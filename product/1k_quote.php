<?php
//  PRODUCT 1K QUOTATION PAGE //






 
//echo $condition;
//echo "<br>";
//echo $original_regist;


//FIND LEVEL OF MAKE AND MODEL
$sqllevel="SELECT  a.rft_type, a.rft_code, a.rft_description, a.rft_seq_no,
a.rft_print_desc, a.rft_warranty_1, a.rft_warranty_2,
a.rft_warranty_3, a.rft_level, a.rft_category, a.rft_min_premium,
a.rft_age_lmt
FROM cm_r_reference_two a
where rft_code='$model_code'";

$stidlevel = oci_parse($conn,$sqllevel);
oci_execute($stidlevel);

if($row=oci_fetch_assoc($stidlevel)){
    $level=$row['RFT_LEVEL'];
    $waranty1=$row['RFT_WARRANTY_1'];
    $waranty2=$row['RFT_WARRANTY_2'];
    $waranty3=$row['RFT_WARRANTY_3'];
    $category=$row['RFT_CATEGORY'];
    $allwaranty = $waranty1.' | '.$waranty2.' | '.$waranty3;
    //echo $allwaranty;
    //echo $waranty1;
 //echo $level;
 //echo "<br>";
  //
   } 



$cus="";
$pol="";
//$type="N";
$ctc="";
$towing="Y";



$sql=" BEGIN
PKG_PREMIUM.TOTAL_PREMIUM_1K(
   :SI,
   :CAT,
   :YOM,
   :CC,
   :BRN,
   :VEH,
   :CUS,
   :CLASS,
   :POL,
   :P_FROM,
   :P_TO,
   :P_TYPE,
   :TOW,
   :MED,
   :CRI,
   :PROD,
   :SC,
   :MIL,
   :MCODE,
   :OREG,
   :MREGDATE,
   :VEHCOND,
   
   :BP,:ADLOA,:NC,  :EP,  :TW,  :MED_CRI,  :OTH,  :VIP,  :TL,  :V_POLICY_FEE,  :TOT_PREM, :NO_DAYS,:C_MED_STATUS,:C_CRI_STATUS,:HRL);
   
END;";

$sidwk = oci_parse($conn,$sql);

 
//INPUT VARIABLE
oci_bind_by_name($sidwk, ':SI', $suminsured);
oci_bind_by_name($sidwk, ':CAT', $category);
oci_bind_by_name($sidwk, ':YOM', $yearofmake);
oci_bind_by_name($sidwk, ':CC', $capacity);
oci_bind_by_name($sidwk, ':BRN', $brn);
oci_bind_by_name($sidwk, ':VEH', $vehino);
oci_bind_by_name($sidwk, ':CUS', $cus);
oci_bind_by_name($sidwk, ':CLASS',$class);
oci_bind_by_name($sidwk, ':POL',$pol);
oci_bind_by_name($sidwk, ':P_FROM',$start_date);
oci_bind_by_name($sidwk, ':P_TO',$end_date);
oci_bind_by_name($sidwk, ':P_TYPE',$type);
oci_bind_by_name($sidwk, ':TOW',$towing);
oci_bind_by_name($sidwk, ':MED',$medical);
oci_bind_by_name($sidwk, ':CRI',$criticall);
oci_bind_by_name($sidwk, ':PROD',$prod_code);
oci_bind_by_name($sidwk, ':SC',$seating_capacity);
oci_bind_by_name($sidwk, ':MIL',$mileage);
oci_bind_by_name($sidwk, ':MCODE',$model_code);
oci_bind_by_name($sidwk, ':OREG',$original_regist);
oci_bind_by_name($sidwk, ':MREGDATE',$mts_regist_date);
oci_bind_by_name($sidwk, ':VEHCOND',$condition);

//OUTPUT VARIABLE
oci_bind_by_name($sidwk,':BP',$bp,40);
oci_bind_by_name($sidwk,':ADLOA',$add_load,40);
oci_bind_by_name($sidwk,':NC',$no_clm,40);
oci_bind_by_name($sidwk,':EP',$ext_prm,40);
oci_bind_by_name($sidwk,':TW',$towing_prm,40);
oci_bind_by_name($sidwk,':MED_CRI',$cri_med,40);
oci_bind_by_name($sidwk,':OTH',$oth,40);
oci_bind_by_name($sidwk,':VIP',$vip,40);
oci_bind_by_name($sidwk,':TL',$tl,40);
oci_bind_by_name($sidwk,':V_POLICY_FEE',$polfees,40);
oci_bind_by_name($sidwk,':TOT_PREM',$total_prm,40);
oci_bind_by_name($sidwk,':NO_DAYS',$no_days,40);
oci_bind_by_name($sidwk,':C_MED_STATUS',$medical,40);
oci_bind_by_name($sidwk,':C_CRI_STATUS',$criticall,40);


oci_bind_by_name($sidwk,':HRL',$hrl,40);


$no_days=$no_days-1;
oci_execute($sidwk);



?>
