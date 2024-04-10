<?php 
include_once('connectdb.php');
session_start();

include_once('header.php'); 
$pol=$_GET['polno_va'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        RENEWAL BUSINESS
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Assign Renewal Business</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">
             
            <div class="row">
            <div class="col-md-12">
          
            <br>   <br>   <br>

            <form  method="post">
                <div class="box box-primary">
                   <div class="row">
                     <div class="col-md-12">

                     
            <div class="box-body">
              <div class="row">

                <div class="col-xs-3">
                  <label for="example">Class</label>
                   <select class="form-control 2" style="width: 100%;" name="class" id="class" required disabled>
                     <!-- <option value="<?php echo  $cla_code ?>"><?php echo $pol_class_desc; ?></option> -->
                   </select> 
                </div>


                <div class="col-xs-3">
                <label for="example">Product</label>
                <select class="form-control " style="width: 100%;" name="product" id="product" required disabled>
                <!--<option value="<?php echo  $pol_prd_code ?>"><?php echo $prod_desc; ?></option> -->
                </select> 
               
                </div> 


                <div class="col-xs-3">
                  
                  <label for="example">Risk info</label>
                    <input type="text" class="form-control" name="risks" id="risks"  value="<?php /*echo $risk*/ ?>" required disabled>
                  </div>


                  <div class="col-xs-3"> 
                <label for="example">Current Insurer</label>
                <select class="form-control " style="width: 100%;" name="current_insurer" id="current_insurer" required>
                
                <?php /*if($insurer =="") { echo "<option value=>- Select Insurer -</option>";} else { echo "<option> $insurer </option>"; }*/ ?>       
                </select>
                </div>


                <div class="col-xs-3">
                  <br>
                <label for="example">Sum Insured</label>
                  <input type="text" class="form-control" name="sum_insured" id="sum_insured" value="<?php /*echo $pol_sum_insured*/?>" >
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Premium</label>
                  <input type="text" class="form-control" name="premium" id="premium" value="<?php /* echo $pol_total_premium;*/?>" name="premium" required >
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Policy Renewal Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-policy_renewal" name="policy_renewal_date">
                </div>
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date">
                </div>
                </div>


                <div class="col-xs-3"><br>
                <label for="example">Road Tax End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="road_tax" name="road_tax" value="">
                </div>
                </div>


                <div class="col-xs-3"> <br>
                <label for="example">Leasing Company</label>
                <input type="text" class="form-control" name="leasing_com" id="leasing_com" placeholder="Enter Leasing Company" value="">
                </div>

                      
                <div class="col-xs-3"> <br>
                <label for="example">Type Of Prospective</label>
                <select class="form-control " style="width: 100%;" name="type_of_pros" id="type_of_pros" required>
                        <option value="">- Select -</option>
                        <option value="Pending">Pending</option>
                        <option value="Prospective">Propective</option>
                </select> 
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Special Promotion</label>
                <select class="form-control " style="width: 100%;" name="promotion" id="promotion" >
                        <option selected></option>        
                </select>
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Remarks</label>
                  <textarea class="form-control" placeholder="Enter Remarks" name="remarks" id="remarks"></textarea>
                </div><br><br>


               <div class="col-xs-12"> <br>

                <div class="box-footer">
                  <button type="button" class="btn btn-danger pull-left">Back</button> 
                   <button type="button" name="update" id="submit_btn" data-cus-id="<?php echo $cus_id; ?>" class="btn-update-bus btn btn-primary pull-right">Assign</button>
               </div>

              </div>
            


            </div>
          </div>


            </div>
        </div>
</div>

            </div>










                    <br>


                 
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>









<script>
$(document).ready(function() {
    $('#salesreporttable').DataTable({
       
    });
});





</script>



<!-- Passing Customer ID in Ajax  -->
<!-- Passing Customer ID to UPDATE FORM MODAL -->

<script>
/*$(document).on("click", ".btn-id", function(){
            var cus_id = $(this).data('id');
            
          //  alert(cus_id);
                       
                        $.ajax({
                        url: 'customer_update_form.php',
                        type: 'post',
                        data: {
                          cus_id: cus_id,
                        
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-cus').html(response); 
                        $('#modal-default-cus').modal('show'); 
                        }
                  
                      });
                });


              */
</script>




<!-- Passing Customer ID in Ajax  -->
<!-- Passing Customer ID to INACTIVATE RECORD -->

<script>
$(document).ready(function(){
$('.btn-inactive').click(function(){
            var cus_id = $(this).data('id');
           // alert (cus_id);
            if(confirm('Are you sure to delete this record ?')) {
                $.ajax({
                    url: 'inactive_cus.php',
                    type: 'POST',
                    data: {cus_id:cus_id},
                    error: function() {
                      alert('Something is wrong, couldn\'t delete record');
                    },
                     cache: false,
                     success: function (response) {
                      if(response == 1){
                        alert("Record Inactivated")
                      }
                      else{
                        alert("Record Not Inactivated")
                      }
                      location.reload();
                    }
                });
            }


          }) 
        });

              
</script>




<?php include_once('footer.php'); ?>

