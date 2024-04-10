<?php 

include_once('connectdb.php');
error_reporting(0);
session_start();

include_once('header.php'); 



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Check Policy Renewal
            <small></small>
        </h1>
        <ol class="breadcrumb">
         
     
        </ol>
    </section>

  <!-- Main content -->
  <section class="content container-fluid">
  <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Contact Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">
             
            <div class="row">
            <div class="col-md-6">
                  <div class="input-group">
                  <label for="exampleInputFname">Enter Policy No</label>
                    <input type="text" class="form-control" name="polno" id="polno" placeholder="Enter Pol No" required>
                  </div>
                  <!-- /input-group -->
                </div>
                
            </div>
            </div> 
            <div class="box-footer">
                <button type="submit" name="submit"   class="btn-search btn btn-primary">Search</button>
             </div>

<br> 
<br>


<div class="output" id="output">

</div>





        </div>



  </section>
 
</div>
<!-- /.content-wrapper -->










<script>
//Date picker
$('#datepicker1').datepicker({
    autoclose: true
});

//Date picker
$('#datepicker2').datepicker({
    autoclose: true
});

$(document).ready(function() {
    $('#salesreporttable').DataTable({   

    });
});





$(document).on("click", ".btn-search", function(){
         var polno = $('#polno').val();
           // alert(polno);
        
                       
                        $.ajax({
                        url: 'pol_chek.php',
                        type: 'GET',
                        data: {
                          polno:polno
                        
                        
                        
                        },
                                          
                        success:function(data){
                          $("#output").html(data); 
                         // alert(data);
                        }
                  
                      });
                     
                });







</script>

<?php include_once('footer.php'); ?>