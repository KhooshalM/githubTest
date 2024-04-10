<?php
include_once('connectdb.php');



$cus_id=strtoupper($_POST['cus_id']);
$title=strtoupper($_POST['title']);
$fname=strtoupper($_POST['fname']);
$surname=strtoupper($_POST['surname']);
$mobileno=strtoupper($_POST['mobileno']);
$phoneno=strtoupper($_POST['phoneno']);
$nic=strtoupper($_POST['nic']);
$email=strtoupper($_POST['email']);
$address1=strtoupper($_POST['address1']);
$address2=strtoupper($_POST['address2']);
$address3=strtoupper($_POST['address3']);
$source_of_fund=strtoupper($_POST['source_of_fund']);
$city=strtoupper($_POST['city']);
$district=strtoupper($_POST['district']);
$ocupation=strtoupper($_POST['ocupation']);

$referal=strtoupper($_POST['referal']);

if($referal=="N"){
    $referal_id="";
}
else{
    $referal_id=strtoupper($_POST['referal_id']);
}


$me_code=strtoupper($_POST['me_code']);
$username=strtoupper($_POST['me_username']);
$brn=strtoupper($_POST['me_brn']);
//echo $fname;





$update="UPDATE me_m_customers SET 
mmc_surname='$surname',
mmc_firstname='$fname',
mmc_nicno='$nic',
mmc_phoneno='$phoneno',
mmc_mobileno='$mobileno',
mmc_email='$email',
mmc_address1='$address1',
mmc_address2='$address2',
mmc_address3='$address3',
mmc_source_of_fund='$source_of_fund',
mmc_city='$city',
mmc_district='$district',
mmc_business_occ='$ocupation',
mmc_ref_id='$referal_id',
modify_date=sysdate,
modify_by='$username',
mmc_brn='$brn'
WHERE mmc_id='$cus_id'";




$stid = oci_parse($conn,$update); 
oci_execute($stid);
if((oci_num_rows($stid) == true )){
    echo '<script type="text/javascript">
    jQuery(function validation(){
    swal({
      title: "Transaction!",
      text: "Customer Update Succesfully!",
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





?>