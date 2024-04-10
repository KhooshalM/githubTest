<?php
include_once('connectdb.php');
error_reporting(0);
session_start();


$capacity=$_POST['capacity'];
//echo $capacity;
//echo "<br>";

$yearofmake=$_POST['yearofmake'];
//echo $yearofmake;
//echo "<br>";

//$start_date=$_POST['datepicker_start_date'];
$start_date= date("d-M-Y", strtotime($_POST['datepicker_start_date'])); 
//echo $start_date;
//echo "<br>";

//$end_date=$_POST['datepicker_end_date'];
$end_date= date("d-M-Y", strtotime($_POST['datepicker_end_date']));
//echo $end_date;
//echo "<br>";

$brn=$_POST['brn'];
//echo $brn;
//echo "<br>";
$user=$_POST['user'];
//echo $user;
//echo "<br>";

$towing=$_POST['towing'];

//echo $towing;
//echo $towing;
//echo "<br>";



$critical=$_POST['criticall'];
//echo $critical;
//echo "<br>";

$medical=$_POST['medical'];
//echo $medical;
//echo "<br>";

$wkyom=$yearofmake;
$wkcapacity=$capacity;
$wkbrn=$brn;

//echo $wkbrn;

//FIND BASIC PREMIUM
$sql="select cicl.pkg_premium.bp_3a_premium('$wkyom','$wkcapacity','$wkbrn')as PREMIUM from dual";

$sidwk = oci_parse($conn,$sql);
oci_execute($sidwk);

//echo $sidwk;
while($row=oci_fetch_assoc($sidwk)){
 $prm=$row['PREMIUM'];
 //echo $prm;

}             
//BASIC PREMIUM END



//FIND EXTENSION PREMIUM
$extsql="select cicl.pkg_premium.ep_extension_premium('$start_date','$end_date','$prm')as EXT_PREMIUM from dual";
$extid = oci_parse($conn,$extsql);
oci_execute($extid);


while($row=oci_fetch_assoc($extid)){
 $ext_prm=$row['EXT_PREMIUM'];
 //echo $ext_prm;

}     
//END




//GET TOWING
$towing_sql="select cicl.pkg_premium.proc_towing('M3','$towing')as TOWING from dual";
$towingsid = oci_parse($conn,$towing_sql);
oci_execute($towingsid);


while($row=oci_fetch_assoc($towingsid)){
 $towing_prm=$row['TOWING'];
 //echo $ext_prm;

}     

//END


//FIND ALL TOTAL 
$total=$prm+$ext_prm+$towing_prm;


?>

<?php 

include_once('header.php'); 

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4></i> Basic Premium - <?php echo $prm ?></h4>
        
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
           
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
    

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
     
       
        <div class="col-xs-6">
         

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Basic Premium:</th>
                <td><b><?php echo $prm ?></b></td>
              </tr>
              <tr>
                <th style="width:50%">Extension Premium:</th>
                <td><b><?php echo $ext_prm?></b></td>
              </tr>
              <tr>
                <th>Towing </th>
                <td><b><?php echo $towing_prm; ?></b></td>
              </tr>
              <tr>
                <th>Other Charges </th>
                <td><b><?php ?></b></td>
              </tr>
              <tr>
                <th>Policy Fee </th>
                <td><b><?php ?></b></td>
              </tr>
              <tr>
                <th><h3>Total</h3></th>
                <td><h3><b><?php echo  $total?></b></h3></td>
              </tr>
              
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="javascript:history.back()"  class="btn btn-default">Previous</a>
          
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

                                
        
   
   
            
    </section>
    <!-- /.content -->



 
    




</div>






<?php include_once('footer.php'); ?>

<script>


</script>