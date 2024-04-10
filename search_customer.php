<style>
    #toggle1 {
        display: none;
    }
    #toggle {
        display: none;
    }
</style>
<?php
include("connection/connection.php");
session_start();
$me=$_SESSION['me_code'];
$pol=$_POST['pol'];


if (isset($_POST['query'])) {
    $search=strtoupper($_POST['query']);
    //echo $search;

    $sql="SELECT a.mmc_id,
    a.mmc_surname||' '||a.mmc_firstname AS CUS_NAME,
    a.mmc_initials,
    a.mmc_title,
    a.mmc_nicno,
    a.mmc_phoneno,
    a.mmc_mobileno,
    a.mmc_email,
    a.mmc_address1,
    a.mmc_address2, a.mmc_address3,
    a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
    a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
    a.modify_date, a.mmc_status, a.mmc_brn, a.mmc_source_of_fund
FROM me_m_customers a
WHERE mmc_surname||' '||a.mmc_firstname LIKE '%$search%'
and  mmc_mecode='$me'";


$result=oci_parse($conn,$sql);
oci_execute($result);

?>


    <!-- Main content -->

    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Contact Name</th>
                                <th>Phone No</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Assign</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = oci_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['MMC_TITLE']; ?></td>
                                    <td><?php echo $row['CUS_NAME']; ?></td>
                                    <td><?php echo $row['MMC_MOBILENO']; ?></td>
                                    <td><?php echo $row['MMC_PHONENO']; ?></td>
                                    <td><?php echo $row['MMC_ADDRESS1']; ?></td>
                                    <td>
                                        <button type='button' data-pol="<?php echo $pol; ?>" class='btn-assign btn bg-orange margin btn-md'>Assign</button>
                                    </td>
                                </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>

    <?php   
                if($cus_name==""){
                //echo $pol;
                echo "
                <button type='button'  data-id='$pol' class='btn-cus btn bg-orange margin btn-md'>Create Customer</button> </center>";
                 } 
              ?>











    </section>

 <div class="row" id="toggle1" style="display: none;">
    <form class="form-control">
       <div class="box box-primary">
         <div class="row">
            <div class="col-md-12">
                <?php 
                $sqlpol="SELECT pol_seq_no,
                pol_policy_no, 
                prs_name,
                sfc_code,
                sfc_brn_code,
                pol_period_from,
                pol_period_to,
                pol_prd_code, 
                (SELECT c.prd_description from uw_m_products c where pol_prd_code=c.prd_code)PROD_DESC,
                pol_cla_code,
                (SELECT a.cla_description FROM uw_r_classes a where pol_cla_code=a.cla_code)AS CLASS,
                pol_total_premium,
                pol_sum_insured
                FROM uw_m_customers b,uw_t_pol_risks b,sm_m_sales_force b,uw_m_cust_addresses b,uw_t_policies
                
                WHERE pol_cus_code=cus_code
                AND prs_plc_pol_seq_no=POL_SEQ_NO
                AND sfc_code=pol_marketing_executive_code
                AND sfc_code=pol_marketing_executive_code
                AND adr_seq_no=pol_adr_seq_no
                
                AND pol_policy_no ='$pol'";
                
                $result=oci_parse($conn,$sqlpol);
                oci_execute($result);
                while($row=oci_fetch_assoc($result))
                {
                  $polseq=$row['POL_SEQ_NO'];
                  $polno=$row['POL_POLICY_NO'];
                  $risk=$row['PRS_NAME'];
                  $brn_code=$row['SFC_BRN_CODE'];
                  $pol_period_from=$row['POL_PERIOD_FROM'];
                  $pol_period_to=$row['POL_PERIOD_TO'];
                  $cla_code=$row['POL_CLA_CODE'];
                  $pol_class_desc=$row['CLASS'];
                  $pol_prd_code=$row['POL_PRD_CODE'];
                  $pol_total_premium=$row['POL_TOTAL_PREMIUM'];
                  $pol_sum_insured=$row['POL_SUM_INSURED'];
                  $prod_desc=$row['PROD_DESC'];
                
              
                 
                }
   
                 ?>

                
                
              
            <div class="box-body">
              <div class="row">
              <div class="col-xs-3">
                <label for="example">Class</label>
                <select class="form-control select2" style="width: 100%;" name="class" id="class" required disabled>
             <option value="<?php echo  $cla_code ?>"><?php echo $pol_class_desc; ?></option> 
            
                </select> 
                </div>


                <div class="col-xs-3">
                <label for="example">Product</label>
                <select class="form-control select2" style="width: 100%;" name="product" id="product" required disabled>
                <option value="<?php echo  $pol_prd_code ?>"><?php echo $prod_desc; ?></option> 
               
                
            
                </select> 
                </div> 
                
          

                <div class="col-xs-3">
                  
                <label for="example">Risk info</label>
                  <input type="text" class="form-control" name="risks" id="risks" placeholder="Enter Risk"  value="<?php echo $risk ?>" required disabled>
                  

                </div>



                <div class="col-xs-3"> 
                <label for="example">Current Insurer</label>
                <select class="form-control select2" style="width: 100%;" name="current_insurer" id="current_insurer" required>
                
                <?php if($insurer =="") { echo "<option value=>- Select Insurer -</option>";} else { echo "<option> $insurer </option>"; } ?>
                
                       <?php
                          $sqlinusrer="SELECT * FROM NC_INS_COMPANY  WHERE og_code NOT IN ('CS','JI','PC','PD','NM','NP')  order by og_name";
                          $stmtins=oci_parse($conn,$sqlinusrer); 
                          oci_execute($stmtins);
                          while($row=oci_fetch_assoc($stmtins)){
                  
                            $og_code=$row['OG_CODE'];
                            $og_name=$row['OG_NAME'];
                           
                            
                           echo "<option> $og_name </option>";
                         }

                      ?>
                        
                </select>
                </div>

                <div class="col-xs-3">
                  <br>
                <label for="example">Sum Insured</label>
                  <input type="text" class="form-control" name="sum_insured" id="sum_insured" value="<?php echo $pol_sum_insured?>" >
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Premium</label>
                  <input type="text" class="form-control" name="premium" id="premium" value="" name="premium" required value="<?php echo $pol_total_premium; ?>">
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Policy Renewal Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-policy_renewal" name="policy_renewal_date" value="">
                </div>
                </div>


                <div class="col-xs-3"> <br>
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date" value="">
                </div>
                </div>

          


                
                <div class="col-xs-3"> <br>
                <label for="example">Type Of Prospective</label>
                <select class="form-control select2" style="width: 100%;" name="type_of_pros" id="type_of_pros" required>
                        <option value="">- Select -</option>
                        <option value="Pending">Pending</option>
                        <option value="Prospective">Propective</option>
                </select> 
                </div>
                
 

               
                <div class="col-xs-3"> <br>
                <label for="example">Remarks</label>
                  <textarea class="form-control" placeholder="Enter Remarks" name="remarks" id="remarks"></textarea>
                </div><br><br>
                 
                 <input type="hidden" name="cus_id" id="cus_id" value="<?php //echo $cus_id ?>" >
                 <input type="hidden" name="bus_id" id="bus_id" value="<?php // echo $business_id ?>">
                 <input type="hidden" name="user" id="user" value="<?php //echo $user ?>">
                
                 <div class="col-xs-12"> <br>
                <div class="box-footer">
               
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button> 
                <button type="submit" name="submit" id="btn-update-bus" class="btn-update-bus btn btn-primary pull-right">Create</button>
             </div>
                        </div>

              </div>
            </div>
            </div>
        </div>
  </div>
    </form>
</div>


<div class="row" id="toggle" style="display: none;">

</div>

<script>
$(document).ready(function() {
    $(".btn-assign").click(function(e) {
        $("#toggle1").toggle();
        e.preventDefault();
    });

    $(".'btn-cus").click(function(e) {
        $("#toggle").toggle();
        e.preventDefault();
    });
});
</script> 