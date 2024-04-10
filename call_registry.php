
<?php
include_once('connectdb.php');
session_start();
if ($_SESSION['me_code']=="")
{
  header('location:index.php');
}
$me_code=$_SESSION['me_code'];
//echo $me_code;
?>
<?php include_once('header.php'); ?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

     
 <!-- Main content -->
 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Customer Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
              <div class="form-group">
                  <label>Title</label>
                  <select class="form-control" name="title">
                    <option>Captain</option>
                    <option>DR</option>
                    <option>Hon</option>
                    <option>Miss</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Ms</option>
                    <option>Prof</option>
                    <option>Rev</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFname">Customer First Name</label>
                  <input type="name" class="form-control" name="fname" id="exampleInputfirstname" placeholder="Enter Customer First Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputLname">Customer Last Name</label>
                  <input type="Lname" class="form-control" name="lname" id="exampleInputLname" placeholder="Enter Customer Surname" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">Customer Address</label>
                  <input type="Address" class="form-control" name="address" id="exampleInputAddress" placeholder="Enter Customer Address">
                </div>
                <div class="form-group">
                  <label for="exampleInputPhone">Customer Phone No</label>
                  <input type="Address" class="form-control" name="phonenum" id="exampleInputPhone" placeholder="Enter Phone No" required>
                </div>
                <!-- select -->
                <div class="form-group">
                  <label>Type Of Business</label>
                  <select class="form-control" name="type_of_business">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

            
            </form>
          </div>
          <!-- /.box -->
     
 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFname">Remarks</label>
                  <div class="form-group">
                  
                  <textarea class="form-control" name="remarks" rows="3" placeholder="Enter ..."></textarea>
                </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputLname">Client Status</label>
                  <select class="form-control" name="status">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">Status Of Business</label>
                  <select class="form-control" name="status_of_business">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFname">Other Remarks</label>
                  <div class="form-group">
                  
                  <textarea class="form-control" rows="3" name="oth_remarks" placeholder="Enter ..."></textarea>
                </div>
                </div>
              
              </div>
              <!-- /.box-body -->

            
            </form>
          </div>
          <!-- /.box -->
     

        
      

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
      

        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Customer Insured Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFname">Customer Current Insurer</label>
                  <input type="name" class="form-control" id="exampleInputfirstname" name="current_insurer" placeholder="Enter Customer Current Insured">
                </div>
                <div class="form-group">
                
                  <label for="exampleInputLname">Premium</label>
                  <input type="Lname" class="form-control" name="premium" id="exampleInputLname" placeholder="Enter Premium">
                
                </div>
   
              </div>
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                <div class="form-group">
                <div class="col-xs-5">
                  <label for="exampleInputAddress">Renewal Date</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="renewal_date">
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="col-xs-5">
                  <label for="exampleInputAddress">Road Tax  Date</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker1" name="road_tax_date">
                </div>
                </div>
                </div>
               

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          <!-- general form elements disabled -->
          <div class="box box-warning">
            
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                <div class="form-group">
                <div class="col-xs-5">
                  <label for="exampleInputAddress">Follow Up Date 1</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="follow_update1">
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="col-xs-5">
                  <label for="exampleInputAddress">Follow Up Date 2</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker1" name="follow_update2">
                </div>
                </div>
                </div>
               

           
              
            </div>
            <!-- /.box-body -->






            
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="col-md-6">

    <input type="submit" value="Submit" class="btn btn-block btn-success btn-lg">
    </div>
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  <!-- bootstrap time picker -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    
    //Date picker1
    $('#datepicker1').datepicker({
      autoclose: true
    })


  

   
  })
</script>
 
<?php include_once('footer.php'); ?>