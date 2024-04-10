<?php 

include_once('connectdb.php');
error_reporting(0);
session_start();
$pol=$_POST['polno'];

$cust_name=$_POST['custname'];
//echo $cust_name;


$sql="SELECT a.mmc_id,a.mmc_firstname||' '|| a.mmc_surname AS NAME, a.mmc_initials,
a.mmc_title, a.mmc_nicno, a.mmc_phoneno, a.mmc_mobileno,
a.mmc_email, a.mmc_address1, a.mmc_address2, a.mmc_address3,
a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
a.modify_date, a.mmc_status, a.mmc_brn, a.mmc_source_of_fund
FROM me_m_customers a
WHERE a.mmc_firstname||' '|| a.mmc_surname   LIKE '%$cust_name%'";

$result_det=oci_parse($conn,$sql);
oci_execute($result_det);
        while($row1=oci_fetch_assoc($result_det))
{       

  echo   $name=$row3['NAME'];



}

?>