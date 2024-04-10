<?php
include_once('connectdb.php');

$class_id=strtoupper($_POST['id']);

$output="";
$sql="SELECT prd_code,prd_cla_code,prd_description FROM uw_m_products WHERE prd_cla_code='$class_id' AND  prd_active='Y'";
$stid = oci_parse($conn,$sql); 
oci_execute($stid);

//oci_execute($stid);

$output .= '<option value="" disabled>Select Product</option>';
while($row=oci_fetch_assoc($stid)){
 
 $prd_code=$row['PRD_CODE'];  
 $prd_desc=$row['PRD_DESCRIPTION'];
 
  
  $output .='<option value="'.$prd_code.'"> '.$prd_desc.' - '.$prd_code.' </option>';
}
echo $output
?>  

