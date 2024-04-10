<?php 
include_once('connectdb.php');
session_start();
$m_brn=$_SESSION['me_brn'];
include_once('header.php'); 

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
                <h3 class="box-title">Business  Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            
            <div class="box-body">
             
           
                 <div class="col-md-12">
         
                 <table id="salesreporttable" class="table table-striped">
                        <thead>
                                <tr>
                                <th>Follow Up Date</th>
                                <th>Customer Name</th>
                                <th>Mobile No</th>
                                
                                <th>Risk</th>
                               
                              
                              <!--  <th>Leasing Company</th>-->
                                
                                <th>Product</th>
                                <th>Prospective</th>
                                <th>Business Stats</th>
                                <!-- <th>Customer Details</th> -->
                                <!--<th>Business Details</th>-->
                                <th>Follow Up</th>
                                <th>Quotation</th>
                                <th>View Quotation</th>
                                <th>Finalise.</th>
                               
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $today_date=date("d/m/Y");
                           // echo $today_date;
                            $me_code=$_SESSION['me_code'];
                            

                            $sql="SELECT 
                            b.mmc_firstname,
                            b.mmc_surname,
                            b.mmc_phoneno,
                            b.mmc_mobileno,
                            a.mtb_seq,
                            a.mtb_mmc_id, 
                            a.mtb_vehi_no,
                            a.mtb_insurer,
                            a.mtb_sum_insured,
                            a.mtb_premium,
                            a.mtb_leasing_com,
                            a.mtb_follow_up_date,
                            a.mtb_pol_renewal_date, 
                            a.mtb_class,
                           (SELECT b.cla_description FROM uw_r_classes b where a.mtb_class=b.cla_code)CLASS_DESC,
                           a.mtb_product,
                           a.mtb_product,
                           (SELECT c.prd_description FROM uw_m_products c where a.mtb_product=c.prd_code)PRODUCT_DESC,
                           a.mtb_road_tax_date,
                           a.mtb_sp_promotion_code,
                           a.mtb_remarks,
                           a.mtb_type_of_prospective,
                           a.me_code,
                           a.created_by,
                           a.modified_by,
                           a.created_date,
                           a.modified_date,
                           a.mtb_status,
                           a.mtb_pol_no,
                           a.mtb_bus_status,
                           (SELECT c.mtq_quo_seq FROM me_t_quotation c WHERE c.mtb_seq=A.mtb_seq)AS QUO_SEQ,
                           (SELECT c.mtq_period_form FROM me_t_quotation c WHERE c.mtb_seq=A.mtb_seq)AS MTQ_PERIOD_FORM
                             FROM me_t_risks a,me_m_customers b 
                            WHERE a.mtb_mmc_id=mmc_id
                            --AND mtb_follow_up_date !=to_char(sysdate)
                            AND me_code='$me_code'
                            AND mtb_status='A' -- A = status of business is active
                            AND mtb_bus_status='R' --R = status of business is renew
                            order by mtb_follow_up_date desc";
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
                                $bus_status=$row['MTB_BUS_STATUS'];
                                $quo_seq=$row['QUO_SEQ'];
                                $start_date=$row['MTQ_PERIOD_FORM'];
                                $pol=$row['MTB_POL_NO'];
                       
                            ?>
                                
                               
                                
                                <tr>
                                    
                                <td> <?php echo $follow_up_date ?></td>
                                <td><b><?php echo $customername ?> </b></td>
                                <td><?php echo $mobno ?> </td>
                                <td><?php echo $risk ?> </td>
                                <td><?php echo $product_desc?> </td>
                            
                                
                               <td><?php echo $type_of_prospective ?></td>
                               <!-- <td> <button class="btn btn-<?php if($type_of_prospective=="PROSPECTIVE") { echo "success";} else { echo"danger"; } ?> btn-xs"><?php echo $type_of_prospective ?></button></td>-->
                                <td><?php echo $bus_status ?></td>
                                <!--<td> <button class="btn-id btn btn-warning btn-sm" data-id="<?php echo $mmc_id; ?>" >Customer Details</button></td>-->
                                <!--<td> <button type="button" data-id="<?php echo $seq; ?>" data-cus="<?php echo $mmc_id; ?>" class="btn-view btn bg-primary margin btn-sm">Business Details</button></td>-->
                                <td> <button type="button" data-id="<?php echo $seq; ?>" data-cus="<?php echo $mmc_id; ?>" class="btn-follow btn bg-maroon margin btn-sm">Follow Up</button></td>


                                
                                <td>
                                    
                                <?php if($quo_seq ==""){ ?>
                                <a href="<?php if($class=="MC" || $class=="M3"){ echo "quotation_renew.php"; } else { echo "quotation2.php";  }?>?bus_id=<?php echo  $seq  ?>&cus_id=<?php echo $mmc_id ?>&pol_sts=<?php  echo "R"; ?>&pol_no=<?php echo $pol ?>" class="btn-quotation btn bg-black margin btn-sm">Quotation</a>
                                </td>
                                  <?php }
                                    else { echo "<a href='update_quotation.php?quo_id=$quo_seq&pol_sts=R' class='btn-quotation btn bg-green margin btn-sm'>Update Quote</button>"; } ?>


                                <td>
                                <?php if($quo_seq ==""){
                                    echo "";
                                }
                                else{ 
                                    echo " <button type='button' data-id='$quo_seq&pol_sts=R' class='btn-quotation btn bg-purple margin btn-sm'><i class='fa fa-fw fa-eye'></i></i></button>";
                                }
                                
                                ?>
                                
                                
                                </td>
                            
                                
                                <td>
                                  
                                <?php if($quo_seq ==""){
                                    echo "";
                                }
                                else{ 
                                    echo " <button type='button' data-id='$seq' class='btn-finalise btn btn-success  pull-right'><i class='fa fa-fw fa-check-square-o'></i></button>";
                                }
                                
                                ?>
                                
                                
                               
                              
                              
                              </td>
                              
                              </tr>
                                
                              



                            <?php  } ?>


                            </tbody>
                    </table>



                   
                
                 </div>
        </div>

    </section>
    <!-- /.content -->

</div>
<div class="modal fade" id="modal-primary-pol">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Policy Detail</b></h4>
              </div>
              <div class="modal-body-pol">
               


              </div>
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!--  Modal   -->
<?php include "update_business.php"; ?>

<?php include "follow_up.php"; ?>

<?php include "view_quotation.php"; ?>




<script>
    
$(document).ready(function() {
    $('#salesreporttable').DataTable({   

    });
});



</script>
<script>
//-------------AJAX FOR VIEW QUOTATION-----------------


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
                });

// -------------------- END ----------------------------------------

</script>


<script>
    //-------------AJAX FOR FOLLOW UP-----------------
$(document).on("click", ".btn-follow", function(){
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
                });

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
$(document).on("click", ".btn-detail", function(){
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
      










              
</script>





<?php include_once('footer.php'); ?>

