<?php 
include_once('connectdb.php');
session_start();

include_once('header.php'); 

?>
<?php

 /*  START OF INSERT   */



if(isset($_POST["submit"])){

  $me_code=$_SESSION['me_code'];
  $user=$_SESSION['me_fname'];
  $brn=$_SESSION['me_brn'];    
  $fname=strtoupper($_POST['fname']);
  $surname=strtoupper($_POST['surname']);
  $title=strtoupper($_POST['title']);
  $mobileno=$_POST['mobileno'];
  
  $initialsFname=substr($fname, 0, 1);
  $initialsLname=substr($surname, 0, 1);
  $initials=$initialsFname.'.'.$initialsLname;

  

 /*  TO CHECK CUSOTMER PHONE NUMER IF ALREADY EXIST  */
 /*  IF CUSTOMER PHONE NUMBER ALREADY EXIST - DENY PROCESS  */
  $check="SELECT mmc_mobileno FROM me_m_customers where mmc_mecode='$me_code' AND  mmc_mobileno='$mobileno'";
  $stmt=oci_parse($conn,$check); 
  oci_execute($stmt);
 if($row=oci_fetch_assoc($stmt))
                            
  {
    $chk_mobno=$row['MMC_MOBILENO'];
  }
  
  //echo $chk_mobno;


  
  if($chk_mobno > 1){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal({
                title: "Warning",
                text: "Mobile number Already Exist",
                icon: "error",
                button: "Ok",
              });
          });
          </script>';

  }
  


  /* ELSE  IF CUSTOMER PHONE NUMBER DOES NOT EXIST - DO  INSERT  */
  
else {
$insert="INSERT INTO me_m_customers (mmc_surname,mmc_firstname,mmc_initials,mmc_title,mmc_mobileno,mmc_mecode,created_by,created_date,modify_by,modify_date,mmc_status,mmc_brn)  
VALUES ('$surname','$fname','$initials','$title','$mobileno','$me_code','$user',sysdate,'$user',sysdate,'A','$brn')";
$stid = oci_parse($conn,$insert); 
oci_execute($stid);

if((oci_num_rows($stid) == true )){
echo '<script type="text/javascript">
                        jQuery(function validation(){
                        swal({
                          title: "Transaction!",
                          text: "Customer Created Successfully!",
                          icon: "success",
                         
                        });
                    });
                    
                    </script>';
                   
                    
                 header('refresh:1;daily_act.php');
                }

                else
                {
                  echo '<script type="text/javascript">
                            jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Details Not Matched",
                              icon: "error",
                              button: "Ok",
                            });
                        });
                        </script>';
                }


      }
    
}

 /*  END OF CHECKING AND PROCESSING CODE  */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Register
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
                <h3 class="box-title">Contact Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">
             
            <div class="row">
            <div class="col-md-3">
            <form role="form" method="POST" action="#">
                <label>Title</label>
                    <select class="form-control select2" style="width: 70%;" name="title" required>
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Dr</option>
                        <option>Miss</option>
                       

                    </select> 
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">First Name</label>
                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputSurname">Surname</label>
                    <input type="text" class="form-control"  name="surname" placeholder="Enter Surname" required>
                  </div>
                  <!-- /input-group -->

                </div>
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputMobile">Mobile No</label>
                    <input type="text" id="mobileno" class="form-control" name="mobileno" placeholder="Enter Mobile No"  required>
                    <span class="help-block" id="mobilenospan"></span>
                  </div>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->
              <div class="box-footer">
                <button type="submit" name="submit"   class="btn btn-primary">Create</button>
             </div>
            </form>
            <!-- /.box-body -->
            <br>   <br>   <br>













                    <br>


                    <table id="salesreporttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>Mobile No</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>Assign Business</th>
                              



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $me_code=$_SESSION['me_code'];
                            
                            $sql="SELECT a.mmc_id, a.mmc_surname, a.mmc_firstname, a.mmc_initials,
                            a.mmc_title, a.mmc_nicno, a.mmc_phoneno, a.mmc_mobileno,
                            a.mmc_email, a.mmc_address1, a.mmc_address2, a.mmc_address3,
                            a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
                            a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
                            a.modify_date, a.mmc_status
                            FROM me_m_customers a
                            WHERE 
                            mmc_status='A' 
                            AND mmc_mecode='$me_code'
                      ORDER BY 
                        created_date DESC";



                               $result=oci_parse($conn,$sql);
                               oci_execute($result);
                               while($row=oci_fetch_assoc($result))
                            
                            {
                                $cus_id=$row['MMC_ID'];
                                $title=$row['MMC_TITLE'];
                                $fname=$row['MMC_FIRSTNAME'];
                                $surname=$row['MMC_SURNAME'];
                                $mobno=$row['MMC_MOBILENO'];
                               

                            ?>
                                
                                <tr>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $fname; ?></td>
                                <td><?php echo $surname; ?></td>
                                <td><?php echo $mobno; ?></td>
                               

                                <td> <button type="button" data-id="<?php echo $cus_id; ?>" class="btn-id btn bg-orange margin">Update</button></td>
                                <td> <button type="button" data-id="<?php echo $cus_id; ?>" class="btn-inactive btn bg-maroon margin">Delete </button></td>
                                <td> <a href="assign_business.php?cus_id=<?php echo $cus_id;  ?>"  class="btn bg-olive margin">Assign Business</button></td>
                              </tr>
                     <?php  } ?>


                        </tbody>
                    </table>
                
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>



<!-- Passing Customer Update Modal   -->
<?php include "update_customer.php"; ?>





<script>
$(document).ready(function() {
    $('#salesreporttable').DataTable({
       
    });
});





</script>



<!-- Passing Customer ID in Ajax  -->
<!-- Passing Customer ID to UPDATE FORM MODAL -->

<script>
$(document).on("click", ".btn-id", function(){
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

