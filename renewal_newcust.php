<?php 
include_once('connectdb.php');
session_start();
$m_brn=$_SESSION['me_brn'];
include_once('header.php'); 

$polarray=array();

$polno=$_GET['pol'];

$polno_array[] = $polno;
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        
            <small><?php  ?></small>
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
                <h3 class="box-title">New Renewal Customer</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            
            <div class="box-body">
             
           
                 <div class="col-md-12">
         
                 <table id="salesreporttable" class="table table-striped">
                        <thead>
                                <tr>
                                <th>Title</th>
                                <th>FirstName</th>
                                <th>Last Name</th>
                                <th>Mobile No</th>
                                <th>Assign</th>
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
                                

                                foreach ($polno_array as $polno_value) {
                                
                            ?>
                                
                                <tr>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $fname; ?></td>
                                <td><?php echo $surname; ?></td>
                                <td><?php echo $mobno; ?></td>
                                

                                <td> <a href="assign_renewal_bus.php?cus_id=<?php echo $cus_id;  ?>&pol=<?php echo $polno_value; ?>" class="btn bg-olive margin">Assign Business</button></td>
                             
                                </tr>
                     <?php  }} ?>


                        </tbody>
                    </table>



                   
                
                 </div>
        </div>



    </section>
    <!-- /.content -->

</div>


<!--  Modal   -->
<?php /* include "update_business.php"; */?>

<?php /*include "follow_up.php"; */?>

<?php /*include "view_quotation.php";*/?>




<script>
/*    
$(document).ready(function() {
    $('#salesreporttable').DataTable({   

    });
});

*/

</script>
<script>
//-------------AJAX FOR VIEW QUOTATION-----------------
/*

$(document).on("click", ".btn-quotation", function(){
            var quo_seq = $(this).data('id');
            
            //alert(bus_id);
                       
                        $.ajax({
                        url: 'view_quotation_ajax.php',
                        type: 'post',
                        data: {
                          
                            quo_seq: quo_seq 
                        
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-view').html(response); 
                        $('#modal-primary-view').modal('show'); 
                        }
                  
                      });
                });*/

// -------------------- END ----------------------------------------

</script>


<script>
    //-------------AJAX FOR FOLLOW UP-----------------
/*$(document).on("click", ".btn-follow", function(){
            var business_id = $(this).data('id');
            var cus_id=$(this).data('cus');
            //alert(cus_id);
                       
                        $.ajax({
                        url: 'follow_up_modal.php',
                        type: 'post',
                        data: {
                            business_id: business_id,
                            cus_id:cus_id
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-fol').html(response); 
                        $('#modal-default-fol').modal('show'); 
                        }
                  
                      });
                });*/

</script>
                
<script>/*
$(document).on("click", ".btn-view", function(){
            var business_id = $(this).data('id');
            var cus_id=$(this).data('cus');
           // alert(cus_id);
                       
                        $.ajax({
                        url: 'update_business_modal.php',
                        type: 'post',
                        data: {
                            business_id: business_id,
                            cus_id:cus_id
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body').html(response); 
                        $('#modal-default-bus').modal('show'); 
                        }
                  
                      });
                });
*/

</script>


<script>
/*$(document).on("click", ".btn-detail", function(){
            var polno = $(this).data('id');
            var polseq = $(this).data('seq');
            var bus_id = $(this).data('bus');
            
          //  alert(polseq);
                       
                        $.ajax({
                        url: 'policy_detail_ajax.php',
                        type: 'post',
                        data: {
                          
                            polno: polno, 
                            polseq:polseq,
                            bus_id:bus_id
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-pol').html(response); 
                        $('#modal-primary-pol').modal('show'); 
                        }
                  
                      });
                });

// -------------------- END ----------------------------------------




$(document).on("click", ".btn-finalise", function(){
            var bus_id = $(this).data('id');
            //var polno = $('#pol_no').val();
           // var polseq = $('#pol_seq').val();
            //alert (bus_id);


            if(confirm('Are you sure to Finalise this Business ?')) {
                $.ajax({
                    url: 'finalise_ajax_bus.php',
                    type: 'POST',
                    data: {
                        
                    bus_id:bus_id
                  //  polno:polno,
                   // polseq:polseq
                     
                    
                    },
                    error: function() {
                      alert('Something is wrong, couldn\'t finalise record');
                    },
                     cache: false,
                     success: function (response) {
                      if(response == 1){
                        alert("Finalised")
                      }
                      else{
                        alert("Business NOT Finalised")
                      }
                      location.reload();
                    }
                });
            }


          }) 
      









*/
              
</script>





<?php include_once('footer.php'); ?>

