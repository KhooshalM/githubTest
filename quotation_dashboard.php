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
                <h3 class="box-title">Quotation  Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">

            <div class="row">
                 <div class="col-md-12">

                 
                 <table id="salesreporttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Risk</th>
                                <th>Make And Model</th>
                                <th>Product </th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        </tbody>
                        <?php 
                  $sql="SELECT 
                  a.mmc_id as cus_seq,a.mmc_firstname ||' '||a.mmc_surname As cus_name,b.mtb_seq as bus_seq,b.mtb_vehi_no,b.mtb_premium,
                  
                  b.mtb_class,b.mtb_product,
                  (SELECT prd_description FROM uw_m_products WHERE prd_code=b.mtb_product)product_desc,
                  c.mtq_quo_seq,
                   c.mtq_yom,
                   c.mtq_capacity,
                   c.mtq_fuel_type,
                   c.mtq_mileage,
                   c.mtq_chassis,
                   c.mtq_engine,
                   c.mtq_make_model,
                   (select rft_description from cm_r_reference_two where mtq_make_model=rft_code)AS makemodel,
                   c.mtq_ori_regist_date,
                   c.mtq_mts_regist_date,
                   c.mtq_period_form,
                   c.mtq_period_to,
                   c.mtq_no_days,
                   c.mtq_seat_cap,
                   c.mtq_med,
                   c.mtq_cri,
                   c.mtq_cond,
                   c.mtq_towing,
                   c.mtq_tot_prm,
                   c.mtq_quo_status,
                   c.mtq_uw_status,
                   c.created_date,
                   c.created_by,
                   c.modified_date,
                    c.modified_by
                  
                  
                  FROM me_m_customers a , me_t_risks b,me_t_quotation c
                    WHERE a.mmc_id=b. mtb_mmc_id
                    and b.mtb_seq=c.mtb_seq";
                    $stmt1=oci_parse($conn,$sql); 
                    oci_execute($stmt1);
                    while($row=oci_fetch_assoc($stmt1)){ 
                    $cus_name=$row['CUS_NAME'];
                    $vehi=$row['MTB_VEHI_NO'];
                    $makemodel=$row['MAKEMODEL']; 
                    $product_code=$row['MTB_PRODUCT']; 
                    $productdesc=$row['PRODUCT_DESC']; 
  ?>  
               
                        <tr> 
                            <td>
                                <?php echo $cus_name; ?>
                            </td>
                            <td>
                                <?php echo $vehi; ?>
                            </td>
                             <td>
                                 <?php echo $makemodel; ?>
                             </td>
                             <td>
                                 <?php echo $productdesc; ?>
                             </td>
                               
                            </td>
                            
                     <?php } ?> 
                    
                        </tr>
    
                    </table>

                   
                
                 </div>
        </div>

    </section>
    <!-- /.content -->

</div>












<?php include_once('footer.php'); ?>
<script>
    
$(document).ready(function() {
    $('#salesreporttable').DataTable({
        "order": [],
    });
});



</script>
