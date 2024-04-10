<?php 
include_once('connectdb.php');
session_start();

include_once('header.php'); 

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
        <div class="col-md-12">
        <div class="box box-warning">
        <div class="box-header with-border">
                <h3 class="box-title">Customer Details</h3>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <div class="box-body">

            <form role="form" method="POST" action="">
              <div class="box-body">
              <div class="form-group">
                  <label>Title</label>
                  <select class="form-control" name="title" required>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Dr</option>
                    <option>Miss</option>
                    <option>Ms</option>
                    <option>Prof</option>
                    <option>Hon</option>
                    <option>Capt</option>
                    <option>Rev</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input type="text" class="form-control" name="fname" id="exampleInputPassword1" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input type="text" class="form-control"   name="surname" id="exampleInputPassword1" placeholder="Enter Surname" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Phone Number</label>
                  <input type="text" class="form-control"  name="mobileno" id="exampleInputPassword1" placeholder="Enter Phone Number" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
              </div>
            </form>




<div class="col-md-12">

            <table id="customertable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $me_code=$_SESSION['me_code'];
                          $brn=$_SESSION['me_brn'];

                          $sql="SELECT a.mmc_id, a.mmc_surname, a.mmc_firstname, a.mmc_initials,
                          a.mmc_title, a.mmc_nicno, a.mmc_phoneno, a.mmc_mobileno,
                          a.mmc_email, a.mmc_address1, a.mmc_address2, a.mmc_address3,
                          a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
                          a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
                          a.modify_date, a.mmc_status
                          FROM me_m_customers a";
                             $result=oci_parse($conn,$sql);
                             oci_execute($result);
                             while($row=oci_fetch_assoc($result))
                                        
                            {
                               // $title=ociresult($result, strtoupper("mmc_title"));
                               // $firstname=ociresult($result, strtoupper("mmc_firstname"));
                                //$surname=ociresult($result, strtoupper("mmc_surname"));
                               // $mobnum=ociresult($result, strtoupper("mmc_mobileno"));
                                
                            echo '<tr>
                            <td>'.$row['MMC_TITLE'].'</td>
                            <td>'.$row['MMC_FIRSTNAME'].'</td>
                            <td>'.$row['MMC_SURNAME'].'</td>
                            
                            <td>'.$row['MMC_MOBILENO'].'</td>';
                           



                               
                            
                            }
                            echo '</tr>';
                          ?>
                        
                               
                        


                        </tbody>
                        
                    </table>

            </div>

            </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
$(document).ready(function() {
    $('#customertable').DataTable({
        "order": [
            [9, "desc"]
        ]
    });
});
</script>


<?php include_once('footer.php'); ?>











<?php
if(isset($_POST["submit"])){
$fname=strtoupper($_POST['fname']);
$surname=strtoupper($_POST['surname']);
$title=strtoupper($_POST['title']);
$mobileno=strtoupper($_POST['mobileno']);
//$status="A";
//echo $title;
//echo "<br>";
//echo $fname;
//echo "<br>";
//echo $surname;
//echo "<br>";
//echo $mobileno;
//echo "<br>";


$insert="INSERT into ME_M_CUSTOMERS (mmc_surname,mmc_firstname,mmc_title,mmc_mobileno,mmc_mecode,mmc_status)  VALUES ($surname,$fname,$title,$mobileno,$me_code,'A')";
$stid = oci_parse($conn,$insert); 
oci_execute($stid);




}

?>