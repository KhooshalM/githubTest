<?php
include_once('connectdb.php');




$bus_id=strtoupper($_POST['bus_id']);

//$polno=strtoupper($_POST['polno']);
//$polseq=strtoupper($_POST['polseq']);
//echo $bus_id;


$sql="UPDATE me_t_risks SET mtb_status='F'
WHERE mtb_seq='$bus_id'";

$stid = oci_parse($conn,$sql); 
oci_execute($stid);

if((oci_num_rows($stid) == true )){
   echo "1";
} else {
    echo "2";
  
}

?>
