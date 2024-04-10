<?php
include_once('connectdb.php');
session_start();
$pol=strtoupper($_GET['polno']);

//echo $pol;


$sql="SELECT pol_policy_no, cus_indv_surname||' '||cus_indv_other_names as name, prs_name,sfc_code,sfc_brn_code,adr_city||' '||adr_street as addr,
pol_period_from,pol_period_to,pol_prd_code,pol_total_premium,pol_sum_insured
FROM uw_m_customers b,uw_t_pol_risks b,sm_m_sales_force b,uw_m_cust_addresses b,uw_t_policies

WHERE pol_cus_code=cus_code
AND pol_policy_no ='$pol'
AND prs_plc_pol_seq_no=POL_SEQ_NO
AND sfc_code=pol_marketing_executive_code
AND sfc_code=pol_marketing_executive_code
AND adr_seq_no=pol_adr_seq_no";

$result=oci_parse($conn,$sql);
oci_execute($result);
$row=oci_fetch_assoc($result);

$uwpolno=$row['POL_POLICY_NO'];
$uwname=$row['NAME'];
$risk=$row['PRS_NAME'];
$address=$row['ADDR'];
$pol_from=$row['POL_PERIOD_FROM'];
$pol_to=$row['POL_PERIOD_TO'];
$pol_type=$row['POL_PRD_CODE'];
$premium=$row['POL_TOTAL_PREMIUM'];
$sumins=$row['POL_SUM_INSURED'];


?>

<?php  if(oci_num_rows($result)>0) {  ?>
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
  <tr>
    <th>Policy No</th>
    <th>Name</th>
    <th>Risk</th>
    <th>Address</th>
    <th>Policy Period</th>
  </tr>
  <tr>
    <td><b><?php echo $uwpolno ?></b></td>
    <td><b><?php echo $uwname ?></b></td>
    <td><b><?php echo $risk ?></b></td>
    <td><b><?php echo $address?></b></td>
    <td><b><?php echo $pol_from .'-'. $pol_to ?></b></td>
    
  </tr>
 
</table>
</div>
<?php }  else { echo "NO DATA FOUND"; }?>
