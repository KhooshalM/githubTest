<?php
$brn="CO";
$prod_code="1A";
$yearofmake=2020;
$capacity=1500;
$seating_capacity=5;
$bp=15300;
$oth=700;
$type="N";





$sqlc="BEGIN :result_x := PKG_PREMIUM.validate_1a_premium(
    :BRN,
    :PROD,
    :YOM,
    :MCODE,
    :BPX,
    :T_TYPE); END; ";

    $sidwk_x = oci_parse($conn, $sqlc);
//INPUT
oci_bind_by_name($sidwk_x,':BRN',$brn,40);
oci_bind_by_name($sidwk_x, ':PROD',$prod_code);
oci_bind_by_name($sidwk_x, ':YOM', $yearofmake);
oci_bind_by_name($sidwk_x, ':MCODE', $model_code);
oci_bind_by_name($sidwk_x,':BPX',$bpx,40);
oci_bind_by_name($sidwk_x,':T_TYPE',$type,40);

oci_bind_by_name($sidwk_x, ":result_x", $Validate_1a, 100);

if (!oci_execute($sidwk_x)) {
    $error = oci_error($sidwk_x);
    die("Error executing query: " . $error['message']);
}

if($Validate_1a !== ""){
    echo $Validate_1a ;
  
    exit;
  }
  // Check the result
?>