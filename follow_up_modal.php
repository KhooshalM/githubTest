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
 //   echo  $fname .' '. $surname;
 }
?>

<div class="box box-primary">
<div class="row">
            <div class="col-md-12">
                
       


            <div class="box-body">
              <div class="row">
                <div class="col-xs-4">
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date" value="<?php echo  $follow_up_date ?>">
                </div>
                </div>



                <div class="col-xs-4">
                  <div class="form-group">
                   <label for="example">Type Of Contact</label>
                        <select class="form-control select2" style="width: 100%;" name="typeofcontact" id="typeofcontact" required>
                          <option value="">- Select -</option>
                          <option value="Call">Call</option>
                          <option value="Meeting">Meeting</option>
                        </select> 
                  </div>

                
                </div>


              </div>
            </div>
          <input type="hidden" name="bus_id" id="bus_id" value="<?php echo $seq; ?>">


            <div class="box-body">
              <div class="row">
                <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputmob">Follow Up Comment</label>
                  
                    <textarea class="form-control" rows="3" name="followupcomment" id="followupcomment" ></textarea>
                    </div>
                </div>
              
                
              </div>
            </div>
         
        
            <div class="box-footer">
                <button type="submit" name="submit" id="btn-update" class="btn-update btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
             </div>
             


              </div>
            </div>






            </div>
        </div>
</div>


<script>


//Date picker
$('#datepicker-follow_up').datepicker({
     // startDate: new Date(),

      autoclose: true
      
    })


    $(document).ready(function(){
$('#btn-update').click(function(){
    event.preventDefault();
    var bus_id = $('#bus_id').val();
    var typeofcontact = $('#typeofcontact').val();
    var comment = $('#followupcomment').val();

    //alert(typeofcontact)


    $.ajax({
        url: 'process_upd_follow_up.php',
        type: 'POST',
        data: {
                bus_id:bus_id,
                typeofcontact:typeofcontact,
                comment:comment
   

      
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







</script>