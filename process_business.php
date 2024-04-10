<?php
include_once('connectdb.php');


$cus_id=strtoupper($_POST['cus_id']);
$pr_class=strtoupper($_POST['pr_class']);

$product=strtoupper($_POST['product']);

$risks=strtoupper($_POST['risks']);
$risks = preg_replace('/[^A-Za-z0-9. -]/', '', $risks);

$insured_name=strtoupper($_POST['insured_name']);
$bus_status=strtoupper($_POST['bus_status']);
$current_insurer=strtoupper($_POST['current_insurer']);
$sum_insured=strtoupper($_POST['sum_insured']);
$premium=strtoupper($_POST['premium']);
//$policy_renewal=strtoupper($_POST['policy_renewal']);
$policy_renewal= date("d-M-Y", strtotime($_POST['policy_renewal']));   

//$follow_up=strtoupper($_POST['follow_up']);
$follow_up= date("d-M-Y", strtotime($_POST['follow_up']));  

//$road_tax=strtoupper($_POST['road_tax']);
$road_tax= date("d-M-Y", strtotime($_POST['road_tax'])); 

$leasing_com=strtoupper($_POST['leasing_com']);
$sp_promotion=strtoupper($_POST['sp_promotion']);
$type_of_pros=strtoupper($_POST['type_of_pros']);
$remarks=strtoupper($_POST['remarks']);
$me_code=strtoupper($_POST['me_code']);
$me_username=strtoupper($_POST['me_username']);

//CHECKING TO RESTRICT TO INPUT SAME BUSINESS AND PRODUCT AND VEHCILE NUMBER
 $sql_check="SELECT COUNT(a.mtb_seq)AS TOTAL_BUS from me_t_risks a
 WHERE a.mtb_vehi_no='$risks' 
 AND  a.mtb_product='$product'
 and a.mtb_class='$pr_class'
 AND a.me_code='$me_code'
 AND mtb_status='A'
 AND mtb_bus_status='N'
 ";

$stm=oci_parse($conn, $sql_check);
oci_execute($stm);
if($row=oci_fetch_assoc($stm)){

    $tt_bus=$row['TOTAL_BUS'];
    // echo $tt_bus;

    if($tt_bus > 1 ){

        echo "0";
    }

    else {

        $sql="INSERT INTO me_t_risks
        (mtb_mmc_id,mtb_vehi_no,mtb_insurer,mtb_sum_insured,mtb_premium,mtb_leasing_com,mtb_follow_up_date,mtb_pol_renewal_date,mtb_class,mtb_product,mtb_road_tax_date,mtb_sp_promotion_code,mtb_remarks,mtb_type_of_prospective,me_code,created_by,modified_by,created_date,mtb_status,mtb_insured_name,mtb_bus_status)
        VALUES ('$cus_id','$risks','$current_insurer','$sum_insured','$premium','$leasing_com','$follow_up','$policy_renewal','$pr_class','$product','$road_tax','$sp_promotion','$remarks','$type_of_pros','$me_code','$me_username','$me_username',sysdate,'A','$insured_name','$bus_status')";
        $stid = oci_parse($conn,$sql); 
        oci_execute($stid);
       if((oci_num_rows($stid) == true )){
        echo "1";
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






    }





 
  
  

}





/*
$sql="INSERT INTO me_t_risks
(mtb_mmc_id,mtb_vehi_no,mtb_insurer,mtb_sum_insured,mtb_premium,mtb_leasing_com,mtb_follow_up_date,mtb_pol_renewal_date,mtb_class,mtb_product,mtb_road_tax_date,mtb_sp_promotion_code,mtb_remarks,mtb_type_of_prospective,me_code,created_by,modified_by,created_date,mtb_status)
VALUES ('$cus_id','$risks','$current_insurer','$sum_insured','$premium','$leasing_com','$follow_up','$policy_renewal','$pr_class','$product','$road_tax','$sp_promotion','$remarks','$type_of_pros','$me_code','$me_username','$me_username',sysdate,'A')";
$stid = oci_parse($conn,$sql); 
oci_execute($stid);


if((oci_num_rows($stid) == true )){
    echo "Succesfully Added";
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

*/

?>

