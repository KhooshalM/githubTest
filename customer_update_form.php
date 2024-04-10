<?php
include_once('connectdb.php');
session_start();
$me_code=$_SESSION['me_code'];
  $user=$_SESSION['me_fname'];
  $brn=$_SESSION['me_brn']; 
$cusotmer_id=$_POST['cus_id'];

//echo $cusotmer_id;
$sql="SELECT a.mmc_id, a.mmc_surname, a.mmc_firstname, a.mmc_initials,
a.mmc_title, a.mmc_nicno, a.mmc_phoneno, a.mmc_mobileno,
a.mmc_email, a.mmc_address1, a.mmc_address2, a.mmc_address3,
a.mmc_city, a.mmc_district, a.mmc_business_occ, a.mmc_ref_id,
a.mmc_mecode, a.created_by, a.created_date, a.modify_by,
a.modify_date, a.mmc_status, a.mmc_brn,a.mmc_source_of_fund
FROM me_m_customers a WHERE mmc_id='$cusotmer_id' ";
  $result=oci_parse($conn,$sql);
  oci_execute($result);
  while($row=oci_fetch_assoc($result)){

    $cus_id=$row['MMC_ID'];
    $title=$row['MMC_TITLE'];
    $fname=$row['MMC_FIRSTNAME'];
    $surname=$row['MMC_SURNAME'];
    $nic=$row['MMC_NICNO'];
    $mobno=$row['MMC_MOBILENO'];
    $phoneno=$row['MMC_PHONENO'];
    $email=$row['MMC_EMAIL'];
    $address1=$row['MMC_ADDRESS1'];
    $address2=$row['MMC_ADDRESS2'];
    $address3=$row['MMC_ADDRESS3'];
    $souce_of_fund=$row['MMC_SOURCE_OF_FUND'];
    $city=$row['MMC_CITY'];
    $district=$row['MMC_DISTRICT'];
    $ocupation=$row['MMC_BUSINESS_OCC'];
    $ref_id=$row['MMC_REF_ID'];
    
?> 

   <!-- general form elements -->
   <div class="box box-primary">
        <div class="row">
            <div class="col-md-12">
                
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                <div id="message"></div>
                <form method="POST" action="process_update_cus.php">
             
                <div class="form-group">
                    <label>Title</label>
                        <select class="form-control select2" style="width: 100%;" name="title"  id="title" required>
                    
                            <option  <?php if( $title=="MR")  echo "selected";  ?>>Mr</option>
                            <option  <?php if( $title=="MRS") echo "selected";  ?>>Mrs</option>
                            <option  <?php if( $title=="DR")  echo "selected";  ?>>Dr</option>
                            <option  <?php if( $title=="MISS")echo "selected";  ?>>Miss</option>
                           
                            
                           
                           

                        </select> 
                    </div>
                </div>
                <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputFname">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo  $fname;?>" required >
                    </div>
                </div>
                <div class="col-xs-5">
                <div class="form-group">
                    <label for="exampleInputlname">Surname</label>
                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo  $surname;?>" required >
                    </div>
                </div>
              </div>
            </div>


            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                <div class="form-group">
                    <label for="exampleInputmob">Mobile No</label>
                    <input type="text" class="form-control" name="mobileno" id="mob" value="<?php echo  $mobno;?>" required>
                    </div>
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <label for="exampleInputphone">Phone No</label>
                    <input type="text" class="form-control" name="phoneno" id="phoneno"  value="<?php echo  $phoneno;?>" >
                  </div>
                </div>
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="exampleInputnic">NIC</label>
                    <input type="text" class="form-control" name="nic" id="nic"  value="<?php echo  $nic;?>"required>
                    <span class="help-block" id="help-block"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputemail">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email"  value="<?php echo  $email;?>">
                    </div>
                    </div>
              </div>
            </div>
            

            <div class="box-body">
              <div class="row">
              <div class="col-xs-12">
                  <div class="form-group">
                    <label for="exampleInputaddress">Address 1</label>
                    <input type="text" class="form-control" name="address" id="address1"  value="<?php echo  $address1;?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
              <div class="col-xs-12">
                  <div class="form-group">
                    <label for="exampleInputaddress">Address 2</label>
                    <input type="text" class="form-control" name="address2" id="address2" value="<?php echo  $address2;?>">
                  </div>
                </div>
              </div>
            </div>



            <div class="box-body">
              <div class="row">
              <div class="col-xs-12">
                  <div class="form-group">
                    <label for="exampleInputaddress">Address 3</label>
                    <input type="text" class="form-control" name="address3" id="address3" value="<?php echo  $address3; ?>">
                  </div>
                </div>
              </div>
            </div>



            <div class="box-body">
              <div class="row">
              <div class="col-xs-12">
              <div class="form-group">
                            <label>Source Of Fund</label>
                            <select class="form-control select2" style="width: 100%;"  name="source_of_fund" id="source_of_fund">
                            <option disabled>- Select - </option>
                        <option value="Employment">Employment</option>
                        <option value="Business">Business</option>
                        
                        <option value="Gifts">Gifts</option>
                        <option value="Leasing"> Leasing</option>
                        <option value="Loan"> Loan</option>
                        <option value="Pension"> Pension</option>
                            </select>
                        </div>
                </div>
              </div>
            </div>



            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                <div class="form-group">
                    <label for="exampleInputcity">City</label>
                    <input type="text" class="form-control" name="city" id="city" value="<?php echo  $city;?>">
                    </div>
                </div>

                <div class="col-xs-9">
                    <div class="form-group">
                            <label>District</label>
                                <select class="form-control select2" style="width: 100%;" name="district" id="district" required>
                            
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
            </div>
                
           

                <div class="box-body">
              <div class="row">
              <div class="col-xs-9">
                    <div class="form-group">
                            <label>Occupation</label>
                                <select class="form-control select2" style="width: 100%;" name="ocupation" id="ocupation" required>
                            
                                    <option>Employed</option>
                                    <option>Self Employed</option>
                                    <option>Unemployed</option>
                                </select> 
                            </div>

              </div>
              <div class="col-xs-3">
                <div class="form-group">
                <label>Referal</label>
                <select class="form-control" style="width: 100%;" name="referal" id="referal" onchange="showDiv(this)" required>
                    
                <option  <?php if( $ref_id =="") { echo "selected"; } ?> value="N">No</option>
                 <option value="Y" <?php if( $ref_id !="") { echo "selected"; } ?> >Yes</option>
                    
                    
                </select> 
                    </div>
                </div>


            </div>
            </div>

            <div class="box-body">
              <div class="row">
             
                <div class="col-xs-12">
                <div class="form-group"   id="hidden_div" style="display: none;" >
                <label>Select Referal</label>
                <select class="form-control select2" style="width: 100%;" name="referal_id" id="referal_id">




                 <?php
                 $sqlref="select mmc_id,mmc_firstname,mmc_surname from me_m_customers WHERE mmc_mecode='$me_code'";
                 $stmt=oci_parse($conn,$sqlref); 
                 oci_execute($stmt);
                 while($row=oci_fetch_assoc($stmt)){

                    $cus_id=$row['MMC_ID'];
                    $fname=$row['MMC_FIRSTNAME'];
                    $surname=$row['MMC_SURNAME'];  
                   
                 
                 
                 ?>


               

                      <option value="<?php echo $cus_id ?>"> <?php  echo $fname .' '.$surname ?></option>
                       <?php  } ?>  
                </select>
                    </div>
                </div>


              </div>
            </div>




            



            <input type="hidden" class="form-control" name="cus_id" id="cus_id" value="<?php echo $cusotmer_id ?>">
            <input type="hidden" class="form-control" name="me_code" id="me_code" value="<?php echo $me_code ?>">
            <input type="hidden" class="form-control" name="me_username" id="me_username" value="<?php echo $user ?>">
            <input type="hidden" class="form-control" name="me_brn" id="me_brn" value="<?php echo $brn ?>">
            
            <div class="box-footer">
                <button type="submit" name="submit" id="btn-update" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
             </div>
             


              </div>
            </div>






            </div>
        </div>
      
   </div>
          <?php } ?>
          </form>
<script>
     $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
     }
    )


  //to display selection option of referal
function showDiv(select){
   if(select.value=="Y"){
    document.getElementById('hidden_div').style.display = "block";
   } else{
    document.getElementById('hidden_div').style.display = "none";
   }
} 
</script>

<script>

/*
  $("#nic").keyup(function(){
    var nic = $('#nic').val();
  if (nic.length !== 14) {
        $('#help-block').html('<span class="help-block" id="help-block">Invalid NIC</span>');
        return false;
  }
    });
    
*/





$(document).ready(function(){
$('#btn-update').click(function(){
  
    event.preventDefault();
    var cus_id = $('#cus_id').val();
    var title  = $('#title').val();
    var fname  = $('#fname').val();
    var surname  = $('#lname').val();
    var mobileno = $('#mob').val();
    var phoneno = $('#phoneno').val();
    var nic = $('#nic').val();

    var email = $('#email').val();
    var address1  = $('#address1').val();
    var address2  = $('#address2').val();
    var address3  = $('#address3').val();
    var source_of_fund = $('#source_of_fund').val();
    var city = $('#city').val();


    var district = $('#district').val();
    var ocupation = $('#ocupation').val(); 

    var referal = $('#referal').val();
    var referal_id = $('#referal_id').val();


    var me_code = $('#me_code').val();
    var me_username = $('#me_username').val();
    var me_brn = $('#me_brn').val();
   
   // alert(me_username)
  if (mobileno==null || mobileno=="" ) 
    {
        jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Mobile Number is Required",
                              icon: "error",
                              button: "Ok",
                            });
                        });
        return false;
    }


    if (mobileno.length !== 8 ) 
    {
        jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Issue With Mobile Number.. ",
                              icon: "error",
                              button: "Ok",
                            });
                        });
        return false;
    }


/*
    if (nic.length !== 14 ) 
    {
        jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Invalid NIC",
                              icon: "error",
                              button: "Ok",
                            });
                        });
        return false;
    }

*/

    else{
    $.ajax({
        url: 'process_update_cus.php',
        type: 'POST',
        data: {
           cus_id:cus_id,
           title:title,
           fname:fname,
           surname:surname,
           mobileno:mobileno,
           phoneno:phoneno,
           nic:nic,
           email:email,
           address1:address1,
           address2:address2,
           address3:address3,
           city:city,
           source_of_fund:source_of_fund,
           district:district,
           ocupation:ocupation,
           referal:referal,
           referal_id:referal_id,
           me_code:me_code,
           me_username:me_username,
           me_brn:me_brn
         },
            cache: false,
            success: function (data) {
            $('#message').html(data);
            
           // setTimeout(function(){location.href="daily_act.php"} , 1000);
           $("#modal-default").modal('hide');
            location.reload();

           
		}

    });
    }
});

});

</script>