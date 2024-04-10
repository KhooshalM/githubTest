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
            Renewal List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Sales Report</a></li>
            <li class="active">Renewal List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">From : <?php echo $_POST['date_1'] ?> -- To: <?php echo $_POST['date_2'] ?> </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">

                <div class="row">
                    <form action="" method="post">
                        <div class="col-md-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker1" name="date_1"
                                    data-date-format="yyyy-mm-dd">
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker2" name="date_2"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div align="left">
                                <input type="submit" name="btndatefilter" value="Filter By Date"
                                    class="btn btn-success">
                            </div>
                        </div>
                </div>

                <br><br>
                <?php

                $p_date_from=  $_POST['date_1'];  
                $p_date_to=  $_POST['date_2'];     
                $me=$_SESSION['me_code'];


                $select = " SELECT  COUNT(pol_policy_no) AS no_pol
                    ,SUM(pol_premium)     AS prem
                FROM
                (
                    SELECT  pol_slc_brn_code
                        ,pol_prd_code
                        ,(
                    SELECT  prd_description
                    FROM uw_m_products C
                    WHERE C.prd_code = pol_prd_code)DES, pol_policy_no, piml_premium.VEH_MAKE(pol_policy_no)MAKE, piml_premium.VEH_MODEL(pol_policy_no)MODEL, piml_premium.A_LEVEL(pol_policy_no)V_LEVEL, piml_premium.CAPACITY(pol_policy_no)CAP, piml_premium.YOM(pol_policy_no)YOM , risk, p_from, p_to, cust_name, cust_addr, tel, POL_PREMIUM, pol_marketing_executive_code, (
                    SELECT  sfc_first_name||' '||sfc_surname
                    FROM sm_m_sales_force a
                    WHERE sfc_code = pol_marketing_executive_code)me
                    FROM
                    (
                        SELECT  (
                        SELECT  MAX(R.prs_name)
                        FROM uw_t_pol_risks R
                        WHERE R.prs_plc_pol_seq_no = POL_SEQ_NO)RISK, a.pol_seq_no, a.pol_slc_brn_code, a.pol_cla_code, A.POL_PREMIUM, POL_TRANSACTION_TYPE, a.pol_prd_code, a.pol_policy_no, TO_CHAR(a.pol_period_from, 'DD-Mon-RRRR')P_FROM, TO_CHAR(a.pol_period_to, 'DD-Mon-RRRR')P_TO, pk_uw_m_customers.fn_get_cust_name (a.pol_cus_code) cust_name, pk_uw_m_customers.fn_get_cust_phone(a.pol_cus_code)tel, (
                        SELECT  MAX (b.adr_loc_description)
                        FROM uw_m_cust_addresses b
                        WHERE b.adr_cus_code = a.pol_cus_code ) cust_addr, a.pol_marketing_executive_code, a.pol_cus_code
                        FROM uw_t_policies a
                        WHERE a.pol_slc_brn_code != 'AG00'
                        AND pol_marketing_executive_code = '$me'
                        AND a.pol_status IN ('4', '5', '6')
                        AND a.pol_cla_code in('MC', 'M3')
                        AND not (a.pol_sum_insured = 0 AND a.pol_cla_code = 'MC')
                        AND TO_CHAR (a.pol_period_to, 'RRRR-MM-DD')BETWEEN '$p_date_from' AND '$p_date_to'
                    )
                    )";
                
                
                $result=oci_parse($conn,$select);
                                oci_execute($result);
                while($res_values=oci_fetch_assoc($result))
                {
                   $no_pol=$res_values['NO_POL'];
                   $tot_prem=$res_values['PREM'];
                }
?>


                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">No of Policies</span>
                                <span class="info-box-number">
                                    <h2><?php echo number_format($no_pol); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->


                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>


                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Premium</span>
                                <span class="info-box-number">
                                    <h2><?php echo "Rs. ". number_format($tot_prem,2); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>




        
              
                <div class="box-body">
             
           
             <div class="col-md-12">
     
             <table id="salesreporttable" class="table table-striped">
                    <thead>
                        <th>Policy No</th>
                        <th>Product</th>
                       
                        <th>Risk</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>CC</th>
                        <th>Year</th>
                        <th>Level</th>
                        <th>Period From</th>
                        <th>Period To</th>
                        <th>Client</th>
                        <th>Address</th>
                        <th>Contact No</th>
                     
                        <th>Confirm</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $select_det = " SELECT  pol_policy_no
                        ,pol_prd_code
                        ,des
                        ,risk
                        ,make
                        ,model
                        ,cap
                        ,yom
                        ,v_level
                        ,p_from
                        ,p_to
                        ,cust_name
                        ,cust_addr
                        ,tel
                        ,pol_premium
                        FROM
                        (
                        SELECT  pol_slc_brn_code
                            ,pol_prd_code
                            ,(
                        SELECT  prd_description
                        FROM uw_m_products C
                        WHERE C.prd_code = pol_prd_code)DES, pol_policy_no, piml_premium.VEH_MAKE(pol_policy_no)MAKE, piml_premium.VEH_MODEL(pol_policy_no)MODEL, piml_premium.A_LEVEL(pol_policy_no)V_LEVEL, piml_premium.CAPACITY(pol_policy_no)CAP, piml_premium.YOM(pol_policy_no)YOM , risk, p_from, p_to, cust_name, cust_addr, tel, POL_PREMIUM, pol_marketing_executive_code, (
                        SELECT  sfc_first_name||' '||sfc_surname
                        FROM sm_m_sales_force a
                        WHERE sfc_code = pol_marketing_executive_code)me
                        FROM
                        (
                            SELECT  (
                            SELECT  MAX(R.prs_name)
                            FROM uw_t_pol_risks R
                            WHERE R.prs_plc_pol_seq_no = POL_SEQ_NO)RISK, a.pol_seq_no, a.pol_slc_brn_code, a.pol_cla_code, A.POL_PREMIUM, POL_TRANSACTION_TYPE, a.pol_prd_code, a.pol_policy_no, TO_CHAR(a.pol_period_from, 'DD-Mon-RRRR')P_FROM, TO_CHAR(a.pol_period_to, 'DD-Mon-RRRR')P_TO, pk_uw_m_customers.fn_get_cust_name (a.pol_cus_code) cust_name, pk_uw_m_customers.fn_get_cust_phone(a.pol_cus_code)tel, (
                            SELECT  MAX (b.adr_loc_description)
                            FROM uw_m_cust_addresses b
                            WHERE b.adr_cus_code = a.pol_cus_code ) cust_addr, a.pol_marketing_executive_code, a.pol_cus_code
                            FROM uw_t_policies a
                            WHERE a.pol_slc_brn_code != 'AG00'
                            AND pol_marketing_executive_code = '$me'
                            AND a.pol_status IN ('4', '5', '6')
                            AND a.pol_cla_code in('MC', 'M3')
                            AND not (a.pol_sum_insured = 0 AND a.pol_cla_code = 'MC')
                            AND TO_CHAR (a.pol_period_to, 'RRRR-MM-DD')BETWEEN '$p_date_from' AND '$p_date_to'
                        )
                        ORDER BY p_to)";


                        $result_det=oci_parse($conn,$select_det);
                        oci_execute($result_det);
                                while($row1=oci_fetch_assoc($result_det))
                        {       
                        $pol_no=$row1['POL_POLICY_NO'];
                        $pol_prd_code=$row1['POL_PRD_CODE'];
                        $desc=$row1['DES'];
                        $risks=$row1['RISK'];
                        $make=$row1['MAKE'];
                        $model=$row1['MODEL'];
                        $yom=$row1['YOM'];
                        $v_level=$row1['V_LEVEL'];
                        $cap=$row1['CAP'];
                        $p_from=$row1['P_FROM'];
                        $p_to=$row1['P_TO'];
                        $cust_name=$row1['CUST_NAME'];
                        $cust_addr=$row1['CUST_ADDR'];
                        $tel=$row1['TEL'];
                        $me=$row1['ME'];
                        $pol_marketing_executive_code=$row1['POL_MARKETING_EXECUTIVE_CODE'];
                        $premium=number_format($row1['POL_PREMIUM'],2);

                        ?>
                            
                           
                            
                            <tr>
                                
                            <td><?php echo $pol_no;  ?> </td>
                            <td><?php  echo $pol_prd_code; ?> </td>
                            
                            <td><?php echo $risks; ?></td>
                            <td><?php echo $make;  ?></td>
                            <td><?php echo $model; ?></td>
                            <td><?php echo $cap;   ?> </td>
                            <td><?php echo $yom;   ?></td>
                            <td><?php echo $v_level; ?></td>
                            <td><?php echo $p_from; ?></td>
                            <td><?php echo $p_to; ?></td>
                            <td><?php echo $cust_name; ?></td>
                            <td><?php echo $cust_addr; ?></td>
                            <td><?php  echo $tel;?></td>
                            
                            <?php
                    
                                $sqlchk="select 
                                mf_fn_seq,
                                mf_pol_no,
                                mf_contact_id,
                                mf_status,
                                created_date,
                                created_by,
                                modified_date,
                                modified_by,
                                mf_pol_seq 
                                from me_r_finalise
                                where mf_pol_no='$pol_no'";
                                $polresult=oci_parse($conn,$sqlchk);
                                oci_execute($polresult);
                                $row2=oci_fetch_assoc($polresult);      
            
                                $mfpolno=$row2['MF_POL_NO'];
                                $mfseq=$row2['MF_POL_SEQ'];
                                
                        
                                /*$sqlchk="select
                                mtb_seq,
                                mtb_mmc_id,
                                mtb_vehi_no,
                                mtb_class,
                                mtb_product,
                                me_code,
                                created_by,
                                modified_by,
                                created_date,
                                modified_date,
                                mtb_status,
                                mtb_bus_status
                                from me_t_risks
                                where mtb_vehi_no='$risks'";

                                $result=oci_parse($conn,$sqlchk);
                                oci_execute($result);
                                $row2=oci_fetch_assoc( $result );
                                $mtbrisk=$row2['MTB_VEHI_NO'];
                                $mtbseq=$row2['MTB_SEQ'];*/
                                ?>

                                
                                <td>
                                <?php if($mfpolno == ""){
                                    echo "<button type='button'  data-id='$pol_no'  class='btn-create btn bg-primary margin btn-sm'>Renew</i></button>";
                                    
                                    
                                  
                                   
                                }
                                else{ 
                                    echo " <button type='button'  data-id='$pol_no'   class='btn-assign btn bg-orange margin btn-sm'>Assign</button>";
                                }
                                
                                ?>
                                
                                
                                </td>
                            
                                <!--
                            <td><button type="button"  data-id="<?php echo $pol_no;?>" data-name="<?php echo $cust_name; ?>"class="btn-create btn bg-primary margin btn-sm">Create Customer</button></td>
                             </tr>-->
                            <?php  
                            } 
                        
                            //}
                            ?>

                          </tr>
                            
                          
                      


                        </tbody>
                </table>
               
                <input type="hidden" id="phoneno" value="<?php echo $tel ?>">

               
            
             </div>
    </div>
               
            </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>

<?php include "create_cus.php"; ?>
<?php //include "renewal.php"; ?>

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



$(document).on("click", ".btn-create", function(){
            var polno = $(this).data('id');
            //var custname = $(this).data('name');
            
            //alert(polno);
                       
           
                        $.ajax({
                        url: 'create_cus_ajax.php',
                        type: 'post',
                        data: {
                          
                            polno: polno, 
                      
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-cus').html(response); 
                        $('#modal-primary-cus').modal('show'); 
                        }
                  
                      });
                      
                });





/*$(document).on("click", ".btn-assign", function(){
            var polno = $(this).data('id');
            var custname = $('#custname').val();
            //alert(polno);
                       
           
                        $.ajax({
                        url: 'create_cus_ajax.php',
                        type: 'post',
                        data: {
                          
                            polno: polno, 
                            custname:custname
                        
                        
                        },
                                          
                        success: function(response){ 
                        $('.modal-body-cus').html(response); 
                        $('#modal-primary-cus').modal('show'); 
                        }
                  
                      });
                      
                });
*/

</script>






<?php include_once('footer.php'); ?>