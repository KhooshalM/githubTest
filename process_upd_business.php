<?php
include_once('connectdb.php');


$cus_id=strtoupper($_POST['cus_id']);
$bus_id=strtoupper($_POST['bus_id']);
$class=strtoupper($_POST['pclass']);
$product=strtoupper($_POST['product']);
$risks=strtoupper($_POST['risks']);
$current_insurer=strtoupper($_POST['current_insurer']);
$sum_insured=$_POST['sum_insured'];
$premium=$_POST['premium'];
$policy_renewal_date= date("d-M-Y", strtotime($_POST['policy_renewal_date']));  
$datepicker_follow_up= date("d-M-Y", strtotime($_POST['datepicker_follow_up']));  
$road_tax= date("d-M-Y", strtotime($_POST['road_tax'])); 
$leasing_com=strtoupper($_POST['leasing_com']);
$promotion=strtoupper($_POST['promotion']);
$type_of_pros=strtoupper($_POST['type_of_pros']);
$remarks=strtoupper($_POST['remarks']);
$user=strtoupper($_POST['user']);


$update="UPDATE me_t_risks SET 
mtb_vehi_no='$risks',
mtb_insurer='$current_insurer',
mtb_sum_insured='$sum_insured',
mtb_premium='$premium',
mtb_leasing_com='$leasing_com',
mtb_follow_up_date='$datepicker_follow_up',
mtb_pol_renewal_date='$policy_renewal_date',
mtb_class='$class',
mtb_product='$product',
mtb_road_tax_date='$road_tax',
mtb_sp_promotion_code='$promotion',
mtb_remarks='$remarks',
mtb_type_of_prospective='$type_of_pros',
modified_by='$user',
modified_date=sysdate
WHERE mtb_seq='$bus_id'";



$stid = oci_parse($conn,$update); 
oci_execute($stid);
if((oci_num_rows($stid) == true )){
    echo '<script type="text/javascript">
    jQuery(function validation(){
    swal({
      title: "Transaction!",
      text: "Business Update Succesfully!",
      icon: "success",
     
    });
});
</script>';

} else {
    echo '<script type="text/javascript">
                            jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Update Not Sucessfull",
                              icon: "error",
                              button: "Ok",
                            });
                        });
                        </script>';
}

if($type_of_pros=="PROSPECTIVE"){
  $sqlcheck="SELECT * FROM me_m_customers WHERE mmc_id='$cus_id'";
  $result=oci_parse($conn, $sqlcheck);
  oci_execute($result);
  while($row=oci_fetch_assoc($result))
  
  {
      $cus_id=$row['MMC_ID'];
      $title=$row['MMC_TITLE'];
      $fname=$row['MMC_FIRSTNAME'];
      $surname=$row['MMC_SURNAME'];
      $mobno=$row['MMC_MOBILENO'];
      $nic=$row['MMC_NICNO'];
      $number=$row['MMC_PHONENO'];
      $email=$row['MMC_EMAIL'];
      $address1=$row['MMC_ADDRESS1'];
      $address2=$row['MMC_ADDRESS2'];
      $address3=$row['MMC_ADDRESS3'];
      $city=$row['MMC_CITY'];
      $district=$row['MMC_DISTRICT'];
      $ocupation=$row['MMC_BUSINESS_OCC'];
      $referal_id=$row['MMC_REF_ID'];


  if(!empty($title)  && !empty($fname) && !empty($surname)  && !empty($mobno) && !empty($nic) && !empty($number) && !empty($email) && !empty($address1) && !empty($city) && !empty($district) && !empty($ocupation) ){
      //echo "All Data Filled";
      $sqlupdate="UPDATE me_m_customers SET mmc_status='I' WHERE mmc_id='$cus_id'";
      $stidup = oci_parse($conn,$sqlupdate); 
      oci_execute($stidup);
      if((oci_num_rows($stidup) == true )){
          echo "All Details Filled .. Record Will Be Inactivate";
      }
  }

}
}




?>