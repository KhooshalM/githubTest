<?php 
include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
  $user=$_SESSION['me_fname'];
  $brn=$_SESSION['me_brn']; 
include_once('header.php'); 

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Assign Business
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Details</h3>
            </div>
        </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">
            <div class="row">
          
                    <div class="col-md-3">

                    
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                        <?php
                        $cus_id=$_GET['cus_id'];
                                        
                        $sql="SELECT a.mmc_id, a.mmc_surname, a.mmc_firstname, a.mmc_initials,
                                        a.mmc_title, a.mmc_nicno, a.mmc_phoneno, a.mmc_mobileno,
                                        a.mmc_email, a.mmc_address1, a.mmc_address2, a.mmc_address3,
                                        a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
                                        a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
                                        a.modify_date, a.mmc_status
                                        FROM me_m_customers a
                                        WHERE mmc_id='$cus_id'";
                                        $result=oci_parse($conn,$sql);
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
                                         
                                        }
                                        ?>
                         <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                    <td>Title </td>
                                    <td>: </td>
                                    <td><b><?php echo $title ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Firstname </td>
                                    <td>: </td>
                                    <td><b><?php echo $fname ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Surname </td>
                                    <td>: </td>
                                    <td><b><?php echo $surname ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Mobile No </th>
                                    <td>: </th>
                                    <td><b><?php echo $mobno ?></b></td>
                                    </tr>
                                  
                                </table>
                                </div>
                            
                            </div>

                        
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">

                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                    <td>NIC </td>
                                    <td>: </td>
                                    <td><b><?php echo $nic ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Phone No </td>
                                    <td>: </th>
                                    <td><b><?php echo $number ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Email  </td>
                                    <td>: </td>
                                    <td><b><?php echo $email ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>District </td>
                                    <td>: </th>
                                    <td><b><?php echo $district ?></b></td>
                                    </tr>
                                   
                                </table>
                                </div>
                            
                            </div>

                        
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">

                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                    <td>Address 1 </td>
                                    <td>: </th>
                                    <td><b><?php echo $address1 ?></td>
                                    <td> </td>
                                    <td></td>
                                   </tr>
                                    <tr>
                                    <td>Address 2 </td>
                                    <td>: </td>
                                    <td><b><?php echo $address2 ?></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td>Address 3</th>
                                    <td>: </th>
                                    <td><b><?php echo $address3 ?></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td>City </td>
                                    <td> :</td>
                                    <td><b><?php echo $city ?></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td>Ocupation </th>
                                    <td>: </th>
                                    <td><b><?php echo $ocupation ?></b></td>
                                    </tr>
                                    
                                </table>
                                </div>
                            
                            </div>

                        
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>



                <div class="col-md-2">
                    <div class="box box-primary">
                        <div class="box-body box-profile">

                        <div class="box-body">
                                   <center> <b><u>Utilities</u></b>  
                                   <br> <br> 
                            <div class="box-body table-responsive no-padding">
                            <button type="button" data-id="<?php echo $cus_id; ?>" class="btn-id btn bg-orange margin btn-md">Update</button>
                            <br><br> <hr>
                            <button type="button" data-id="<?php echo $cus_id; ?>" data-ref="<?php echo $referal_id; ?>"  class="btn-summary btn bg-olive margin btn-md">Referal Summary</button>
                            </div>
                            </center> 
                        </div>

                        
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>










           </div>
            </div>



   
        <div class="col-md-12">
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Risk Information </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="" method="POST">



                <!-- text input -->
                <div class="row">
                <div class="col-xs-6">
                <label for="example">Insured Name</label>
                  <input type="text" class="form-control" name="insured_name" id="insured_name" placeholder="Enter Insured Name" required>
                  
                </div>
                </div>
<br>


              <div class="row">
                <div class="col-xs-3">
                <label for="example">Class</label>
                <select class="form-control select2" style="width: 100%;" name="class" id="class" required>
                <option>- Select Class -</option>
                <?php
                 $sqlclass="SELECT a.cla_code, a.cla_description, a.created_by, a.created_date,
                          a.modified_by, a.modified_date
                          FROM uw_r_classes a order by created_date";
                 $stmt=oci_parse($conn,$sqlclass); 
                 oci_execute($stmt);
                 while($row=oci_fetch_assoc($stmt)){
                  
                    $cla_code=$row['CLA_CODE'];
                    $cla_desc=$row['CLA_DESCRIPTION'];
                   
                    
                   echo "<option value=$cla_code> $cla_desc </option>";
                 }
                 ?>                   
                       
                </select> 
                </div>
                <div class="col-xs-3">
                <label for="example">Product</label>
                <select class="form-control select2" style="width: 100%;" name="product" id="product" >
                      
                       
                </select> 
                </div>
                <div class="col-xs-3">
                <label for="example">Risk info</label>
                  <input type="text" class="form-control" name="risks" id="risks" placeholder="Enter Risk" required>
                  
                  <div id="result"> </div>
                </div>


                <div class="col-xs-3">
                <label for="example">Current Insurer</label>
                <select class="form-control select2" style="width: 100%;" name="current_insurer" id="current_insurer" required>
                <option value="">- Select Insurer -</option>
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
              </div>
<br>



              <div class="row">
                <div class="col-xs-3">
                <label for="example">Sum Insured</label>
                  <input type="text" class="form-control" name="sum_insured" id="sum_insured" placeholder="Enter Sum Insured" onkeypress="return onlyNumberKey(event)">
                </div>

                <div class="col-xs-3">
                <label for="example">Premium</label>
                  <input type="text" class="form-control" name="premium" id="premium" placeholder="Enter Premium" name="premium" onkeypress="return onlyNumberKey(event)">
                </div>
                

                <div class="col-xs-3">
                <label for="example">Policy Renewal Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-policy_renewal" name="policy_renewal_date">
                </div>
                </div>

                
                <div class="col-xs-3">
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date" >
                </div>
                </div>

              




              </div>

<br>

              <div class="row">
              <div class="col-xs-3">
                <label for="example">Road Tax End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="road_tax" name="road_tax">
                </div>
                </div>

              
                
                <div class="col-xs-3">
                <label for="example">Leasing Company</label>
                <input type="text" class="form-control" name="leasing_com" id="leasing_com" placeholder="Enter Leasing Company">
                </div>
                
                <div class="col-xs-3">
                <label for="example">Special Promotion</label>
                <select class="form-control select2" style="width: 100%;" name="promotion" id="promotion" >
                        <option selected></option>
                        
                </select>
                </div>

                
                <div class="col-xs-3">
                <label for="example">Type Of Prospective</label>
                <select class="form-control select2" style="width: 100%;" name="type_of_pros" id="type_of_pros" required>
                        <option value="">- Select -</option>
                        <option value="Pending">Pending</option>
                        <option value="Prospective">Propective</option>
                </select> 
                </div>


              </div>
<br>



            <div class="row">
       
                <div class="col-xs-3">
                <label for="example">Remarks</label>
                  <textarea class="form-control" placeholder="Enter Remarks" name="remarks" id="remarks"></textarea>
                </div>

               
              </div>

              <input type="hidden" class="form-control" name="cus_id" id="cus_id" value="<?php echo $cus_id ?>">
            <input type="hidden" class="form-control" name="me_code" id="me_code" value="<?php echo $me_code ?>">
            <input type="hidden" class="form-control" name="me_username" id="me_username" value="<?php echo $user ?>">
            <input type="hidden" class="form-control" name="me_brn" id="me_brn" value="<?php echo $brn ?>">
            <input type="hidden" class="form-control" name="bus_status" id="bus_status" value="<?php echo "N"?>"> 
              
            </div>
           
            <div class="box-footer">
                <button type="submit" name="submit" id="btn-submit"  class="btn-submit btn btn-primary">Create Business</button>
             </div>
            

        

             

          

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->















            
    </section>
    <!-- /.content -->



 
    




</div>



<!-- Passing Customer Update Modal   -->
<?php include "update_customer.php"; ?>

<?php include "summary_modal.php"; ?>



<script>
$(document).ready(function() {
    $('#salesreporttable').DataTable({
       
    });
});

</script>

<script>

      //Initialize Select2 Elements
      $('.select2').select2()
//Date picker
$('#datepicker-follow_up').datepicker({
      autoclose: true
      
    })


$('#datepicker-policy_renewal').datepicker({
      autoclose: true,
      
      
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





//-------------AJAX FOR UPDATE CUSTOMER DETAILS-----------------

$(document).on("click", ".btn-id", function(){
            var cus_id = $(this).data('id');
            
          //  alert(ref_id);
                       
                        $.ajax({
                        url: 'customer_update_form.php',
                        type: 'post',
                        data: {
                          
                        cus_id: cus_id 
                        
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-cus').html(response); 
                        $('#modal-default-cus').modal('show'); 
                        }
                  
                      });
                });

// -------------------- END ----------------------------------------
             
 




//-------------AJAX TO VIEW SUMMARY DETAILS OF CUSTOMER -------------

$(document).on("click", ".btn-summary", function(){
            var cus_id = $(this).data('id');
            var ref_id = $(this).data('ref');
          //  alert(cus_id);
                       
                        $.ajax({
                        url: 'view_summary.php',
                        type: 'post',
                        data: { cus_id: cus_id, ref_id:ref_id  },
                                          
                        success: function(response){ 
                        $('.modal-body').html(response); 
                        $('#modal-default-summary').modal('show'); 
                        }
                  
                      });
                });


//--------------------END-----------------------------





// ------------- AJAX TO PROCESS BUSINESS DETAIL TO INSERT ------------- 

$(document).ready(function(){
$('#btn-submit').click(function(){
    event.preventDefault();
    var cus_id = $('#cus_id').val();
    var pr_class  = $('#class').val();
    var product = $('#product').val();
    var risks = $('#risks').val();
    var current_insurer =  $('#current_insurer').val();
    var sum_insured = $('#sum_insured').val();
    var premium = $('#premium').val();
    var policy_renewal = $('#datepicker-policy_renewal').val();
    var follow_up = $('#datepicker-follow_up').val();
    var road_tax = $('#road_tax').val();
    var leasing_com = $('#leasing_com').val();
    var sp_promotion = $('#promotion').val();
    var type_of_pros = $('#type_of_pros').val();
    var remarks = $('#remarks').val();
    var me_code =  $('#me_code').val();
    var me_username = $('#me_username').val();
    var me_brn = $('#me_brn').val();
    var insured_name = $('#insured_name').val();
    var bus_status = $('#bus_status').val();


    
    if(risks  == ""){
      
      jQuery(function validation(){
      swal({
      title: "Please Fill Risk Field",
      text: "Record NOT Added",
      icon: "error",
      button: "Ok",
       });
       });
    }
    


     else {


   // alert(me_brn);
       $.ajax({
            url: 'process_business.php',
            type: 'post',
            data: {
                  
                    cus_id: cus_id,
                    pr_class:pr_class,
                    product:product,
                    risks:risks,
                    current_insurer:current_insurer,
                    sum_insured:sum_insured,
                    premium:premium,
                    policy_renewal:policy_renewal,
                    follow_up:follow_up,
                    road_tax:road_tax,
                    leasing_com:leasing_com,
                    sp_promotion:sp_promotion,
                    type_of_pros:type_of_pros,
                    remarks:remarks,
                    me_code:me_code,
                    me_username:me_username,
                    me_brn:me_brn,
                    insured_name:insured_name,
                    bus_status:bus_status

                   },
                    
                   cache: false,
                   success: function (data) {

                     // alert(data);

                     if(data == 0){
                      jQuery(function validation(){
                     swal({
                     title: "Business Already Exist ",
                     text: "Record NOT Added",
                     icon: "error",
                     button: "Ok",
                      });
                      });
                     }
                     if(data == 1){
                      jQuery(function validation(){
                    swal({
                    title: "Business Transaction",
                    text: "Business Record Added",
                    icon: "success",
                    button: "Ok",
                     });
                     });
                     }
                    }

              })
            }

  });
});




//--------------------END-----------------------------

//ajax to check if vehicle no is already insured
$("#risks").blur(function() {

var risk = $('#risks').val();
//alert(risks);

$.ajax({
    url: 'check_risks.php',
    type: 'post',
    data: {
      'risks':risk,
      'risks_check':1,
  },


  success:function(response) {	

 
    $("#risks_error").remove();

    
    $("#risks").after("<span id='risks_error' class='text-danger'>"+response+"</span>");
  },

  error:function(e) {
    $("#result").html("Something went wrong");
  }

});
});



    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    

</script>






<?php include_once('footer.php'); ?>

