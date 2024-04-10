<?php


include_once('connectdb.php');


//error_reporting(0);
session_start();
$me_code=$_SESSION['me_code'];
$polno=$_POST['polno'];
//$bus_id=$_POST['bus_id'];
$polseq=$_POST['polseq'];
$cusid=$_POST['cusid'];

/*
$check="SELECT FROM me_r_finalise WHERE mf_pol_seq='$polseq'";
$stidc = oci_parse($conn,$check); 
oci_execute($stidc);

if($row=oci_fetch_assoc($stidc))
                            
{
  $chk_polseq=$row['MF_POL_SEQ'];
}


if($chk_polseq>0){
    echo "3";
}
else{
    */
$sql="INSERT into me_r_finalise
(
mf_pol_no,
mf_contact_id,
mf_status,
created_date,
created_by,
mf_pol_seq
) 
VALUES
(
'$polno',
'$cusid',
'A',
sysdate,
'$me_code',
'$polseq')";

$stid = oci_parse($conn,$sql); 
oci_execute($stid);

if((oci_num_rows($stid) == true )){
    echo "1";
} else {
    echo "2";
   
}


//}//check if else end


?>