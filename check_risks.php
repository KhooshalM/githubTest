<?php
include_once('connectdb.php');





$risks=$_POST['risks'];

$sqlcheck="SELECT pol_policy_no, cus_indv_surname,cus_indv_other_names, prs_name,sfc_code,sfc_brn_code,adr_city,adr_street,cus_phone_1,cus_phone_2

FROM uw_m_customers,uw_t_pol_risks,sm_m_sales_force,uw_m_cust_addresses,uw_t_policies


WHERE pol_cus_code=cus_code
AND prs_plc_pol_seq_no=POL_SEQ_NO
AND sfc_code=pol_marketing_executive_code
AND adr_seq_no=pol_adr_seq_no
AND pol_status IN ('4','5')
AND 
--pol_policy_no='CO183A003763'
prs_name='$risks'";

$stid = oci_parse($conn,$sqlcheck); 
oci_execute($stid);

while($row=oci_fetch_assoc($stid)){
$risks=$row['PRS_NAME'];
//echo $risks;


}
if((oci_num_rows($stid) > 0 )){
    echo "VEHICLE  ALREADY INSURED";
}

?>

