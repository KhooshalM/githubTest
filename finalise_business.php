<?php 
include_once('connectdb.php');
session_start();
$m_brn=$_SESSION['me_brn'];
$me_code=$_SESSION['me_code'];
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
                <h3 class="box-title">Finalise Business</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            
            <div class="box-body">
             
           
                 <div class="col-md-12">
         
                 <table id="salesreporttable" class="table table-striped">
                        <thead>
                                <tr>
                              
                                <th>Customer Name</th>
                                <th>Mobile No</th>
                                
                                <th>Risk</th>
                               
                              
                              <!--  <th>Leasing Company</th>-->
                                
                                <th>Product</th>
                                <th>Policy Period</th>
                                <th>No Days</th>
                                <th>Sum insured</th>
                                <th>Premium</th>
                               <th>Policy No</th>
                              
                              
                               
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $today_date=date("d/m/Y");
                           // echo $today_date;
                            $me_code=$_SESSION['me_code'];
                            

                            $sql="SELECT  a.mtq_quo_seq,

                            a.mtb_seq,
                            b.mtb_vehi_no,b.mtb_class,b.mtb_product,b.me_code,mtb_status,
                            c.mmc_firstname ||' '|| c.mmc_surname AS CUSNAME,c.mmc_phoneno,c.mmc_mobileno,
                            c.mmc_address1,c.mmc_address2,c.mmc_address3,c.mmc_city,c.mmc_title,c.mmc_nicno,
                            a.mmc_id, a.mtq_sum_ins, a.mtq_yom,
                            
                            a.mtq_capacity, a.mtq_fuel_type, a.mtq_mileage, a.mtq_chassis,
                            a.mtq_engine, a.mtq_make_model,
                            (SELECT rft_description from cm_r_reference_two where rft_code=mtq_make_model)AS MAKEMODEL,
                            (SELECT prd_description FROM uw_m_products e where b.mtb_product=prd_code)PRODUCT_DESC,
                         
                            
                            
                            a.mtq_ori_regist_date,
                            a.mtq_mts_regist_date, a.mtq_period_form, a.mtq_period_to,
                            a.mtq_no_days, a.mtq_seat_cap, a.mtq_med, a.mtq_cri, a.mtq_cond,
                            a.mtq_towing, a.mtq_tot_prm, a.mtq_quo_status, a.mtq_uw_status,
                            a.created_date, a.created_by, a.modified_date, a.modified_by,
                            a.mtq_kw,
                            
                            
                            d.sfc_first_name ||' '||d.sfc_surname AS ME_NAME,d.sfc_email1,d.sfc_email2 ,d.sfc_mobile1,d.sfc_mobile2,
                            sfc_brn_code,(SELECT sty_type_desc from sm_r_sales_type WHERE sty_type_code=sfc_type)DESIG
                            
                            
                            
                            FROM me_t_quotation a,me_t_risks b,me_m_customers c,sm_m_sales_force d
                            where a.mtb_seq=b.mtb_seq
                            and a.mmc_id=c.mmc_id
                            and b.me_code=d.sfc_code
                            AND b.me_code='$me_code'
                            and mtb_status='F'";
                            
                             $result=oci_parse($conn,$sql);
                             oci_execute($result);
                             while($row=oci_fetch_assoc($result))
                             

                             {
                                
                                $quo_id=$row['MTQ_QUO_SEQ'];
                                $bus_id=$row['MTB_SEQ'];
                                $cus_id=$row['MMC_ID'];
                                $custname=$row['CUSNAME'];
                                $phoneno=$row['MMC_PHONENO'];
                                $mobno=$row['MMC_MOBILENO'];
                                $vehino=$row['MTB_VEHI_NO'];
                                $class=$row['MTB_CLASS'];
                                //echo $class;
                                //echo "<br>";

                                $prod_code=$row['MTB_PRODUCT'];
                                $product_desc=$row['PRODUCT_DESC'];

                                $suminsured=$row['MTQ_SUM_INS'];



                                $yearofmake=$row['MTQ_YOM'];


                                $capacity=$row['MTQ_CAPACITY'];



                                $fuel_type=$row['MTQ_FUEL_TYPE'];



                                $chassis=$row['MTQ_CHASSIS'];

                                $mileage=$row['MTQ_MILEAGE'];

                                $engineno=$row['MTQ_ENGINE'];
                                $model_code=$row['MTQ_MAKE_MODEL'];


                                $modeldesc=$row['MAKEMODEL'];


                                $original_regist=$row['MTQ_ORI_REGIST_DATE'];



                                $mts_regist_date=$row['MTQ_MTS_REGIST_DATE'];

                                $start_date=$row['MTQ_PERIOD_FORM'];



                                $end_date=$row['MTQ_PERIOD_TO'];



                                $no_days=$row['MTQ_NO_DAYS'];

                                $seating_capacity=$row['MTQ_SEAT_CAP'];

                                //echo $seating_capacity;


                                $medical=$row['MTQ_MED'];




                                $criticall=$row['MTQ_CRI'];


                                $condition=$row['MTQ_COND'];





                                if($condition=="N"){
                                    $condition_desc="NEW";
                                }


                                if($condition=="S"){
                                    $condition_desc="SECOND HAND";
                                }


                                $towing=$row['MTQ_TOWING'];
                                $total_prm=$row['MTQ_TOT_PRM'];
                                $mtq_quo_status=$row['MTQ_QUO_STATUS'];
                                $mtq_uw_status=$row['MTQ_UW_STATUS'];
                                $created_date=$row['CREATED_DATE'];
                                $created_by=$row['CREATED_BY'];
                                $modified_date=$row['MODIFIED_DATE'];
                                $modified_by=$row['MODIFIED_BY'];
                                $kilowat=$row['MTQ_KW'];

                                                            

                       
                            ?>
                                
                               
                                
                                <tr>
                                    
                               
                                <td><b><?php echo $custname ?> </b></td>
                                <td><?php echo $mobno ?> </td>
                                <td><?php echo $vehino ?> </td>
                                <td><?php echo $product_desc .' - '. $prod_code ?> </td>
                                <td><?php echo $start_date .'  TO '. $end_date ?> </td>
                                <td><?php echo $no_days ?> </td>
                                <td><?php echo number_format($suminsured); ?> </td>
                                <td>Rs.<?php echo  number_format($total_prm); ?> </td>
                            
                            
                                        <?php
                                       $policy_check="SELECT b.pol_policy_no,b.pol_seq_no
                                        FROM uw_t_pol_risks a, uw_t_policies b
                                        where a.prs_plc_pol_seq_no=b.pol_seq_no
                                        and a.prs_name='$vehino'
                                        and b.pol_marketing_executive_code='$me_code'
                                        and b.pol_slc_brn_code='$m_brn'
                                        and b.pol_status not in ('9','1','2')
                                        and b.pol_cla_code='$class'
                                        and b.pol_prd_code='$prod_code'
                                        and b.pol_period_from>='$start_date'";
                                        $polresult=oci_parse($conn,$policy_check);
                                        oci_execute($polresult);
                                        $row=oci_fetch_assoc($polresult);
                                        
                                        
                                    ?>


                               

                               
                                
                                <td> 
                                    <?php
                                        $polno=$row['POL_POLICY_NO'];
                                        $pol_seq=$row['POL_SEQ_NO'];
                                        if($polno == ""){
                                        echo "Policy Not  Assigned Yet.";

                                        } 
                                        else {

                                            echo "<button type='button' data-pol='$polno' data-seq='$pol_seq' data-bus='$bus_id' data-cus='$cus_id' class='btn-detail btn bg-maroon margin btn-sm'>$polno</button>";
                                        }




                                    ?>
                                    
                                    
                               </td>
                            
                                        



                              </tr>
                               
                              
                            <?php  }  ?>


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

<!--  Modal   -->
<?php //include "update_business.php"; ?>
<?php //include "update_customer.php"; ?>
<?php //include "follow_up.php"; ?>

<?php //include "view_quotation.php"; ?>
<?php //include "quo_finalise.php"; ?>

<script>
    
$(document).ready(function() {
    $('#salesreporttable').DataTable({   

    });
});


$(document).on("click", ".btn-detail", function(){
            var polno = $(this).data('pol');
            var polseq = $(this).data('seq');
            var bus_id = $(this).data('bus');
            var cusid = $(this).data('cus');
            
            //alert(cus_id);
                       

            
                        $.ajax({
                        url: 'policy_detail_ajax.php',
                        type: 'post',
                        data: {
                          
                            polno: polno, 
                            polseq:polseq,
                            bus_id:bus_id,
                            cusid:cusid
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-pol').html(response); 
                        $('#modal-primary-pol').modal('show'); 
                        }
                  
                      });
                      
                });


</script>





<?php include_once('footer.php'); ?>

