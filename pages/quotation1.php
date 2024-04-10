<?php 

include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 

$business_id=$_GET['bus_id'];

$sql="SELECT 
b.mmc_firstname,b.mmc_surname,b.mmc_phoneno,b.mmc_mobileno,
a.mtb_seq, a.mtb_mmc_id, a.mtb_vehi_no, a.mtb_insurer,
a.mtb_sum_insured, a.mtb_premium, a.mtb_leasing_com,
a.mtb_follow_up_date, a.mtb_pol_renewal_date, 
a.mtb_class,
(SELECT b.cla_description FROM uw_r_classes b where a.mtb_class=b.cla_code)CLASS_DESC,
a.mtb_product,
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
    
      

    if($product == "3A" || $product=="1A" || $product=="3B" || $product=="1B"){
        $category="CAR";                  
    
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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Quotation
            <small></small>
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

     
            <!-- /.box-header -->
            <!-- form start -->

            <div class="col-md-3">
            </div>
            <div class="col-md-6">

               <div class="box box-default">
  
 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quotation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST">
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                    <label>Class</label>
                    <input type="text" class="form-control" name="classdesc" id="classdesc" value="<?php echo  $class_desc .' - '. $class;?>" disabled  >
                    </div>



                    <div class="form-group">
                    <label for="exampleInputFname">Product</label>
                    <input type="text" class="form-control" name="product" id="product" value="<?php echo  $product_desc .' - '. $product ?>" disabled  >
                    <input type="hidden" id="prod_code" name="prod_code" value="<?php echo  $product; ?>">
                    </div>


                    <div class="form-group">
                    <label for="exampleInputmob">Sum Insured</label>
                    <input type="text" class="form-control" name="suminsured" id="suminsured" value="<?php echo  $sum_insured;?>" disabled>
                    </div>



                    <div class="form-group">
                  <label>Year Of Make</label>
                  <select class="form-control select2" style="width: 100%;" id="yearofmake" name="yearofmake" required>
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
              <!-- /.form group -->

              <div class="form-group">
                    <label for="exampleInputaddress">Capacity</label>
                    <input type="text" class="form-control" name="capacity" id="capacity" required>
                  </div>
              <!-- /.form group -->



              <div class="form-group">
                <label>Fuel Type</label>
                <select class="form-control select2" style="width: 100%;"  name="fuel_type" id="fuel_type" required>
                <option>- Select - </option>
               <option value="Disel">Diesel</option>
               <option value="Petrol">Petrol</option>
             
               <option value="Electric">Electric</option>
               <option value="Hybrid"> Hybrid</option>
               
                </select>
              </div>
              <div class="form-group">
                    <label for="exampleInputaddress">Engine No</label>
                    <input type="text" class="form-control" name="engineno" id="engineno" >
                  </div>


                  <div class="form-group">
                    <label for="exampleInputaddress">Chassis No</label>
                    <input type="text" class="form-control" name="chassis" id="chassis" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputaddress">Make / Model</label>
                    <select class="form-control select2" style="width: 100%;"  name="model" id="model" required>
                    <option value="">- Select - </option> 
                        <?php 
                    

                            $sqlmk="SELECT  a.rft_type, a.rft_code, a.rft_description, a.rft_seq_no,
                            a.rft_print_desc, a.rft_warranty_1, a.rft_warranty_2,
                            a.rft_warranty_3, a.rft_level, a.rft_category, a.rft_min_premium,
                            a.rft_age_lmt
                            FROM cm_r_reference_two a
                           where  rft_category='$category'
                            AND rft_type='$ref_type'";
                           $stmt1=oci_parse($conn,$sqlmk); 
                                 oci_execute($stmt1);
                                 while($row=oci_fetch_assoc($stmt1)){
                                    
                                    $rft_code=$row['RFT_CODE'];
                                    $desc=$row['RFT_DESCRIPTION'];
                                   
                                    
                             
                                 ?>              
                                    
                         <option value="<?php echo $rft_code; ?>"> <?php echo $desc; ?> </option>
                         <?php } ?>
                </select>
                  </div>

                  <div class="form-group">
                            <label>Source Of Fund</label>
                            <select class="form-control select2" style="width: 100%;"  name="source_of_fund" id="source_of_fund">
                            <option>- Select - </option>
                        <option value="Employment">Employment</option>
                        <option value="Business">Business</option>
                        
                        <option value="Gifts">Gifts</option>
                        <option value="Leasing"> Leasing</option>
                        <option value="Loan"> Loan</option>
                        <option value="Pension"> Pension</option>
                            </select>
                        </div>

                <div class="form-group">
              
                  <input type="hidden" class="form-control" id="brn" name="brn" value="<?php  echo $brn ?>">
                  <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $user ?>">
                </div>

              
            <div class="form-group">
                <label>Towing</label>
                <select class="form-control select2" style="width: 100%;" name="towing" id="towing">
                  <option value="N">No</option>
                  <option value="Y">Yes</option>
                </select>
              </div>

      
              <div class="form-group">
                <label>Criticall Illness</label>
                <select class="form-control select2" style="width: 100%;"  name="criticall" id="criticall">
                  <option value="N">No</option>
                  <option value="Y">Yes</option>
                </select>
              </div>


              <div class="form-group">
                <label>Medical</label>
                <select class="form-control select2" style="width: 100%;"  name="criticall" id="criticall">
                  <option value="N">No</option>
                  <option value="Y">Yes</option>
                </select>
              </div>
              <div class="form-group">
                <label>Seating Capacity</label>
                <input type="text" class="form-control" name="seating_capacity" id="seating_capacity" >
              </div>



<!--
                <div class="form-group">
                        <label>
                        Towing :- &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  <br>
                        </label>
                        Yes
                        <input type="checkbox" class="minimal" name="towing" id="towing" value="Y">
                        &nbsp;
                        
                        No
                        <input type="checkbox" class="minimal" name="towing" id="towing" value="N">
                </div>


              <div class="form-group">
                 <label>
                Critical Illness  &nbsp; &nbsp; 
                </label>
                Yes
                <input type="checkbox" class="minimal" name="criticall" id="criticall" value="Y">
                 &nbsp;
                
                No
                <input type="checkbox" class="minimal" name="criticall" id="criticall" value="N">
              </div>
              <div class="form-group">
                
                
                <label>
                Medical Cover &nbsp; &nbsp;
             </label>
             Yes
             <input type="checkbox" class="minimal" name="medical" id="medical" value="Y">
             &nbsp;
                
                No
                <input type="checkbox" class="minimal" name="medical" id="medical" value="N">
              </div>

              </div>
                -->
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Generate</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

     

        </div>
            </div>


 
            </div>
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->















            
    </section>
    <!-- /.content -->



 
    




</div>
<?php //} ?>




<?php include_once('footer.php'); ?>

<script>
//Initialize Select2 Elements
$('.select2').select2()

 //Date picker
 $('#datepicker_start_date').datepicker({
    startDate: new Date(),
      autoclose: true
    })

    $('#datepicker_end_date').datepicker({
        startDate: new Date(),
      autoclose: true
    })




  //PUSH END DATE TO 12 MONTH AHEAD 
  $(function() {    
           $('.datepicker_start_date').datepicker();
           
           var updateSecondDate= function() {
            var firstDate = new Date($('#datepicker_start_date').val());
            //var d = new Date();
            firstDate.setMonth(firstDate.getMonth() + 12);
            $('#datepicker_end_date').datepicker('setDate', firstDate);
             
            }
           // $('#datepicker-policy_renewal').datepicker();
            $('#datepicker_start_date').change(updateSecondDate);
    });
// end 





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




</script>