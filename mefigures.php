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
            Marketing Figures
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Sales Report</a></li>
            <li class="active">Marketing Figures</li>
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

$p_date_from= date("d-M-Y", strtotime($_POST['date_1'])) ;  
$p_date_to= date("d-M-Y", strtotime($_POST['date_2'])) ;   
$me=$_SESSION['me_code'];
$brn=$_SESSION['me_brn'];

$sql="BEGIN 
        PK_AMILA.PU_BRANCH_MK_IND('$p_date_from','$p_date_to','$brn','$me');
        END;";
 $stmt= oci_parse($conn, $sql);
 oci_execute($stmt);




  $select = "select 
  sum(case when pol_type='NEW_BUSINESS' then AMOUNT else 0 end)new_business,
  sum(case when pol_type='RENEWALS' then AMOUNT else 0 end)renewal,
  sum(case when pol_type='ADDITIONALS' then AMOUNT else 0 end)endorse,
  sum(case when pol_type='REFUNDS' then AMOUNT else 0 end)cancels,
  sum(pol_fee) fee,
  sum(amount) amt
  
  from
  
  (
  SELECT L.slc_brn_desc,A.pol_me_code || '-' || S.sfc_first_name || ' '  || S.sfc_surname ME_NAME,X.ptp_description,
  case when  pol_type='N'   then  'NEW_BUSINESS'
  when pol_type='R'   then  'RENEWALS'
  when pol_type='A'   then  'ADDITIONALS'
  when pol_type='F'   then  'REFUNDS'  END  pol_type,
  C.cla_description,P.prd_description,T.name,
  A.pol_policy_no,A.pol_period_from,
  --A.pol_period_to, 
  CASE WHEN A.pol_prd_code = 'CT' THEN   (SELECT DISTINCT B.pci_date_value
                                          FROM uw_T_pol_common_information B
                                          WHERE B.pci_description = 'ACTIVE PERIOD TO'
                                          AND B.pci_pol_seq_no = (SELECT MAX(UW_T_POLICIES.pol_seq_no)
                                                                  FROM UW_T_POLICIES 
                                                                  WHERE UW_T_POLICIES.pol_policy_no = A.pol_policy_no)
                                                                  )
       ELSE A.pol_period_to END pol_period_to,
  A.pol_sum_insured,A.pol_ref_no,A.pol_marketing_date,
  CASE WHEN A.pol_type ='N' THEN A.pol_new_business 
  WHEN A.pol_type ='R' THEN A.POL_RENEWALS
  WHEN A.pol_type ='A' THEN A.pol_additionals 
  WHEN A.pol_type ='F' THEN A.POL_REFUNDS END AMOUNT,
         a.pol_trn_date,
  (select max(rk.prs_name) prs_name
  from uw_t_pol_risks rk
  where rk.prs_policy_no=A.pol_policy_no) prs_name,
  (select trim(cu.cus_phone_1)||' '||trim(cu.cus_phone_2)
  from uw_m_customers  cu where cu.cus_code=a.pol_cus_code) cus_phone,
  pol_fee
  FROM SM_X_ACC_MK A,SM_M_SALES_FORCE S,SM_M_SALESLOC L,UW_M_PRODUCTS P,UW_R_CLASSES C,UW_CUSTOMER T,UW_R_PRODUCT_TYPES X
  WHERE A.pol_me_code =S.SFC_CODE
  AND a.pol_slc_brn_code = l.slc_brn_code
  AND A.pol_prd_code =P.prd_code
  AND A.pol_cla_code=C.cla_code
  AND A.pol_cUS_code=T.cus_code
  AND P.prd_ptp_code=X.ptp_code
  --AND prd_ptp_code LIKE NVL(:P_TYPE,'%')
  order by a.pol_trn_date
  )";


 
                
                $result=oci_parse($conn,$select);
                                oci_execute($result);
                while($res_values=oci_fetch_assoc($result))
                {
                   $new=$res_values['NEW_BUSINESS'];
                   $ren=$res_values['RENEWAL'];
                   $end=$res_values['ENDORSE'];
                   $can=$res_values['CANCELS'];
                   $tot=$res_values['AMT'];

                
                }
            
?>

                <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Policies</span>
              <span class="info-box-number"><?php echo "Rs. ". number_format($new,2); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
                    <!-- /.col -->


                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>


                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Renewal Policies</span>
              <span class="info-box-number"><?php echo "Rs. ". number_format($ren,2); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Endorsements</span>
              <span class="info-box-number"><?php echo "Rs. ". number_format($end,2); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-grey"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancellation</span>
              <span class="info-box-number"><?php echo "Rs. ". number_format($can,2); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Premium Ach.</span>
              <span class="info-box-number"><?php echo "Rs. ". number_format($tot,2); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                   Period From : <?php echo $_POST['date_1'] ?> To :<?php echo $_POST['date_1'] ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
                </div>




                <br>


                <table id="salesreporttable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Trn. Date</th>
                            <th>Policy No</th>
                            <th>Class</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Risk/Vehicle</th>
                            <th>Sum Insured</th>
                            <th>Client</th>
                            <th>Period From</th>
                            <th>Period To</th>
                            <th>Premium</th>
                            <th>Pol. Fee</th>
                            <th>Total Premium</th>




                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                                 
                                                 $select_det = "select 
                                                 pol_trn_date,pol_policy_no,cla_description,ptp_description,prd_description,pol_type,prs_name,pol_sum_insured,name,pol_period_from,pol_period_to,amount,pol_fee
                                                 
                                                 from
                                                 
                                                 (
                                                 SELECT L.slc_brn_desc,A.pol_me_code || '-' || S.sfc_first_name || ' '  || S.sfc_surname ME_NAME,X.ptp_description,
                                                 case when  pol_type='N'   then  'NEW_BUSINESS'
                                                 when pol_type='R'   then  'RENEWALS'
                                                 when pol_type='A'   then  'ADDITIONALS'
                                                 when pol_type='F'   then  'REFUNDS'  END  pol_type,
                                                 C.cla_description,P.prd_description,T.name,
                                                 A.pol_policy_no,A.pol_period_from,
                                                 --A.pol_period_to, 
                                                 CASE WHEN A.pol_prd_code = 'CT' THEN   (SELECT DISTINCT B.pci_date_value
                                                                                         FROM uw_T_pol_common_information B
                                                                                         WHERE B.pci_description = 'ACTIVE PERIOD TO'
                                                                                         AND B.pci_pol_seq_no = (SELECT MAX(UW_T_POLICIES.pol_seq_no)
                                                                                                                 FROM UW_T_POLICIES 
                                                                                                                 WHERE UW_T_POLICIES.pol_policy_no = A.pol_policy_no)
                                                                                                                 )
                                                      ELSE A.pol_period_to END pol_period_to,
                                                 A.pol_sum_insured,A.pol_ref_no,A.pol_marketing_date,
                                                 CASE WHEN A.pol_type ='N' THEN A.pol_new_business 
                                                 WHEN A.pol_type ='R' THEN A.POL_RENEWALS
                                                 WHEN A.pol_type ='A' THEN A.pol_additionals 
                                                 WHEN A.pol_type ='F' THEN A.POL_REFUNDS END AMOUNT,
                                                        a.pol_trn_date,
                                                 (select max(rk.prs_name) prs_name
                                                 from uw_t_pol_risks rk
                                                 where rk.prs_policy_no=A.pol_policy_no) prs_name,
                                                 (select trim(cu.cus_phone_1)||' '||trim(cu.cus_phone_2)
                                                 from uw_m_customers  cu where cu.cus_code=a.pol_cus_code) cus_phone,
                                                 pol_fee
                                                 FROM SM_X_ACC_MK A,SM_M_SALES_FORCE S,SM_M_SALESLOC L,UW_M_PRODUCTS P,UW_R_CLASSES C,UW_CUSTOMER T,UW_R_PRODUCT_TYPES X
                                                 WHERE A.pol_me_code =S.SFC_CODE
                                                 AND a.pol_slc_brn_code = l.slc_brn_code
                                                 AND A.pol_prd_code =P.prd_code
                                                 AND A.pol_cla_code=C.cla_code
                                                 AND A.pol_cUS_code=T.cus_code
                                                 AND P.prd_ptp_code=X.ptp_code
                                                 
                                                 order by a.pol_trn_date
                                                 )";
                             $result_det=oci_parse($conn,$select_det);
                             oci_execute($result_det);
                                        while($row1=oci_fetch_assoc($result_det))
                            {
                                echo'
                                <tr>
                                <td>'.$row1['POL_TRN_DATE'].'</td>
                                <td>'.$row1['POL_POLICY_NO'].'</td>
                                <td>'.$row1['CLA_DESCRIPTION'].'</td>
                                <td>'.$row1['PRD_DESCRIPTION'].'</td>
                                <td>'.$row1['POL_TYPE'].'</td>

                            
                                <td><b>'.$row1['PRS_NAME'].'</b></td>
                                <td>'."Rs. ". number_format($row1['POL_SUM_INSURED'],0).'</td>
                                <td>'.$row1['NAME'].'</td>
                                <td>'.$row1['POL_PERIOD_FROM'].'</td>
                                <td>'.$row1['POL_PERIOD_TO'].'</td>
                                <td>'."Rs. ".'<b>'. number_format($row1['AMOUNT'],2).'</b>'.'</td>
                                <td>'.$row1['POL_FEE'].'</td>
                                <td>'."Rs. ".'<b>'. number_format($row1['POL_FEE']+$row1['AMOUNT'],2).'</b>'.'</td>

                                
                                
                               
                                
                                
                                
                                ';
                               
                                   

                            }
                            echo '</tr>';
                        ?>


                    </tbody>
                </table>

            </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
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
</script>

<?php include_once('footer.php'); ?>