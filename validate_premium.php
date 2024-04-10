<?php


include_once('connectdb.php');

/*

$brn="CO";
$prod_code="1A";
$yearofmake=2010;
$capacity=1500;
$seating_capacity=5;
$bpx=2500;
$oth=700;
$model_code="M0005";
$type="N";
*/
//BEGIN :result := validate_min_premium(:p_branch, :p_prod, :p_yom, :p_ccap, :p_sc, :p_bp_ex_ep, :p_ad_prem); END;";

$oth_c=$cri_med+$oth;


$sqlv="BEGIN :result := PKG_PREMIUM.validate_min_premium(
    :BRN,
    :PROD,
    :YOM,
    :CC,
    :SC,
    :BPX,
    :OTH,
    :MCODE,
    :N_TYPE
        
      ); END; ";

    $sidwkv = oci_parse($conn, $sqlv);




    //INPUT
    oci_bind_by_name($sidwkv,':BRN',$brn,40);
    oci_bind_by_name($sidwkv, ':PROD',$prod_code,40);
    oci_bind_by_name($sidwkv, ':YOM', $yearofmake,40);
    oci_bind_by_name($sidwkv, ':CC', $capacity,40);
    oci_bind_by_name($sidwkv, ':SC', $seating_capacity,40);
    oci_bind_by_name($sidwkv,':BPX',$bpx,40);
    //oci_bind_by_name($sidwkv,':ADP',$cri_med,40);
    oci_bind_by_name($sidwkv,':OTH',$oth_c,40);
    oci_bind_by_name($sidwkv,':MCODE',$model_code,40);
    oci_bind_by_name($sidwkv,':N_TYPE',$type,40);
    //OUTPUT
   // oci_bind_by_name($sidwkv,':V_PRM',$validate_prm,40);
   oci_bind_by_name($sidwkv, ":result", $isValid, 100);

   oci_execute($sidwkv);
   //echo $isValid;



   /*
if($isValid !== "OK"){
    echo $isValid;
}
*/
// Check the result
// Check the result




 ?>
