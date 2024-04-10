<?php
include_once('connectdb.php');




$cus_id=strtoupper($_POST['cus_id']);


$sql="UPDATE me_m_customers SET mmc_status='I'
WHERE mmc_id='$cus_id'";

$stid = oci_parse($conn,$sql); 
oci_execute($stid);

if((oci_num_rows($stid) == true )){
   echo "1";
} else {
    echo "2";
  
}

?>