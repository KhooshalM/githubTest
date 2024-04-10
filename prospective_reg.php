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
             
            <div class="row">
                 <div class="col-md-12">
         
                 <table id="salesreporttable" class="table table-striped">
                        <thead>
                                <th>Follow Up Date</th>
                                <th>Customer Name</th>
                                <th>Mobile No</th>
                                
                                <th>Risk</th>
                               
                              
                              <!--  <th>Leasing Company</th>-->
                                
                              
                                <th>Prospective</th>
                                <th>Customer Details</th>
                                <th>Business Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $today_date=date("d/m/Y");
                           // echo $today_date;
                            $me_code=$_SESSION['me_code'];
                            

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
                            --AND mtb_follow_up_date !=to_char(sysdate)
                            AND me_code='$me_code'
                            AND mtb_status='A'
                            AND mtb_type_of_prospective='PROSPECTIVE'
                            order by created_date desc";
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

                       
                            ?>
                                


                                <tr>
                                <td> <?php echo $follow_up_date ?></td>
                                <td><b><?php echo $customername ?> </b></td>
                                <td><?php echo $mobno ?> </td>
                                <td><?php echo $risk ?> </td>
                                
                            
                                
                               
                                <td> <button class="btn btn-<?php if($type_of_prospective=="PROSPECTIVE") { echo "success";} else { echo"danger"; } ?> btn-xs"><?php echo $type_of_prospective ?></button></td>
                                <td> <button class="btn-id btn btn-warning btn-xs" data-id="<?php echo $mmc_id; ?>">Customer Details</button></td>
                              
                                <td> <button type="button" data-id="<?php echo $seq; ?>" data-cus="<?php echo $mmc_id; ?>" class="btn-view btn bg-primary margin btn-xs">Business Details</button></td>
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
<?php include "update_business.php"; ?>






<script>
$(document).ready(function() {
    $('#salesreporttable').DataTable({
       
    });
});



</script>

<script>
$(document).on("click", ".btn-view", function(){
            var business_id = $(this).data('id');
            var cus_id=$(this).data('cus');
            //alert(cus_id);
                       
                        $.ajax({
                        url: 'update_business_modal.php',
                        type: 'post',
                        data: {
                            business_id: business_id,
                            cus_id:cus_id
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body').html(response); 
                        $('#modal-default').modal('show'); 
                        }
                  
                      });
                });




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
                        $('.modal-body').html(response); 
                        $('#modal-default').modal('show'); 
                        }
                  
                      });
                });

// -------------------- END ----------------------------------------






              
</script>





<?php include_once('footer.php'); ?>

