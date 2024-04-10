<?php
include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 



$business_id=$_POST['business_id'];
$cus_id=$_POST['cus_id'];
//echo $cus_id;
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
AND mtb_seq='$business_id'
--AND me_code='$me_code'
--AND mtb_status='A'";
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
    $insurer=$row['MTB_INSURER'];
    $sum_insured=$row['MTB_SUM_INSURED'];
    $premium=$row['MTB_PREMIUM'];
    $leasing_com=$row['MTB_LEASING_COM'];
    $follow_up_date=$row['MTB_FOLLOW_UP_DATE'];
    $pol_renewal_date=$row['MTB_POL_RENEWAL_DATE'];
    $class=$row['MTB_CLASS'];
    $class_desc=$row['CLASS_DESC'];
    $product=$row['MTB_PRODUCT'];
    $product_desc=$row['PRODUCT_DESC'];
    $road_tax_date=$row['MTB_ROAD_TAX_DATE'];
    $promotion_code=$row['MTB_SP_PROMOTION_CODE'];
    $remarks=$row['MTB_REMARKS'];
    $type_of_prospective=$row['MTB_TYPE_OF_PROSPECTIVE'];
    $me_code=$row['ME_CODE'];
    $created_by=$row['CREATED_BY'];
    $modified_by=$row['MODIFIED_BY'];
    $created_date=$row['CREATED_DATE'];
    $modified_by=$row['MODIFIED_DATE'];
    $status=$row['MTB_STATUS'];
   // echo  $fname;
 }
?>

<!-- general form elements -->
<div class="box box-primary">
        <div class="row">
            <div class="col-md-12">
                
            <div class="box-body">
              <div class="row">
              <div class="col-xs-5">
                <label for="example">Class</label>
                <select class="form-control select2" style="width: 100%;" name="class" id="class" required disabled>
             <option value="<?php echo  $class ?>"><?php echo $class_desc; ?></option> 
                
                <?php
                 $sqlclass="SELECT a.cla_code, a.cla_description, a.created_by, a.created_date,
                          a.modified_by, a.modified_date
                          FROM uw_r_classes a order by created_date";
                 $stmt=oci_parse($conn,$sqlclass); 
                 oci_execute($stmt);
                 while($row=oci_fetch_assoc($stmt)){
                  
                    $cla_code=$row['CLA_CODE'];
                    $cla_desc=$row['CLA_DESCRIPTION'];
                   
                    
                  
                 


                 ?>    
                
                 
                     <option value="<?php echo $cla_code  ?>"><?php echo $cla_desc ?></option> 
                      <?php } ?>
                </select> 
                </div>


                <div class="col-xs-7">
                <label for="example">Product</label>
                <select class="form-control select2" style="width: 100%;" name="product" id="product" required disabled>
                <option value="<?php echo  $product ?>" selected><?php echo $product_desc; ?></option> 
                
               
                
            
                </select> 
                </div> 
                
          

                <div class="col-xs-3">
                  <br>
                <label for="example">Risk info</label>
                  <input type="text" class="form-control" name="risks" id="risks" placeholder="Enter Risk"  value="<?php echo $risk ?>" required disabled>
                  

                </div>



                <div class="col-xs-5"> <br>
                <label for="example">Current Insurer</label>
                <select class="form-control select2" style="width: 100%;" name="current_insurer" id="current_insurer" required>
                
                <?php if($insurer =="") { echo "<option value=>- Select Insurer -</option>";} else { echo "<option> $insurer </option>"; } ?>
                
                       <?php
                          $sqlinusrer="SELECT * FROM NC_INS_COMPANY  WHERE og_code NOT IN ('CS','JI','PC','PD','NM','NP')  order by og_name";
                          $stmtins=oci_parse($conn,$sqlinusrer); 
                          oci_execute($stmtins);
                          while($row=oci_fetch_assoc($stmtins)){
                  
                            $og_code=$row['OG_CODE'];
                            $og_name=$row['OG_NAME'];
                           
                            
                           echo "<option> $og_name </option>";
                         }

                      ?>
                        
                </select>
                </div>

                <div class="col-xs-4">
                  <br>
                <label for="example">Sum Insured</label>
                  <input type="text" class="form-control" name="sum_insured" id="sum_insured" value="<?php echo $sum_insured ?>" >
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Expected Premium</label>
                  <input type="text" class="form-control" name="premium" id="premium" value="<?php echo $premium ?>" name="premium" required>
                </div>

                <div class="col-xs-5"> <br>
                <label for="example">Policy Renewal Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-policy_renewal" name="policy_renewal_date" value="<?php echo  $pol_renewal_date ?>">
                </div>
                </div>


                <div class="col-xs-4"> <br>
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date" value="<?php echo  $follow_up_date ?>">
                </div>
                </div>

                <div class="col-xs-4"><br>
                <label for="example">Road Tax End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="road_tax" name="road_tax" value="<?php echo $road_tax_date ?>">
                </div>
                </div>

                <div class="col-xs-4"> <br>
                <label for="example">Leasing Company</label>
                <input type="text" class="form-control" name="leasing_com" id="leasing_com" placeholder="Enter Leasing Company" value="<?php echo $leasing_com  ?>">
                </div>

                
                <div class="col-xs-4"> <br>
                <label for="example">Type Of Prospective</label>
                <select class="form-control select2" style="width: 100%;" name="type_of_pros" id="type_of_pros" required>
                        <option value="">- Select -</option>
                        <option value="Pending"<?php if($type_of_prospective == "PENDING" ){ echo "selected"; } ?>>Pending</option>
                        <option value="Prospective"<?php if($type_of_prospective == "PROSPECTIVE" ){ echo "selected"; } ?>>Propective</option>
                </select> 
                </div>
                
 

                <div class="col-xs-4"> <br>
                <label for="example">Special Promotion</label>
                <select class="form-control select2" style="width: 100%;" name="promotion" id="promotion" >
                        <option selected></option>
                        
                </select>
                </div>
                <div class="col-xs-6"> <br>
                <label for="example">Remarks</label>
                  <textarea class="form-control" placeholder="Enter Remarks" name="remarks" id="remarks"><?php echo $remarks ?></textarea>
                </div><br><br>
                 
                 <input type="hidden" name="cus_id" id="cus_id" value="<?php echo $cus_id ?>" >
                 <input type="hidden" name="bus_id" id="bus_id" value="<?php echo $business_id ?>">
                 <input type="hidden" name="user" id="user" value="<?php echo $user ?>">
                
                 <div class="col-xs-12"> <br>
                <div class="box-footer">
               
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button> 
                <button type="submit" name="submit" id="btn-update-bus" class="btn-update-bus btn btn-primary pull-right">Update</button>
             </div>
                        </div>

              </div>
            </div>
            </div>
        </div>
</div>

<script>


$(document).ready(function(){
$('#btn-update-bus').click(function(){
    event.preventDefault();
    var cus_id = $('#cus_id').val();
    var bus_id = $('#bus_id').val();
    var pclass  =  $('#class').val();
    var product  =  $('#product').val();
    var risks =   $('#risks').val();
    var current_insurer = $('#current_insurer').val();
    var sum_insured = $('#sum_insured').val();
    var premium = $('#premium').val();
    var policy_renewal_date = $('#datepicker-policy_renewal').val();
    var datepicker_follow_up =  $('#datepicker-follow_up').val();
    var follow_up_date =  $('#follow_up_date').val();
    var road_tax = $('#road_tax').val();
    var leasing_com  = $('#leasing_com').val();
    var promotion = $('#promotion').val();
    var type_of_pros  = $('#type_of_pros').val(); 
    var remarks = $('#remarks').val();
    var user = $('#user').val();
    //alert(policy_renewal_date)

    $.ajax({
        url: 'process_upd_business.php',
        type: 'POST',
        data: {
           cus_id:cus_id,
           bus_id:bus_id,
           pclass:pclass,
           product:product,
           risks:risks,
           current_insurer:current_insurer,
           sum_insured:sum_insured,
           premium:premium,
           policy_renewal_date:policy_renewal_date,
           datepicker_follow_up: datepicker_follow_up,
           follow_up_date:follow_up_date,
           road_tax:road_tax,
           leasing_com:leasing_com,
           promotion:promotion,
           type_of_pros:type_of_pros,
           remarks:remarks,
           user:user

      
         },
            cache: false,
            success: function (data) {
            $('#message').html(data);
           // alert(data);
           // setTimeout(function(){location.href="daily_act.php"} , 1000);
           $("#modal-default").modal('hide');
            location.reload();

           
		}

    });
    
});

});





//SELECT CLASS TO DISPLAY PRODUCT 
$(document).ready(function() {
    $('#class').change(function(){
      var id = $(this).val();
        //alert(id);
             $.ajax({
              url: 'load_data.php',
              type: 'post',
              data: {id:id},
              dataType:"text",
                
                
              success: function(data)
            { 
              $('#product').html(data);
            }
     });
  });
});
//end



</script>
<script>

      //Initialize Select2 Elements
      $('.select2').select2()
//Date picker
$('#datepicker-follow_up').datepicker({
     // startDate: new Date(),

      autoclose: true
      
    })


$('#datepicker-policy_renewal').datepicker({
     // startDate: new Date(),
      autoclose: true
      
      
    })
  
 




  //BACKDATE FOLLOW UP DATE TO 1 MONTH BACK 
    $(function() {    
           $('.datepicker-policy_renewal').datepicker();
           
           var updateSecondDate= function() {
            var firstDate = new Date($('#datepicker-policy_renewal').val());
            //var d = new Date();
            firstDate.setMonth(firstDate.getMonth() - 1);
            $('#datepicker-follow_up').datepicker('setDate', firstDate);
             
            }
           // $('#datepicker-policy_renewal').datepicker();
            $('#datepicker-policy_renewal').change(updateSecondDate);
    });
// end 





    $('#road_tax').datepicker({
      autoclose: true
    })

    </script>