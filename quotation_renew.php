<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 

$business_id=$_GET['bus_id'];
//echo  $business_id;
$cus_id=$_GET['cus_id'];

$pol_sts=$_GET['pol_sts'];
$pol_no=$_GET['pol_no'];
//echo $pol_no;

if($pol_sts=="R"){
  $pol_sts="R"; //renewal
 //echo $pol_sts;
}
else if($pol_sts == "" || $pol_sts=='N') {
  $pol_sts="N"; //New policy
 // echo $pol_sts;
}

//echo $clas_des;

$sql="SELECT 
b.mmc_firstname,b.mmc_surname,b.mmc_phoneno,b.mmc_mobileno,
a.mtb_seq, a.mtb_mmc_id, a.mtb_vehi_no, a.mtb_insurer,
a.mtb_sum_insured, a.mtb_premium, a.mtb_leasing_com,
a.mtb_follow_up_date, a.mtb_pol_renewal_date, 
a.mtb_class,
(SELECT b.cla_description FROM uw_r_classes b where a.mtb_class=b.cla_code)CLASS_DESC,
a.mtb_product,

(SELECT c.prd_description FROM uw_m_products c where a.mtb_product=c.prd_code)PRODUCT_DESC,
a.mtb_road_tax_date, a.mtb_sp_promotion_code,
a.mtb_remarks, a.mtb_type_of_prospective, a.me_code,
a.created_by, a.modified_by, a.created_date, a.modified_date,
a.mtb_status
 FROM me_t_risks a,me_m_customers b 
WHERE a.mtb_mmc_id=mmc_id
AND mtb_seq='$business_id'";

$result=oci_parse($conn,$sql);
oci_execute($result);
 while($row=oci_fetch_assoc($result))
 {
    $fname=$row['MMC_FIRSTNAME'];
    $surname=$row['MMC_SURNAME'];
    $customername=$fname.' '. $surname;
    $phoneno=$row['MMC_PHONENO'];
    $mobno=$row['MMC_MOBILENO'];
    $seq=$row['MTB_SEQ'];
    $mmc_id=$row['MTB_MMC_ID'];
    $risk=$row['MTB_VEHI_NO'];
   
    $sum_insured=$row['MTB_SUM_INSURED'];
    $premium=$row['MTB_PREMIUM'];
  
    $class=$row['MTB_CLASS'];
    $class_desc=$row['CLASS_DESC'];
    $product=$row['MTB_PRODUCT'];
    $product_desc=$row['PRODUCT_DESC'];
  
    $me_code=$row['ME_CODE'];

 }



$sql="SELECT pol_seq_no,prs_seq_no,
pol_policy_no, 
prs_name,
sfc_code,
sfc_brn_code,
pol_period_from,
pol_period_to,
pol_prd_code, 
(SELECT c.prd_description from uw_m_products c where pol_prd_code=c.prd_code)PROD_DESC,
pol_cla_code,
(SELECT a.cla_description FROM uw_r_classes a where pol_cla_code=a.cla_code)AS CLASS,
pol_total_premium,
pol_sum_insured,
a.mtb_insured_name,
a.mtb_seq,
prs_premium
FROM uw_m_customers b,uw_t_pol_risks b,sm_m_sales_force b,uw_m_cust_addresses b,uw_t_policies, me_t_risks a

WHERE pol_cus_code=cus_code
AND prs_plc_pol_seq_no=POL_SEQ_NO
AND sfc_code=pol_marketing_executive_code
AND sfc_code=pol_marketing_executive_code
AND adr_seq_no=pol_adr_seq_no
AND mtb_seq='$business_id'
AND pol_policy_no ='$pol_no'";



$result=oci_parse($conn,$sql);
oci_execute($result);
 while($row=oci_fetch_assoc($result))
 {

    
    $pol_seq_no=$row['POL_SEQ_NO'];
    $seq_no=$row['PRS_SEQ_NO'];
    $vehi_no=$row['PRS_NAME'];
    $pol_from=$row['POL_PERIOD_FROM'];
    $pol_to=$row['POL_PERIOD_TO'];
    $product=$row['POL_PRD_CODE'];
    $product_desc=$row['PROD_DESC'];
    $class=$row['POL_CLA_CODE'];
    $class_desc=$row['CLASS'];
    $tl_prem=$row['POL_TOTAL_PREMIUM'];
    $sum_insured=$row['POL_SUM_INSURED'];
    $customername=$row['MTB_INSURED_NAME'];
 }

    $sqlres="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
    a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
    a.pin_prs_plc_seq_no, a.pin_prs_seq_no, a.pin_pif_prd_code,
    a.pin_pif_seq_no, a.created_by, a.created_date, a.modified_by,
    a.modified_date
FROM uw_t_pol_information a
where pin_prs_plc_pol_seq_no='$pol_seq_no'";
$result2=oci_parse($conn, $sqlres);
oci_execute($result2);
while($row=oci_fetch_assoc($result2))
{
  $pin_seq_no=$row['PIN_SEQ_NO'];
  $description=$row['PIN_DESCRIPTION'];
  $risk_info=$row['PIN_CHAR_VALUE'];
  $risk_val=$row['PIN_NUMBER_VALUE'];
}




    
 if($product=="3B" || $product=="1B" || $product=="1H") 
 {
  echo '<script>alert("Please Contact HO For Quotation")</script>';
  header('refresh:1;business_followup.php');
}


   




    if($product == "3A" || $product=="1A" || $product=="3B" || $product=="1B" || $product=="1T"){
        $category="CAR";                  
    
       }




       if($product == "1C" || $product=="3C"){
        
        $category1=["VAN","LORRY","CAB"];
        $category="".implode("','",$category1)."";        
        //echo $category;
       
       }


//LOGIC FOR PRODUCT CODE 1D - CONTRACT BUS/VAN  
    //IF  PROD CODE = 1D - CATEGORY = BUS/VAN  
       if($product == "1D" || $product == "3D"){
        
        $category1=["BUS","VAN"];
        $category="".implode("','",$category1)."";        
    //   echo $category;
       
       }




if($product == "1K"){
        
  $category1=["BUS"];
  $category="".implode("','",$category1)."";        
//   echo $category;
 
 }




//LOGIC FOR PRODUCT CODE 1E -  VAN/LORRY 
    //IF  PROD CODE = 1E - CATEGORY = VAN/LORRY 
    if($product == "1E"||  $product == "3E"){
        
      $category1=["VAN","LORRY"];
      $category="".implode("','",$category1)."";        
  //   echo $category;
     
     }


//LOGIC FOR PRODUCT CODE 1F -  MOTORCYCLE  
    //IF  PROD CODE = 1F - CATEGORY = MOTORCYCLE
    if($product == "1F" || $product == "3F"){
        
      $category1=["MOTORCYCLE"];
      $category="".implode("','",$category1)."";        
  //   echo $category;
     
     }



//LOGIC FOR PRODUCT CODE 1G - TAXI BUS  
    //IF  PROD CODE = 1GF - CATEGORY = BUS  
    if($product == "1G" || $product == "3G"){
        
      $category1=["BUS"];
      $category="".implode("','",$category1)."";        
  //   echo $category;
     
     }



    



       if($class=="MC")
       {
           $ref_type = '02';
         //  echo $ref_type;
   
         // echo "COMPRENSIVE";
       }
     
       
      if($class=="M3"){
   
       $ref_type = "03";
      // echo $ref_type;
   
       //echo "THIRD PARRTY";
      }
    
  

include_once('header.php'); 
?>
<style>
   #hideValuesOnSelect {
      display: none;
   }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quotation For
       <b><?php echo $customername.'-'.$pol_seq_no;?></b>
      
      </h1>
   
    </section>

    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">

    <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Enter Details</h3>
            </div>
          
            <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                <div class="form-group">
              <label>Class</label>
              <input type="text" class="form-control" id="classdesc" value="<?php echo  $class_desc .' - '. $class;?>" disabled  >
              <input type="hidden" id="classcode" name="class" value="<?php echo  $class; ?>">
            </div>
                </div>
                
                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputFname">Product</label>
              <input type="text" class="form-control" name="product" id="product" value="<?php echo  $product_desc .' - '. $product ?>" disabled  >
              <input type="hidden" id="prod_code" name="prod_code" value="<?php echo  $product; ?>">
              </div>
                </div>

                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputmob">Sum Insured</label>
              <input type="text" class="form-control"  id="suminsured" name="suminsured" onkeypress="return onlyNumberKey(event)" value="<?php echo $sum_insured; ?>"  <?php // if($class=="M3"){ echo "disabled"; }?> disabled>
             
            </div>
                </div>

            <div class="col-xs-2">
              <div class="form-group">
                 <label>Year Of Make</label>
                     <?php $yrsmake_query="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                            a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                            a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                     FROM uw_t_pol_information a
                     WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                     AND pin_description='YEAR OF MAKE'";

                   $res3=oci_parse($conn, $yrsmake_query);
                     oci_execute($res3);
                       while($row=oci_fetch_assoc($res3))
             {
                   $pin_seq_no=$row['PIN_SEQ_NO'];
                    $description=$row['PIN_DESCRIPTION'];
                      $yrsmke_info=$row['PIN_CHAR_VALUE'];
                        $yrsmke_val=$row['PIN_NUMBER_VALUE'];
             }
                   ?>
               <select class="form-control select2" style="width: 100%;" id="yearofmake" name="yearofmake" required>
                   <option value="<?php echo $yrsmke_val ?>"><?php echo $yrsmke_val ?></option>
                 <?php
                // Sets the top option to be the current year. (IE. the option that is chosen by default).
                $currently_selected = date('Y'); 
                // Year to start available options at
                $earliest_year = 1980; 
                // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                $latest_year = date('Y'); 

               
                // Loops over each int[year] from current year, back to the $earliest_year [1950]
                foreach ( range( $latest_year, $earliest_year ) as $i ) {
                    // Prints the option with the next year in range.
                    print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                }
               
                ?>
            </select>
          </div>
                </div>


          <div class="col-xs-2">
            <div class="form-group">
              <label for="exampleInputaddress">Capacity</label>
                <?php 
                  $cap="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                   a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                   a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                    FROM uw_t_pol_information a
                     WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                      AND pin_description='C CAPACITY'";

               $res3=oci_parse($conn, $cap);
                 oci_execute($res3);
                   while($row=oci_fetch_assoc($res3))
              {
                  $pin_seq_no=$row['PIN_SEQ_NO'];
                   $description=$row['PIN_DESCRIPTION'];
                    $cc_info=$row['PIN_CHAR_VALUE'];
                     $cc_val=$row['PIN_NUMBER_VALUE'];
             }
              ?>
              <input type="text" class="form-control" name="capacity" id="capacity" value="<?php echo $cc_val?>" required onkeypress="return onlyNumberKey(event)">
            </div>
                </div>
              </div>
              
            </div>
            <!-- /.box-body -->

          <div class="box-body">
              <div class="row">

                <div class="col-xs-2">
                  <div class="form-group">

              <label>Fuel Type</label>
                <?php 
                  /*$fuel_tp="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                   a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                   a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                    FROM uw_t_pol_information a
                     WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                      AND pin_description=''";

               $res3=oci_parse($conn,$fuel_tp);
                 oci_execute($res3);
                   while($row=oci_fetch_assoc($res3))
              {
                  $pin_seq_no=$row['PIN_SEQ_NO'];
                   $description=$row['PIN_DESCRIPTION'];
                    $cc_info=$row['PIN_CHAR_VALUE'];
                     $cc_val=$row['PIN_NUMBER_VALUE'];
             }*/
              ?>

               <select class="form-control select2" style="width: 100%;"  name="fuel_type" id="fuel_types"  required  <?php if($product=="3F"){ ?>onchange="displayDivDemo('hideValuesOnSelect', this)" <?php }?>>
                 <option>- Select - </option>
                   <option value="Diesel">Diesel</option>
                     <option value="Petrol">Petrol</option>
                       <option value="05ELE">Electric</option>
                         <option value="Hybrid"> Hybrid</option>
                </select>
                    </div>
                </div>


                <div class="col-xs-2">
    	             <div class="form-group">
                       <label for="exampleInputaddress">Mileage</label>
                   <?php 
                   $mile_query = "SELECT pin_char_value, pin_number_value 
                                   FROM uw_t_pol_information 
                                   WHERE pin_prs_plc_pol_seq_no = :pol_seq_no 
                                   AND pin_description = 'MILEAGE(KM)'";

                  $stmt = oci_parse($conn, $mile_query);
                   oci_bind_by_name($stmt, ':pol_seq_no', $pol_seq_no);
                   oci_execute($stmt);

                    $mileage_value = 0; 
                    while ($row = oci_fetch_assoc($stmt)) {
                   // Check number values, if present
                    $mileage_value =$row['PIN_NUMBER_VALUE'] ?? 0;
                   }
                     ?>
              <input type="text" class="form-control" name="mileage" id="mileage" required onkeypress="return onlyNumberKey(event)" value="<?php echo $mileage_value; ?>">
                    </div>
                  </div>


              <div class="col-xs-2">
                <div class="form-group">
                   <label for="exampleInputaddress">Chassis No</label>
               <?php 
                 $chass_val="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                  a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                  a.pin_prs_plc_seq_no, a.pin_prs_seq_no
              FROM uw_t_pol_information a
             WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
               AND pin_description='CHASSIS NO'";

               $res3=oci_parse($conn, $chass_val);
                     oci_execute($res3);
                while($row=oci_fetch_assoc($res3))
           {
                 $pin_seq_no=$row['PIN_SEQ_NO'];
                  $description=$row['PIN_DESCRIPTION'];
                   $chassis_info=$row['PIN_CHAR_VALUE'];
                    $chassis_val=$row['PIN_NUMBER_VALUE'];
           }
              ?>
              <input type="text" class="form-control" name="chassis" id="chassis" value="<?php echo $chassis_info ?>">
            </div>
                </div>


            <div class="col-xs-2">
              <div class="form-group">
                <label for="exampleInputaddress">Engine No</label>
              <?php 
                 $engine_val="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                         a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                         a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                   FROM uw_t_pol_information a
                    WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                      AND pin_description='ENGINE NO'";

                   $res3=oci_parse($conn, $engine_val);
                         oci_execute($res3);
                     while($row=oci_fetch_assoc($res3))
                  {
                       $pin_seq_no=$row['PIN_SEQ_NO'];
                        $description=$row['PIN_DESCRIPTION'];
                         $engine_info=$row['PIN_CHAR_VALUE'];
                           $engine_val=$row['PIN_NUMBER_VALUE'];
                  }
              ?>
               <input type="text" class="form-control" name="engineno" id="engineno" value="<?php echo $engine_info ?>">
            </div>
                </div>


            <div class="col-xs-2">
              <div class="form-group">
                <label for="exampleInputaddress">Make / Model</label>
              <?php 
                 $make_val="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                  a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                   a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                     FROM uw_t_pol_information a
                      WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                        AND(pin_description='MAKE' OR pin_description='MODEL')";

                  $res3 = oci_parse($conn, $make_val);
                    oci_execute($res3);
                      $make_value = "";
                        $model_value = "";
                       
                       
                          while ($row = oci_fetch_assoc($res3)) {
                          $description = $row['PIN_DESCRIPTION'];
                           $pin_char_value = $row['PIN_CHAR_VALUE'];
    
                  if ($description === 'MAKE') {
                     $make_value = $pin_char_value;
                         } elseif ($description === 'MODEL') {
                             $model_value = $pin_char_value;
                         }

                         $ref_make_model=$make_value.' '.$model_value;
                  }
                 
                  //echo $ref_make_model;
              ?>
              <select class="form-control select2" style="width: 100%;"  name="model" id="model" value="" >
             
                  <?php 
              
              $ref_val="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
              a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
               a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                 FROM uw_t_pol_information a
                  WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                    AND pin_description='VEHICLE MAKE/ MODEL'";

              $res3 = oci_parse($conn, $ref_val);
                oci_execute($res3);
                      while ($row = oci_fetch_assoc($res3)) {
                      $ref_description = $row['PIN_DESCRIPTION'];
                       $ref_value = $row['PIN_CHAR_VALUE'];
                           ?>     

                     <option value="<?php echo $ref_value?>"><?php echo $ref_make_model ?></option>       
                  <!-- <option value="<?php echo $rft_code; ?>"  <?php if($level=="4"){ echo "disabled";} ?> > <?php echo $desc; ?> - <?php echo $rft_code; ?>  <?php if($level=="4"){ echo "Restricted";} ?> </option>-->
                   <?php } ?>
          </select>
            </div>
                </div>
              </div>       
  </div>





          <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                  
                <div class="form-group">
                 <label>Original Registration Date:</label>

                 <?php 
                    $ord_query = "SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                            a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                             a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                     FROM uw_t_pol_information a
                     WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                      AND pin_description='DATE OF ORIGINAL REG. (DD/MM/YYYY)'";

            $res3 = oci_parse($conn, $ord_query);
                    oci_execute($res3);
                if ($row = oci_fetch_assoc($res3)) {
                     $ord_date = $row['PIN_DATE_VALUE'];
              } else {
                  $ord_date = '';
                  }
                  ?>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" name="original_regist" id="original_regist" required value="<?php echo  $ord_date ?>">
                    </div>
                    <span id="rslt" style="color:red"></span>
                    <!-- /.input group -->
                 </div>
                </div>


                <div class="col-xs-2">
                      <div class="form-group">
                        
                          <label>Mauritius Registration Date:</label>
                          <?php 
                            $mrd_query="SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                             a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                             a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                        FROM uw_t_pol_information a
                       WHERE pin_prs_plc_pol_seq_no='$pol_seq_no'
                         AND pin_description='DATE REG. IN MAURITIUS (DD/MM/YYYY)'";

            $res3=oci_parse($conn, $mrd_query);
                  oci_execute($res3);


            $mrd_date = '';
                while($row=oci_fetch_assoc($res3)) {
                $mrd_date = $row['PIN_DATE_VALUE'];
            }
                  if($mrd_date == '') {
                        $mrd_date = '';
                      }
                    ?>
                            <div class="input-group date">
                               <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                               </div>
                                <input type="text" class="form-control pull-right"  name="mts_regist_date" id="mts_regist_date" required value="<?php echo $mrd_date?>">
                            </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-2">
                <div class="form-group">
                 <label>From Date:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="start_date" id="datepicker_start_date" required value="<?php echo $pol_to ?>">
                  </div>
          <!-- /.input group -->
               </div>
                </div>

                <div class="col-xs-2">
                  <div class="form-group">
                    <label>To Date:</label>

                  <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right"  name="end_date" id="datepicker_end_date" required value="">
                  
                </div>
          <!-- /.input group -->
              </div>
                </div>



                <div class="col-xs-2">
                   <div class="form-group">
                       <label>Seating Capacity</label>

                       <?php
                         $seatcap_query = "SELECT a.pin_seq_no, a.pin_description, a.pin_char_value,
                            a.pin_number_value, a.pin_date_value, a.pin_prs_plc_pol_seq_no,
                            a.pin_prs_plc_seq_no, a.pin_prs_seq_no
                    FROM uw_t_pol_information a
                    WHERE pin_prs_plc_pol_seq_no = :pol_seq_no
                        AND pin_description = 'SEATING CAPACITY'";

                  $res3 = oci_parse($conn, $seatcap_query);
    oci_bind_by_name($res3, ":pol_seq_no", $pol_seq_no);
    oci_execute($res3);

    $seat_value = ''; // Initializing variable
    while ($row = oci_fetch_assoc($res3)) {
        $seat_value = $row['PIN_NUMBER_VALUE']; // Overwrite until the last fetched row
    }
?>
                     <input type="number" class="form-control" name="seating_capacity" id="seating_capacity" onkeypress="return onlyNumberKey(event)" min="1" value="<?php echo  $seat_value  ?>">
                     </div>
                </div>
              </div>
              
  </div>


  <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                  
                <div class="form-group">
                  <label>Medical</label>
                  <select class="form-control" style="width: 100%;"  name="medical" id="medical">
                    <option value="N">No</option>
                    <option value="Y">Yes</option>
                  </select>
                </div>
                </div>


                <div class="col-xs-2">
                <div class="form-group">
                    <label>Criticall Illness</label>
                    <select class="form-control" style="width: 100%;"  name="criticall" id="criticall">
                      <option value="N">No</option>
                      <option value="Y">Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
                  <label>Condition</label>
                  <select class="form-control" style="width: 100%;"  name="condition" id="condition">
                    <option value="N">New</option>
                    <option value="S">Second Hand</option>
                  </select>
                </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
          <label>Towing</label>
          <select class="form-control " style="width: 100%;" name="towing" id="towing">
            <option value="N">No</option>
            <option value="Y" <?php if($product=="1A"){ echo "selected";} ?>>Yes</option>
          </select>
        </div>
                </div>


                            <?php if($product=="3F"){ ?>

                            
                <div class="col-xs-2">
                <div class="form-group"  id="hideValuesOnSelect" >
          <label>Kilowatt</label>
          <input type="text" class="form-control"  style="display: block;" name="kilowat" id="kilowat" required>
          </div>
                </div>
<?php } ?>

              
              </div>
              <div class="box-footer ">
          
          <button type="submit"  class="btn-generate btn btn-info pull-right" data-toggle="modal" data-target="#modal-default-quo" id="generate">Generate</button>
        </div>
  </div>

        <input type="hidden" class="form-control" id="brn" name="brn" value="<?php  echo $brn ?>">
        <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $user ?>">
        <input type="hidden" class="form-control" id="custname" name="custname" value="<?php echo $customername ?>">
        <input type="hidden" class="form-control" id="phoneno" name="phoneno" value="<?php echo $phoneno ?>">
        <input type="hidden" class="form-control" id="mobno" name="mobno" value="<?php echo $mobno ?>">
        <input type="hidden" class="form-control" id="vehino" name="vehino" value="<?php echo $risk ?>">
        <input type="hidden" class="form-control" id="cus_id" name="cus_id" value="<?php echo $cus_id ?>">
        <input type="hidden" class="form-control" id="bus_id" name="bus_id" value="<?php echo $business_id ?>">
        <input type ="hidden" id="pol_sts" value="<?php echo $pol_sts ?>">


          </div>
          <!-- /.box -->
  
         
        </div>
      </div>


     

    </section>

    


<?php include "quotation_modal.php"; ?>
<?php //include_once('footer.php'); ?>




<script>


   function displayDivDemo(id, elementValue) {
      document.getElementById(id).style.display = elementValue.value == "05ELE" ? 'block' : 'none';
   }







//Initialize Select2 Elements
$('.select2').select2()


  

      $('#original_regist').datepicker({
      autoclose: true,
        
    

  })

  $('#mts_regist_date').datepicker({
        autoclose: true,
        
  })


 


  $(function() {
    $('#datepicker_start_date').datepicker({
        startDate: new Date(),
        autoclose: true
    });

    // Set initial value for end date picker based on $pol_to
    var polToDate = new Date('<?php echo $pol_to; ?>');
    polToDate.setMonth(polToDate.getMonth() + 12);
    $('#datepicker_end_date').datepicker({
        startDate: polToDate,
        autoclose: true
    });

    // Define the updateSecondDate function
    var updateSecondDate = function() {
        var firstDate = new Date($('#datepicker_start_date').val());
        firstDate.setMonth(firstDate.getMonth() + 12);
        $('#datepicker_end_date').datepicker('setDate', firstDate);
    };

    // Attach change event handler to start date input field
    $('#datepicker_start_date').change(updateSecondDate);

    // Trigger the updateSecondDate function on page load
    updateSecondDate();
});




     //iCheck for checkbox and radio inputs
     $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })


    $("#capacity").on("keypress keyup blur",function (event) {    
	$(this).val($(this).val().replace(/[^\d].+/, ""));
	if((event.which < 48 || event.which > 57)) {
		event.preventDefault();
		return false;
      ///  $("#capacity").remove();


	}
});	


document.getElementById("seating_capacity").min = "1";





function onlyNumberKey(evt) {
          
          // Only ASCII character in that range allowed
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false;
          return true;
      }
  

  /*    
      document.getElementById("seating_capacity").addEventListener("change", function() {
  let v = parseInt(this.value);
  if (v < 5) this.value = 5;
 
});
*/


//-------------AJAX -----------------


$(document).on("click", ".btn-generate", function(){



  var bus_id = $('#bus_id').val();
  var cus_id = $('#cus_id').val();
  var classdesc = $('#classdesc').val();
  var classcode = $('#classcode').val();
  var product = $('#product').val();
  var prod_code =  $('#prod_code').val();
  var suminsured = $('#suminsured').val();
  var yearofmake = $('#yearofmake').val();
  var capacity = $('#capacity').val();
  var fuel_type = $('#fuel_types').val();
  var mileage = $('#mileage').val();
  var chassis = $('#chassis').val();
  var engineno = $('#engineno').val();
  var model = $('#model').val();
  var seating_capacity =  $('#seating_capacity').val();
  var towing  =  $('#towing').val();
  var medical  =  $('#medical').val();
  var criticall =  $('#criticall').val();
  var condition =  $('#condition').val();
  var original_regist =  $('#original_regist').val();
  var mts_regist_date =  $('#mts_regist_date').val();
  var datepicker_start_date =  $('#datepicker_start_date').val();
  var datepicker_end_date =  $('#datepicker_end_date').val();
  var brn =  $('#brn').val();
  var user = $('#user').val();
  var custname = $('#custname').val();
  var phoneno = $('#phoneno').val();
  var mobno = $('#mobno').val();
  var vehino = $('#vehino').val();
  var kilotwat = $('#kilowat').val();
  var polsts=$('#pol_sts').val();
  
  //alert(bus_id+ cus_id +classdesc+classcode+product+prod_code+suminsured+yearofmake+capacity+fuel_type+mileage+chassis+engineno+model+seating_capacity+towing+medical
 // +criticall+condition+original_regist+mts_regist_date+datepicker_start_date+datepicker_end_date+brn+user+custname+phoneno+mobno+vehino+kilotwat+polsts);

 //alert(datepicker_start_date);
if(suminsured =="" || capacity == ""){
  alert("Please Fill All Required Field");
}

if(datepicker_start_date =="" || datepicker_start_date == ""){
  alert("Please Choose Period Date");
}

if(model ==""){
  alert("Please Choose Make And Model");
}




if(condition == "S" && original_regist == mts_regist_date ){

alert("Condition NEW - Original Date Must Be Same As Mauritius Registration Date");
}

if(condition == "N" && original_regist !== mts_regist_date ){

alert("Condition NEW - Original Date Must Be Same As Mauritius Registration Date");
}


else {

                        $.ajax({
                        url: 'ajax_quotation.php',
                        type: 'post',
                        cache: true,
                        data: {
                          
                        bus_id:bus_id,
                        cus_id:cus_id, 
                        classdesc : classdesc,
                        classcode :classcode,
                        product : product,
                        prod_code:prod_code,
                        suminsured: suminsured,
                        yearofmake: yearofmake,
                        capacity: capacity,
                        fuel_type:fuel_type,
                        mileage:mileage,
                        chassis:chassis,
                        engineno:engineno,
                        model:model,
                        seating_capacity,seating_capacity,
                        towing:towing,
                        medical:medical,
                        criticall:criticall,
                        condition:condition,
                        original_regist:original_regist,
                        mts_regist_date:mts_regist_date,
                        datepicker_start_date:datepicker_start_date,
                        datepicker_end_date:datepicker_end_date,
                        brn:brn,
                        user:user,
                        custname:custname,
                        phoneno:phoneno,
                        mobno:mobno,
                        vehino:vehino,
                        kilotwat:kilotwat,
                        polsts:polsts
                        },
                     
                           
                        success:function(response){
                         //alert(response);
                       
                         // $(".result").html(response);
                         $('.modal-body-quo').html(response); 
                        $('#modal-primary-quo').modal('show'); 
                        
                      
                    }
                      });
                    }
                });

// -------------------- END ----------------------------------------

</script>