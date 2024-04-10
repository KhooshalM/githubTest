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
            Debtors Age Analysis
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Debtors</a></li>
            <li class="active">Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Statistics</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <?php

            $me=$_SESSION['me_code'];
            $brn=$_SESSION['me_brn'];
                $squery="select 
                
                sum(case when round(sysdate-x_ref_date)<=60 then amt else 0 end) as days_60,
                sum(case when round(sysdate-x_ref_date)between 61 and 90 then amt else 0 end) as days_90,
                sum(case when round(sysdate-x_ref_date)between 91 and 180 then amt else 0 end) as days_180,
                sum(case when round(sysdate-x_ref_date)>180 then amt else 0 end) as days_360
                --x_ref_date,det_policy_no,piml_premium.veh_num(det_policy_no)Risk_Name,det_ref_c,det_descrip,damt,camt,a,round(sysdate-x_ref_date)days
                
                from(
                SELECT   sfc_brn_code, det_debt_code, sfc_name, deb_me_code, deb_brn_code, det_ref_c,
                         det_descrip, deb_name, det_ref_date, det_policy_no,
                         NVL (SUM (damt), 0) damt, NVL (SUM (camt), 0) camt,
                         MAX (ref_date) x_ref_date,   NVL (SUM (damt), 0)
                                                    - NVL (SUM (camt), 0) amt
                    FROM (
                
                SELECT  SFC_BRN_CODE,A.det_debt_code, 
                         sfc_first_name||sfc_surname as SFC_NAME,      
                                      a.det_rp_code  deb_me_code, 
                       a.det_branch_code deb_brn_code, a.det_ref_2, a.det_ref_c,
                        a.det_descrip,
                       deb_name_1 deb_name,
                
                       TO_DATE( A.DET_CONTRA_ACCT, 'dd-MON-RRRR')  det_ref_date, a.det_policy_no,
                
                        CASE
                                             WHEN x.det_dc_code = 'D'
                                             AND TO_DATE( X.DET_REF_DATE, 'dd-MON-RRRR') <=
                                                        TO_DATE (sysdate, 'dd-MON-RRRR')
                                                -- AND X.det_txntype = '1'
                                          THEN NVL (x.det_hc_amt, 0)
                                          END damt,
                                          CASE
                                             WHEN x.det_dc_code = 'C'
                                             AND TO_DATE( X.DET_REF_DATE, 'dd-MON-RRRR') <=
                                                         TO_DATE (sysdate, 'dd-MON-RRRR')
                                                THEN NVL (x.det_hc_amt, 0)
                                          END camt,
                                 a.det_ref_date ref_date
                            FROM ac_t_debtor a, ac_t_debtor x
                           ,ac_m_debtor,
                           sm_m_sales_force
                
                where a.det_branch_code='$brn'
                and a.det_rp_code='$me'
                and  a.det_ref_c IS NOT NULL
                             AND a.det_txntype = '1'
                             AND x.det_ref_c = a.det_ref_c
                                      AND x.det_debt_code = a.det_debt_code
                                      AND x.det_branch_code = a.det_branch_code
                             AND sfc_code=a.det_rp_code
                             AND a.det_branch_code=deb_branch_code 
                           AND a.det_debt_code  =deb_debtor_code 
                
                
                
                
                           )
                HAVING NVL (SUM (damt), 0) - NVL (SUM (camt), 0) <> 0
                GROUP BY sfc_brn_code,
                det_debt_code, 
                         sfc_name,
                         deb_me_code,
                         deb_brn_code,
                         det_ref_c,
                         det_descrip,
                         deb_name,
                         det_ref_date,
                         det_policy_no  
                         )    
                ORDER BY x_ref_date";
                $result=oci_parse($conn,$squery);
                oci_execute($result);
                while($res_values=oci_fetch_assoc($result))
                {
                    $days_60=$res_values['DAYS_60'];
                    $days_90=$res_values['DAYS_90'];
                    $days_180=$res_values['DAYS_180'];
                    $days_360=$res_values['DAYS_360'];
                }
            ?>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">0 - 60 Days</span>
                                <span class="info-box-number">
                                    <h2><?php echo "Rs. ". number_format($days_60,2); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->


                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">61 - 90 Days</span>
                                <span class="info-box-number">
                                    <h2><?php echo "Rs. ". number_format($days_90,2); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">91 - 180 Days</span>
                                <span class="info-box-number">
                                    <h2><?php echo "Rs. ". number_format($days_180,2); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">181 - 360 Days</span>
                                <span class="info-box-number">
                                    <h2><?php echo "Rs. ". number_format($days_360,2); ?></h2>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <br>


                    <table id="salesreporttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tran. Date</th>
                                <th>Policy No</th>
                                <th>Risk Name</th>
                                
                                <th>Debit Note</th>
                                <th>Contact</th>
                                <th>Client</th>
                                <th>Debit Amount</th>
                                <th>Paid</th>
                                <th>Outstanding</th>
                                <th>Debit Lapsed</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //$select =$pdo->prepare("select * from tbl_invoice where order_date between :from and :to ");
                            $select="
                            select 
                            
                            
                            x_ref_date,det_policy_no,piml_premium.veh_num(det_policy_no)Risk_Name,det_ref_c,det_descrip,damt,camt,amt,round(sysdate-x_ref_date)days,(SELECT  pk_uw_m_customers.fn_get_cust_phone(max(pol_cus_code))
                            FROM uw_t_policies a
                            where pol_policy_no=det_policy_no)contact
                            
                            from(
                            SELECT   sfc_brn_code, det_debt_code, sfc_name, deb_me_code, deb_brn_code, det_ref_c,
                                     det_descrip, deb_name, det_ref_date, det_policy_no,
                                     NVL (SUM (damt), 0) damt, NVL (SUM (camt), 0) camt,
                                     MAX (ref_date) x_ref_date,   NVL (SUM (damt), 0)
                                                                - NVL (SUM (camt), 0) amt
                                FROM (
                            
                            SELECT  SFC_BRN_CODE,A.det_debt_code, 
                                     sfc_first_name||sfc_surname as SFC_NAME,      
                                                  a.det_rp_code  deb_me_code, 
                                   a.det_branch_code deb_brn_code, a.det_ref_2, a.det_ref_c,
                                    a.det_descrip,
                                   deb_name_1 deb_name,
                            
                                   TO_DATE( A.DET_CONTRA_ACCT, 'dd-MON-RRRR')  det_ref_date, a.det_policy_no,
                            
                                    CASE
                                                         WHEN x.det_dc_code = 'D'
                                                         AND TO_DATE( X.DET_REF_DATE, 'dd-MON-RRRR') <=
                                                                    TO_DATE (sysdate, 'dd-MON-RRRR')
                                                            -- AND X.det_txntype = '1'
                                                      THEN NVL (x.det_hc_amt, 0)
                                                      END damt,
                                                      CASE
                                                         WHEN x.det_dc_code = 'C'
                                                         AND TO_DATE( X.DET_REF_DATE, 'dd-MON-RRRR') <=
                                                                     TO_DATE (sysdate, 'dd-MON-RRRR')
                                                            THEN NVL (x.det_hc_amt, 0)
                                                      END camt,
                                             a.det_ref_date ref_date
                                        FROM ac_t_debtor a, ac_t_debtor x
                                       ,ac_m_debtor,
                                       sm_m_sales_force
                            
                                       where a.det_branch_code='$brn'
                                       and a.det_rp_code='$me'
                            and  a.det_ref_c IS NOT NULL
                                         AND a.det_txntype = '1'
                                         AND x.det_ref_c = a.det_ref_c
                                                  AND x.det_debt_code = a.det_debt_code
                                                  AND x.det_branch_code = a.det_branch_code
                                         AND sfc_code=a.det_rp_code
                                         AND a.det_branch_code=deb_branch_code 
                                       AND a.det_debt_code  =deb_debtor_code 
                            
                            
                            
                            
                                       )
                            HAVING NVL (SUM (damt), 0) - NVL (SUM (camt), 0) <> 0
                            GROUP BY sfc_brn_code,
                            det_debt_code, 
                                     sfc_name,
                                     deb_me_code,
                                     deb_brn_code,
                                     det_ref_c,
                                     det_descrip,
                                     deb_name,
                                     det_ref_date,
                                     det_policy_no  
                                     )    
                            ORDER BY x_ref_date";

                            $result_det=oci_parse($conn,$select);
                oci_execute($result_det);
                           while($row=oci_fetch_assoc($result_det))
                            //while($row=$select->fetch(PDO::FETCH_OBJ))
                            {
                                echo'
                                <tr>
                                <td>'.$row['X_REF_DATE'].'</td>
                                <td>'.$row['DET_POLICY_NO'].'</td>
                                <td>'.$row['RISK_NAME'].'</td>
                                
                                <td>'.$row['DET_REF_C'].'</td>
                                <td>'.$row['CONTACT'].'</td>
                                <td>'.$row['DET_DESCRIP'].'</td>
                                <td><span class="btn btn-primary btn-flat">'."Rs.".number_format($row['DAMT'],2).'</span></td>
                                <td><span class="btn btn-success btn-flat">'."Rs.".number_format($row['CAMT'],2).'</span></td>
                                <td><span class="btn btn-warning btn-flat">'."Rs.".number_format($row['AMT'],2).'</span></td>
                                
                              
                               
                                
                                
                                
                                ';
                                if($row['DAYS']<=90)
                                {
                                    echo '<td><span class="btn btn-default btn-round">'.$row['DAYS'].'</span></td>';
                                }
                                
                                else
                                {
                                    echo '<td><span class="btn btn-danger btn-round">'.$row['DAYS'].'</span></td>';
                                }
                                   

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
    $('#salesreporttable').DataTable({
        "order": [
            [9, "desc"]
        ]
    });
});
</script>

<?php include_once('footer.php'); ?>