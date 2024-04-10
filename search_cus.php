<!-- Main content -->
<style>
    #toggle {

display:none;

}
#toggle1 {

display:none;

}
</style>

<?php
include_once('connectdb.php');
error_reporting(0);
session_start();
$me=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$pol=$_POST['pol'];

echo $pol;


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

<p><?php echo $pol?></p>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
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
                
                    <?php while($row=oci_fetch_assoc($result))
                    {
                        $tilte=$row['MMC_TITLE'];
                        $cus_name=$row['CUS_NAME'];
                        $phone_no=$row['MMC_PHONENO'];
                        $mobno=$row['MMC_MOBILENO'];
                        $address=$row['MMC_ADDRESS1'];
                        $cus_id=$row['MMC_ID']


                    ?>
                <tr>
                  <td><?php echo $tilte;  ?></td>
                  <td><?php echo $cus_name;  ?></td>
                  <td><?php echo $mobno;  ?></td>
                  <td><?php echo $phone_no;  ?></td>
                  <td><?php echo $address;  ?> </td>
                  <td><!--<button type='button' data-pol="<?php echo $pol; ?>"  class='btn-assign btn bg-orange margin btn-md'>Assign</button>-->
                  <button type='button' data-pol="<?php echo $pol; ?>" data-cuis-id="<?php echo $cus_id; ?>" class='btn-assign btn bg-orange margin btn-md'>Assign</button>
                </td>
                 
    


                  <!-- <input type="hidden" value="<?php echo $pol ?>" id="pol"> -->
                </tr>
                <?php 
                } 
                 }
                 ?>
             
          
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>

        
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<br>
<br>

               <?php   
                if($cus_name==""){
                //echo $pol;
                echo "<center><b>NO CUSTOMER FOUND <br>
                <button type='button'  data-id='$pol' class='btn-cus btn bg-orange margin btn-md'>Create Customer</button> </center>";
                 } 
              ?>

    </section>
    <!-- /.content -->

<!-- Create Business Form -->
<form id="toggle1" method="post">
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
                  $period_to=$row['POL_PERIOD_TO'];


              
                 
                }
   
                 ?>

                
                
              
            <div class="box-body">
              <div class="row">
              <div class="col-xs-3">
                <label for="example">Class</label>
                <select class="form-control 2" style="width: 100%;" name="class" id="class" required disabled>
             <option value="<?php echo  $cla_code ?>"><?php echo $pol_class_desc; ?></option> 
            
                </select> 
               
                </div>


                <div class="col-xs-3">
                <label for="example">Product</label>
                <select class="form-control " style="width: 100%;" name="product" id="product" required disabled>
                <option value="<?php echo  $pol_prd_code ?>"><?php echo $prod_desc; ?></option> 
               
                
            
                </select> 
               
                </div> 
                
          

                <div class="col-xs-3">
                  
                <label for="example">Risk info</label>
                  <input type="text" class="form-control" name="risks" id="risks" placeholder="Enter Risk"  value="<?php echo $risk ?>" required disabled>
                  

                </div>



                <div class="col-xs-3"> 
                <label for="example">Current Insurer</label>
                <select class="form-control " style="width: 100%;" name="current_insurer" id="current_insurer" required>
                
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
                  <input type="text" class="form-control" name="premium" id="premium" value="<?php echo $pol_total_premium;?>" name="premium" required >
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Policy Renewal Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-policy_renewal" name="policy_renewal_date" value="<?php echo $period_to?>">
                </div>
                </div>


               <div class="col-xs-3"> <br>
                <label for="example">Follow Up Date</label>       
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker-follow_up" name="follow_up_date">
                </div>
                </div>

                <div class="col-xs-3"><br>
                <label for="example">Road Tax End Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="road_tax" name="road_tax" value="">
                </div>
                </div>

                <div class="col-xs-3"> <br>
                <label for="example">Leasing Company</label>
                <input type="text" class="form-control" name="leasing_com" id="leasing_com" placeholder="Enter Leasing Company" value="">
                </div>

                
                <div class="col-xs-3"> <br>
                <label for="example">Type Of Prospective</label>
                <select class="form-control " style="width: 100%;" name="type_of_pros" id="type_of_pros" required>
                        <option value="">- Select -</option>
                        <option value="Pending">Pending</option>
                        <option value="Prospective">Propective</option>
                </select> 
                </div>
                
 

                <div class="col-xs-3"> <br>
                <label for="example">Special Promotion</label>
                <select class="form-control " style="width: 100%;" name="promotion" id="promotion" >
                        <option selected></option>
                        
                </select>
                </div>
            
                <div class="col-xs-3"> <br>
                <label for="example">Remarks</label>
                  <textarea class="form-control" placeholder="Enter Remarks" name="remarks" id="remarks"></textarea>
                </div><br><br>
                 
                <div class="row">
                 <input type="hidden" name="class_code" id="class_code" value="<?php echo  $cla_code;?>">
                 <input type="hidden" name="product" id="product">
                 <input type="hidden" name="risks" id="risks">
                 <input type="hidden" name="user" id="user" value="<?php echo $cus_name;?>">
                 <input type="hidden" name="cus_id" id="cus_id" value="<?php echo $cus_id;?>" >
                 </div>

                  <div class="row">
                  <input type="hidden" name="pol_num" id="pol_num" value="<?php echo $polno ?>">
                  <input type="hidden" name="pol_sq" id="pol_sq" value="<?php echo $polseq ?>">
                 
                  </div>

                 <div class="col-xs-12"> <br>
                <div class="box-footer">
               
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button> 
                <button type="button" name="update" id="submit_btn" data-cus-id="<?php echo $cus_id; ?>" class="btn-update-bus btn btn-primary pull-right">Assign</button>
             </div>
                        </div>

              </div>
            </div>
            </div>
        </div>
</div>
</form>
<!-- End Of Business Creation form-->







<!-- Create Contact form -->
   
   
<div class="box box-primary">
    <div class="row">
         <div class="col-md-12">
              <?php 
             $sqlpol="SELECT pol_seq_no,pol_policy_no,cus_indv_title,cus_indv_surname,cus_indv_other_names, prs_name,sfc_code,sfc_brn_code,adr_city,adr_street,adr_loc_description,adr_district,
             pol_period_from,pol_period_to,pol_prd_code, pol_cla_code,pol_total_premium,pol_sum_insured,cus_phone_1,cus_phone_2,cus_indv_nic_no,cus_email,adr_loc_description
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
              $title=$row['CUS_INDV_TITLE'];
              $first_name=$row['CUS_INDV_OTHER_NAMES'];
              $surname=$row['CUS_INDV_SURNAME'];
              $phoneno1=$row['CUS_PHONE_1'];
              $phoneno2=$row['CUS_PHONE_2'];
              $nic=$row['CUS_INDV_NIC_NO'];
              $email=$row['CUS_EMAIL'];
              $city=$row['ADR_CITY'];
              $address1=$row['ADR_STREET'];
              $address2=$row['ADR_LOC_DESCRIPTION'];
              $district=$row['ADR_DISTRICT'];
              
             }

              ?>
       

        <form id="toggle" method="post" action="">
            <div class="box-body">
            <div class="col-md-3">
          
                <label>Title</label>
                    <select class="form-control select2" style="width: 70%;" name="title" id="title" required>
                        <option value="MR" <?php if($title=="MR"){ echo "selected"; } ?>>Mr</option>
                        <option value="MRS" <?php if($title=="MRS"){ echo "selected"; } ?>>Mrs</option>
                        <option value="DR" <?php if($title=="DR"){ echo "selected"; } ?>>Dr</option>
                        <option value="MISS" <?php if($title=="MISS"){ echo "selected"; } ?>>Miss</option>
                       

                    </select> 
                  <!-- /input-group -->
                </div>
            <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" required value="<?php echo $first_name;?>">
                  </div>
                  <!-- /input-group -->
                </div>
           
          
           
            <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">Surname</label>
                    <input type="text" class="form-control" name="surname"  id="surname" placeholder="Enter Surname" required value="<?php echo $surname;?>" > 
                  </div>
                  <!-- /input-group -->
                </div>

                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">Phone No</label>
                    <input type="text" class="form-control" name="phoneno"  id="phoneno" placeholder="Enter Phone no" required value="<?php echo $phoneno2;?>">
                  </div>
                </div>
                  <!-- /input-group -->
                </div>


                <div class="box-body">
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">Mobile No</label>
                    <input type="text" class="form-control" name="mobno" id="mobno"  placeholder="Enter Mobile no" required value="<?php echo $phoneno1;?>">
                  </div>
                  <!-- /input-group -->
                </div>

                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">NIC No</label>
                    <input type="text" class="form-control" name="nic"  id="nic" placeholder="Enter NIC" required value="<?php echo $nic;?>">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">Email Address</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address" required value="<?php echo $email;?>">
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required value="<?php echo $city;?>">
                  </div>
                  <!-- /input-group -->
                </div>
             </div>

              <div class="box-body">
                 <div class="col-md-3">
                   <div class="input-group">
                     <label for="exampleInputFname">Address 1</label>
                    <input type="text" class="form-control" name="adr1" id="adr1" placeholder="Enter Address 1" required value="<?php echo $address1;?>">
                  </div>
                </div>
                <div class="col-md-3">
                   <div class="input-group">
                     <label for="exampleInputFname">Address 2</label>
                    <input type="text" class="form-control" name="adr2" id="adr2" placeholder="Enter Address 3" required value="<?php echo $address2;?>">
                  </div>
                </div>
               

                <div class="col-md-3">
                  <div class="input-group">
                  <label for="exampleInputFname">Address 3</label> 
                    <input type="text" class="form-control" name="adr3" id="adr3" placeholder="Enter Address 3" required >
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                            <label>District</label>
                                <select class="form-control select2" style="width: 100%;" id="district" name="district" id="district" required>
                            
                                    <option  <?php if( $district=="PORT LOUIS")  echo "selected";  ?>>Port Louis</option>
                                    <option  <?php if( $district=="MOKA")  echo "selected";  ?>>Moka</option>
                                    <option  <?php if( $district=="PAMPLEMOUSSES")  echo "selected";  ?>>Pamplemousses</option>
                                    <option  <?php if( $district=="RIVIERE DU REMPART")  echo "selected";  ?>>Riviere du Rempart</option>
                                    <option  <?php if( $district=="FLACQ")  echo "selected";  ?>>Flacq</option>
                                    <option  <?php if( $district=="GRAND PORT")  echo "selected";  ?>>Grand Port</option>
                                    <option  <?php if( $district=="PLAINE WILHEMS")  echo "selected";  ?>>Plaines Wilhems</option>
                                    <option  <?php if( $district=="BLACK RIVER")  echo "selected";  ?>>Black River</option>
                                    <option  <?php if( $district=="SAVANNE")  echo "selected";  ?>>Savanne</option>
                                   
                                </select> 
                            </div>
              </div>
             </div>
             <div class="box-body">
             <div class="col-xs-3">
                    <div class="form-group">
                            <label>Occupation</label>
                                <select class="form-control select2" style="width: 100%;" id="occupation" name="ocupation"required>
                            
                                    <option>Employed</option>
                                    <option>Self Employed</option>
                                    <option>Unemployed</option>
                                </select> 
                            </div>

                  </div>

                 
           


                <div class="col-md-3">
                <div class="form-group">
                            <label>Source Of Fund</label>
                            <select class="form-control select2" style="width: 100%;" id="source_of_fund" name="source_of_fund" id="source_of_fund">
                              <option disabled>- Select - </option>
                              <option value="Employment">Employment</option>
                              <option value="Business">Business</option>
                                <option value="Gifts">Gifts</option>
                                <option value="Leasing"> Leasing</option>
                                <option value="Loan"> Loan</option>
                                <option value="Pension"> Pension</option>
                            </select>
                        </div>
                  <!-- /input-group -->
                </div>

             </div>

           
             


            <div class="box-footer">
             
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="create" id="createBtn" class="btn-create btn btn-primary pull-right">Create</button>
             </div>
             


              </div>
            </div>






            </div>
        </div>
</div>
</form>
<!--  End Of Contact Creation-->






<script>
//to toggle create customer  form 
    $(document).ready(function() {
    $(".btn-cus").click(function() {
    var polno = $(this).data('id');
   // alert(polno);
   
    $("#toggle").toggle();
    e.preventDefault();
  });
});
//to toggle create customer  form 
$(document).ready(function() {

  var cusIdValue = "<?php echo $cus_id; ?>";
    $("#cus_id").val(cusIdValue);

    $(".btn-assign").click(function(e) {
    $("#toggle1").toggle();
    e.preventDefault();
  });
});


  //Initialize Select2 Elements
  $('.select2').select2()

//Date picker
$('#datepicker-follow_up').datepicker({
      autoclose: true
      
    })


$('#datepicker-policy_renewal').datepicker({
      autoclose: true,
      
      
    })
  

  //BACKDATE FOLLOW UP DATE TO 1 MONTH BACK 
    $(function() {    
           $('.datepicker-policy_renewal').datepicker();
           
           var updateSecondDate= function() {
            var firstDate = new Date($('#datepicker-policy_renewal').val());
            //var d = new Date();
            firstDate.setMonth(firstDate.getMonth() - 1);
            $('#datepicker-follow_up').datepicker('setDate', firstDate);
             
            }
           // $('#datepicker-policy_renewal').datepicker();
            $('#datepicker-policy_renewal').change(updateSecondDate);
    });
// end 


    $('#road_tax').datepicker({
      autoclose: true
    })



//process customer form value to insert in me_m_customer table
$(document).ready(function() {
    $("#createBtn").click(function(event) {
        event.preventDefault();

          var title =$('#title').val();
            var fname =$('#fname').val();
            var surname =$('#surname').val();
            var phoneno =$('#phoneno').val(); 
            var mobno =$('#mobno').val();
            var nic =$('#nic').val();
            var email =$('#email').val();
            var city =$('#city').val();
            var adr1 =$('#adr1').val();
            var adr2 =$('#adr2').val();
            var adr3 =$('#adr3').val();
            var district =$('#district').val();
            var occupation =$('#occupation').val();
            var source_of_fund =$('#source_of_fund').val();
            //var polno=$("#polno").val();

        $.ajax({
            url: 'renewal-ajax/insertRenwalCusData.php',
            type: 'POST',
            data: {
              title:title,
              fname:fname,
              surname:surname,
              phoneno:phoneno,
              mobno:mobno,
              nic:nic,
              email:email,
              city:city,
              adr1:adr1,
              adr2:adr2,
              adr3:adr3,
              district:district,
              occupation:occupation,
              source_of_fund:source_of_fund,
              //polno:polno
            },
            cache: false,
            success: function(data) {
    if (data === "1") {
        alert("Mobile Number Already Exists");
        $("#create_cus_ajax").modal('hide'); // Hide the modal with ID 'create_cus_ajax'
    } else if (data === "2") {
      alert("Customer Successfully created");
      window.location="renewallist.php";
    } else {
        alert(data); // Provide feedback to the user
        $("#create_cus_ajax").modal('hide'); // Hide the modal with ID 'create_cus_ajax'
        location.reload();
    }
}

            
        });
    });
});



// Insert Business data

    $(document).ready(function() {
    $("#submit_btn").click(function(event) {
        event.preventDefault(); 
        var class_code = $("#class_code").val();
         var product = $("#product").val();
           var risk = $("#risks").val();
           var current_insurer = $("#current_insurer").val();
            var sum_insured = $("#sum_insured").val();
            var premium = $("#premium").val();
           var policy_renewal_date = $("#datepicker-policy_renewal").val();
           var policy_followup_date = $("#datepicker-follow_up").val();
            var road_tax = $("#road_tax").val();
            var leasing_com = $("#leasing_com").val();
           var type_of_pros = $("#type_of_pros").val();
           var promotion = $("#promotion").val();
            var remarks = $("#remarks").val();
            
            var cus_id = $("#cus_id").val();
            var user = $("#user").val();
            var pol_num=$("#pol_num").val();
           // alert(pol_num);
            var pol_sq=$("#pol_sq").val();
            //alert(pol_sq);

      if(risks == ""){
      
      jQuery(function validation(){
      swal({
      title: "Please Fill Risk Field",
      text: "Record NOT Added",
      icon: "error",
      button: "Ok",
       });
       });
    }
    else{
       //alert(Data.cus_id);
        // AJAX request

   $.ajax({
    url: "renewal-ajax/RenewalBusData.php",
    type: "POST",
    data: {
      class_code:class_code,
      product:product,
      risk:risk,
      current_insurer:current_insurer,
      sum_insured:sum_insured,
      premium:premium,
      policy_renewal_date:policy_renewal_date,
      policy_followup_date:policy_followup_date,
      road_tax:road_tax,
      leasing_com:leasing_com,
      type_of_pros:type_of_pros,
      promotion : promotion ,
      remarks :remarks ,
      cus_id:cus_id,
      user:user,
      pol_num:pol_num,
      pol_sq:pol_sq
    },
         
    cache: false,
               success: function (data) {
    
    // Check if data is equal to 0
    if(data == 0){
        // Display an alert if data is 0
        alert("Business Already Exist. Record NOT Added");
    }
    
    // Check if data is equal to 1
    if(data == 1){
        // Redirect to business_renewal_followup.php if data is 1
        alert("Business Successfully Assign"); 
        window.location.replace('business_renewal_followup.php');
    }
}
,

});
}
    });
});



</script>

