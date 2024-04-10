<?php
include_once('connectdb.php');
session_start();
$quo_seq=$_GET['quo_id'];

$pol_sts=$_GET['pol_sts'];

if($pol_sts=="R"){
  $pol_sts="R"; //renewal
 // echo $pol_sts;
}
else if($pol_sts == "" || $pol_sts=='N') {
  $pol_sts="N"; //New policy
  //echo $pol_sts;
}

//echo $quo_seq;
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 



$sql="SELECT  a.mtq_quo_seq,

a.mtb_seq,
b.mtb_vehi_no,b.mtb_class,
(SELECT cla_description FROM uw_r_classes  where b.mtb_class=cla_code)CLASS_DESC,
b.mtb_product,
(SELECT prd_description FROM uw_m_products  where b.mtb_product=prd_code)PRODUCT_DESC,
c.mmc_firstname ||' '|| c.mmc_surname AS CUSNAME,c.mmc_phoneno,c.mmc_mobileno,

a.mmc_id, a.mtq_sum_ins, a.mtq_yom,

a.mtq_capacity, a.mtq_fuel_type, a.mtq_mileage, a.mtq_chassis,
a.mtq_engine, a.mtq_make_model,
(SELECT rft_description from cm_r_reference_two where rft_code=mtq_make_model)AS MAKEMODEL,




a.mtq_ori_regist_date,
a.mtq_mts_regist_date, a.mtq_period_form, a.mtq_period_to,
a.mtq_no_days, a.mtq_seat_cap, a.mtq_med, a.mtq_cri, a.mtq_cond,
a.mtq_towing, a.mtq_tot_prm, a.mtq_quo_status, a.mtq_uw_status,
a.created_date, a.created_by, a.modified_date, a.modified_by,
a.mtq_kw
FROM me_t_quotation a,me_t_risks b,me_m_customers c
where a.mtb_seq=b.mtb_seq
and a.mmc_id=c.mmc_id
and a.mtq_quo_seq='$quo_seq'";



$result=oci_parse($conn,$sql);
oci_execute($result);
 while($row=oci_fetch_assoc($result)){

$quo_id=$row['MTQ_QUO_SEQ'];

$bus_id=$row['MTB_SEQ'];

$cus_id=$row['MMC_ID'];

$customername=$row['CUSNAME'];

$phoneno=$row['MMC_PHONENO'];

$mobno=$row['MMC_MOBILENO'];

$vehino=$row['MTB_VEHI_NO'];

$class=$row['MTB_CLASS'];
$class_desc=$row['CLASS_DESC'];
//echo $class;
//echo "<br>";s

$product=$row['MTB_PRODUCT'];
$product_desc=$row['PRODUCT_DESC'];



$sum_insured=$row['MTQ_SUM_INS'];



$yearofmake=$row['MTQ_YOM'];


$capacity=$row['MTQ_CAPACITY'];



$fuel_type=$row['MTQ_FUEL_TYPE'];



$chassis=$row['MTQ_CHASSIS'];

$mileage=$row['MTQ_MILEAGE'];

$engineno=$row['MTQ_ENGINE'];
$model_code=$row['MTQ_MAKE_MODEL'];


$modeldesc=$row['MAKEMODEL'];


$original_regist=$row['MTQ_ORI_REGIST_DATE'];
$original_regist = date("d-m-Y", strtotime($original_regist));

$mts_regist_date=$row['MTQ_MTS_REGIST_DATE'];
$mts_regist_date = date("d-m-Y", strtotime($mts_regist_date));

$start_date=$row['MTQ_PERIOD_FORM'];
$start_date = date("d-m-Y", strtotime($start_date));


$end_date=$row['MTQ_PERIOD_TO'];
$end_date = date("d-m-Y", strtotime($end_date));


$no_days=$row['MTQ_NO_DAYS'];

$seating_capacity=$row['MTQ_SEAT_CAP'];

//echo $seating_capacity;


$medical=$row['MTQ_MED'];




$criticall=$row['MTQ_CRI'];


$condition=$row['MTQ_COND'];





if($condition=="N"){
	$condition_desc="NEW";
}


if($condition=="S"){
	$condition_desc="SECOND HAND";
}


$towing=$row['MTQ_TOWING'];
//$total_prm=$row['MTQ_TOT_PRM'];
$mtq_quo_status=$row['MTQ_QUO_STATUS'];
$mtq_uw_status=$row['MTQ_UW_STATUS'];
$created_date=$row['CREATED_DATE'];
$created_by=$row['CREATED_BY'];
$modified_date=$row['MODIFIED_DATE'];
$modified_by=$row['MODIFIED_BY'];
$kilowat=$row['MTQ_KW'];
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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quotation For
       <b><?php echo $customername;  ?></b>
       
      
      </h1>
   
    </section>

    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">

    <div class="box box-danger">
            <div class="box-header with-border">
            <h3 class="box-title">Enter Details for Vehicle No <b><?php echo  $vehino;?></b></h3>
            </div>
          
            <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                <div class="form-group">
              <label>Class</label>
              <input type="text" class="form-control" id="classdesc" value="<?php echo  $class_desc .' - '. $class;?>"   disabled>
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
              <input type="text" class="form-control"  id="suminsured" name="suminsured" onkeypress="return onlyNumberKey(event)" value="<?php echo $sum_insured  ?>"  <?php  if($class=="M3"){ echo "disabled"; }?> >
             
            </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
            <label>Year Of Make</label>
            <select class="form-control select2" style="width: 100%;" id="yearofmake" name="yearofmake" required disabled>
            <option value="<?php echo $yearofmake; ?>"><?php echo $yearofmake; ?></option>
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
                    print '<option value="'.$i.'"'.($i === $yearofmake ? ' selected="selected"' : '').'>'.$i.'</option>';
                
                }
               
                ?>
                
            </select>
          </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputaddress">Capacity</label>
              <input type="text" class="form-control" name="capacity" id="capacity" required onkeypress="return onlyNumberKey(event)" value="<?php echo $capacity; ?>" >
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
          <select class="form-control select2" style="width: 100%;"  name="fuel_type" id="fuel_types"  required  <?php if($product=="3F"){ ?>onchange="displayDivDemo('hideValuesOnSelect', this)" <?php }?>>
          <option>- Select - </option>
         
         <option value="Diesel"<?php if($fuel_type=="DIESEL"){ echo "selected"; } ?>>Diesel</option>
         <option value="Petrol"<?php if($fuel_type=="PETROL"){ echo "selected"; } ?>>Petrol</option>
       
         <option value="05ELE" <?php if($fuel_type=="05ELE"){ echo "selected"; } ?>>Electric</option>
         <option value="Hybrid" <?php if($fuel_type=="HYDRID"){ echo "selected"; } ?>> Hybrid</option>
         
          </select>
        </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputaddress">Mileage</label>
              <input type="text" class="form-control" name="mileage" id="mileage" required onkeypress="return onlyNumberKey(event)"  value="<?php echo $mileage; ?>">
            </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputaddress">Chassis No</label>
              <input type="text" class="form-control" name="chassis" id="chassis"  value="<?php echo $chassis; ?>">
            </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
             <label for="exampleInputaddress">Engine No</label>
               <input type="text" class="form-control" name="engineno" id="engineno"  value="<?php echo $engineno;  ?>">
            </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
              <label for="exampleInputaddress">Make / Model</label>
              <select class="form-control select2" style="width: 100%;"  name="model" id="model" >
              <option value="">- Select - </option> 
                  <?php 
              

                      $sqlmk="SELECT  a.rft_type, a.rft_code, a.rft_description, a.rft_seq_no,
                      a.rft_print_desc, a.rft_warranty_1, a.rft_warranty_2,
                      a.rft_warranty_3, a.rft_level, a.rft_category, a.rft_min_premium,
                      a.rft_age_lmt
                      FROM cm_r_reference_two a
                     where  rft_category IN ('$category')
                      AND rft_type='$ref_type'";
                     $stmt1=oci_parse($conn,$sqlmk); 
                           oci_execute($stmt1);
                           while($row=oci_fetch_assoc($stmt1)){
                            $level=$row['RFT_LEVEL'];
                              $rft_code=$row['RFT_CODE'];
                              $desc=$row['RFT_DESCRIPTION'];
                             
                       
                           ?>              
                              
                   <option value="<?php echo $rft_code; ?>"  <?php if($level=="4"){ echo "disabled";} ?> <?php if($model_code==$rft_code){ echo "Selected"; }?> > <?php echo $desc; ?> - <?php echo $rft_code; ?>  <?php if($level=="4"){ echo "Restricted";} ?> </option>
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

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" name="original_regist" id="original_regist" required value="<?php echo $original_regist; ?>">
                    </div>
                    <span id="rslt" style="color:red"></span>
                    <!-- /.input group -->
                 </div>
                </div>


                <div class="col-xs-2">
                      <div class="form-group">
                          <label>Mauritius Registration Date:</label>

                            <div class="input-group date">
                               <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                               </div>
                                     <input type="text" class="form-control pull-right"  name="mts_regist_date" id="mts_regist_date" required  value="<?php echo $mts_regist_date; ?>">
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
                    <input type="text" class="form-control pull-right" name="start_date" id="datepicker_start_date" required  value="<?php echo $start_date; ?>">
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
                  <input type="text" class="form-control pull-right"  name="end_date" id="datepicker_end_date" required value="<?php echo $end_date; ?>">
                  
                </div>
          <!-- /.input group -->
              </div>
                </div>



                <div class="col-xs-2">
                   <div class="form-group">
                       <label>Seating Capacity</label>
                     <input type="number" class="form-control" name="seating_capacity" id="seating_capacity" onkeypress="return onlyNumberKey(event)" min="1" value="<?php echo $seating_capacity; ?>">
                     </div>
                </div>
              </div>
              
  </div>


  <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                  
                <div class="form-group">
                  <label>Medical</label>
                  <select class="form-control" style="width: 100%;"  name="medical" id="medical" >
                    <option value="N" <?php if($medical=="N"){ echo "selected"; } ?>>No</option>
                    <option value="Y" <?php if($medical=="Y"){ echo "selected"; } ?>>Yes</option>
                  </select>
                </div>
                </div>


                <div class="col-xs-2">
                <div class="form-group">
                    <label>Criticall Illness</label>
                    <select class="form-control" style="width: 100%;"  name="criticall" id="criticall">
                      <option value="N" <?php if($criticall=="N"){ echo "selected"; } ?>>No</option>
                      <option value="Y" <?php if($criticall=="Y"){ echo "selected"; } ?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
                  <label>Condition</label>
                  <select class="form-control" style="width: 100%;"  name="condition" id="condition">
                    <option value="N" <?php if($condition=="Y"){ echo "selected"; } ?>>New</option>
                    <option value="S" <?php if($condition=="Y"){ echo "selected"; } ?>>Second Hand</option>
                  </select>
                </div>
                </div>
                <div class="col-xs-2">
                <div class="form-group">
          <label>Towing</label>
          <select class="form-control " style="width: 100%;" name="towing" id="towing">
            <option value="N" <?php if($towing=="Y"){ echo "selected"; } ?>>No</option>
            <option value="Y" <?php if($towing=="Y"){ echo "selected"; } ?><?php if($product=="1A"){ echo "selected";} ?>>Yes</option>
          </select>
        </div>
                </div>


                            <?php if($product=="3F"){ ?>

                            
                <div class="col-xs-2">
                <div class="form-group"  id="hideValuesOnSelect" >
          <label>Kilowatt</label>
          <input type="text" class="form-control"  style="display: block;" name="kilowat" id="kilowat" required value="<?php echo $kilowat; ?>">
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
        <input type="hidden" class="form-control" id="vehino" name="vehino" value="<?php echo $vehino ?>">
        <input type="hidden" class="form-control" id="cus_id" name="cus_id" value="<?php echo $cus_id ?>">
        <input type="hidden" class="form-control" id="bus_id" name="bus_id" value="<?php echo $bus_id ?>">
        <input type="hidden" class="form-control" id="quo_seq" name="quo_seq" value="<?php echo $quo_seq ?>">
        <input type="hidden" class="form-control" id="policy_sts" name="policy_sts" value="<?php echo $pol_sts ?>">
          </div>
          <!-- /.box -->
  
         
        </div>
      </div>


     
      <?php include "quotation_modal.php"; ?>
    </section>
    <?php } ?>
    
   
<script>


function displayDivDemo(id, elementValue) {
   document.getElementById(id).style.display = elementValue.value == "05ELE" ? 'block' : 'none';
}







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



   $('#original_regist').datepicker({
   autoclose: true,
     
 

})

$('#mts_regist_date').datepicker({
     autoclose: true,
     
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


var quo_seq = $('#quo_seq').val();
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
var policy_sts= $('#policy_sts').val();



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
                     url: 'ajax_update_quotation.php',
                     type: 'post',
                     cache: true,
                     data: {
                      
                      
                     quo_seq:quo_seq,
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
                     policy_sts:policy_sts
                     },
                  
                        
                     success:function(response){
                      // $(".result").html(response);
                      $('.modal-body-quo').html(response); 
                     $('#modal-primary-quo').modal('show'); 
                     }
               
                   });
                 }
                 
             });

// -------------------- END ----------------------------------------

</script>