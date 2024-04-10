<?php
include_once('connectdb.php');
session_start();

error_reporting(0);
$quo_seq=$_GET['quo_id'];

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
   
 
 include_once('header.php'); 
 ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     
       <b><?php echo $customername;  ?></b> 
       
      
      </h1>
      <br>

      <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Documents</h3>
            </div>
         
            <!-- /.box-header -->
            <!-- form start -->
          
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputFile">Upload Horse Power</label>
                  <input type="file" name="hp" id="exampleInputFile">

                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Driving License</label>
                  <input type="file" name="dl" id="exampleInputFile">

                 
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload ID</label>
                  <input type="file" name="id" id="exampleInputFile">

                 
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
     
          </div>
          <!-- /.box -->


          

       
        
          </div>
          <!-- /.box -->

        </div>








    </section>

    <?php } ?>
    
   
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



   $('#original_regist').datepicker({
   autoclose: true,
     
 

})

$('#mts_regist_date').datepicker({
     autoclose: true,    
})












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