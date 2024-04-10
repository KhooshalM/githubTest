<?php
//echo "TEST";
include_once('connectdb.php');




error_reporting(0);
session_start();


$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 



$quo_seq=$_POST['quo_seq'];
$policy_sts=$_POST['policy_sts'];
//echo $policy_sts;
$cus_id=$_POST['cus_id'];
$bus_id=$_POST['bus_id'];
//echo $cus_id;


$custname=$_POST['custname'];
//echo $custname;
//echo "<br>";

$phoneno=$_POST['phoneno'];
//echo $phoneno;
//echo "<br>";
$mobno=$_POST['mobno'];
//echo $mobno;
//echo "<br>";
$vehino=$_POST['vehino'];
//echo $vehino;
//echo "<br>";




$class=strtoupper($_POST['classcode']);
//echo $class;
//echo "<br>";

$prod_code=strtoupper($_POST['prod_code']);
//echo $prod_code;
//echo "<br>";

$suminsured=strtoupper($_POST['suminsured']);
//$suminsured=number_format($suminsured);
//echo $suminsured;
//echo "<br>";


$yearofmake=$_POST['yearofmake'];
//echo $yearofmake;
//echo "<br>";


$capacity=$_POST['capacity'];
//echo $capacity;
//echo "<br>";

$fuel_type=strtoupper($_POST['fuel_type']);
//echo $fuel_type;
//echo "<br>";


$chassis=strtoupper($_POST['chassis']);
//echo $chassis;
//echo "<br>";

$engineno=strtoupper($_POST['engineno']);
//echo $engineno;
//echo "<br>";

$model_code=strtoupper($_POST['model']);
//echo $model_code;
//echo "<br>";

$mileage=$_POST['mileage'];
//echo $mileage;

$seating_capacity=$_POST['seating_capacity'];
//echo $seating_capacity;
//echo "<br>";

$medical=$_POST['medical'];
//echo $medical;
//echo "<br>";

$criticall=$_POST['criticall'];
//echo $criticall;
//echo "<br>";


$towing=$_POST['towing'];


$kilotwat=$_POST['kilotwat'];
//echo $kilotwat;
//echo "<br>";
//ECHO $fuel_type;









$original_regist=date("d-M-Y", strtotime($_POST['original_regist'])); 
$oriyear=date("Y", strtotime($_POST['original_regist']));
//echo $oriyear;
//echo $original_regist;
//echo "<br>";


//echo $original_regist;
//echo "<br>";
$mts_regist_date=date("d-M-Y", strtotime($_POST['mts_regist_date']));
//echo $mts_regist_date;
//echo "<br>";



//$start_date=$_POST['datepicker_start_date'];
$start_date=date("d-M-Y", strtotime($_POST['datepicker_start_date'])); 
//echo $start_date;
//echo "<br>";

  

//echo $start_date;

$end_date=date("d-M-Y", strtotime($_POST['datepicker_end_date'])); 
//echo $end_date;
//echo "<br>";



$condition=$_POST['condition'];



if($condition=="N"){
	$condition_desc="NEW";
}


if($condition=="S"){
	$condition_desc="SECOND HAND";
}
//echo $condition_desc;









//FIND BLACKLIST VEHICLE 
$blacklist="SELECT COUNT(*) AS NUM
FROM uw_pol_risk_blacklisted a
where prb_blacklisted='Y'
AND  regexp_replace(prb_prs_name, '[[:space:]]*','') ='$vehino'
AND prb_prs_name IS NOT NULL
";
$blid = oci_parse($conn,$blacklist);
oci_execute($blid);
if($row=oci_fetch_assoc($blid)){
	$num=$row['NUM'];
//echo $num;
//

 } 
 if($num != 0){
  echo '<script type="text/javascript">
  jQuery(function validation(){
  swal({
    title: "ERROR ",
    text: "Vehicle Blacklisted ! ",
    icon: "error",
    button: "Close.....",
    timer: 10000,
 
  });
});

setTimeout(function(){window.top.location="business_followup.php"} , 2000);
</script>';

 }







$user=$_POST['user'];
$brn=$_POST['brn'];


 
//echo $brn;
//echo "<br>";

//IF PRODUCT_CODE 3A INCLUDE 3a_quote.php PAGE
if($prod_code=="3A"){
  include "product/3a_quote.php";
}

//IF PRODUCT_CODE 1A INCLUDE 1a_quote.php PAGE
if($prod_code=="1A"){
  include "product/1a_quote.php";
}


//IF PRODUCT_CODE 1C INCLUDE 1c_quote.php PAGE
if($prod_code=="1C"){
  include "product/1c_quote.php";
}

//IF PRODUCT_CODE 1D INCLUDE 1d_quote.php PAGE
if($prod_code=="1D"){
  include "product/1d_quote.php";
}

//IF PRODUCT_CODE 1E INCLUDE 1e_quote.php PAGE
if($prod_code=="1E"){
  include "product/1e_quote.php";
}


//IF PRODUCT_CODE 1F INCLUDE 1f_quote.php PAGE
if($prod_code=="1F"){
  include "product/1f_quote.php";
}
//IF PRODUCT_CODE 1G INCLUDE 1g_quote.php PAGE
if($prod_code=="1G"){
  include "product/1g_quote.php";
}

//IF PRODUCT_CODE 1K INCLUDE 1k_quote.php PAGE
if($prod_code=="1K"){
  include "product/1k_quote.php";
}

//IF PRODUCT_CODE 1T INCLUDE 1t_quote.php PAGE
if($prod_code=="1T"){
  include "product/1t_quote.php";
}

//IF PRODUCT_CODE 3C INCLUDE 3c_quote.php PAGE
if($prod_code=="3C"){
  include "product/3c_quote.php";
}

//IF PRODUCT_CODE 3D INCLUDE 3d_quote.php PAGE
if($prod_code=="3D"){
  include "product/3d_quote.php";
}


//IF PRODUCT_CODE 3E INCLUDE 3e_quote.php PAGE
if($prod_code=="3E"){
  include "product/3e_quote.php";
}

//IF PRODUCT_CODE 3F INCLUDE 3f_quote.php PAGE
if($prod_code=="3F"){
  include "product/3f_quote.php";
}


//IF PRODUCT_CODE 3G INCLUDE 3f_quote.php PAGE
if($prod_code=="3G"){
  include "product/3g_quote.php";
}

//TOTAL PREMIUM FOR QUOTATION 
//$total=$prm+$ext_prm+$towing_prm+$cri_med+$others_prm+$pol_fees+$pass_fees+$add_load+$vip;
//echo "<br>";
//echo $total;



if($level=="4"){
  echo '<script type="text/javascript">
  jQuery(function validation(){
  swal({
    title: "ERROR ",
    text: "Vehicle Blacklisted ! ",
    icon: "error",
    button: "Close.....",
    timer: 10000,
 
  });
});


</script>';
}


//END

?>
  

    <!-- Content Header (Page header) -->
    <section class="content-header" id="invoice">
      
    <?php
  //  echo $prod_code;

     $sqlprod="SELECT prd_code,prd_cla_code,INITCAP(prd_description)PRDDESC FROM uw_m_products WHERE prd_code='$prod_code' AND  prd_status='Y'";
     $sticode = oci_parse($conn,$sqlprod);
     oci_execute($sticode);
     
     if($row=oci_fetch_assoc($sticode)){
         $descode=$row['PRDDESC'];
      
       //
        } 
    

        $sqlclass="SELECT a.cla_code,INITCAP( a.cla_description)CLADESC, a.created_by, a.created_date,
        a.modified_by, a.modified_date
        FROM uw_r_classes a 
        WHERE cla_code='$class'";

     $stidclass = oci_parse($conn,$sqlclass);
     oci_execute($stidclass);
     
     if($row=oci_fetch_assoc($stidclass)){
         $clasdesc=$row['CLADESC'];
      
       //
        } 




    ?>  


  
    </section>



       
    <br>


          <?php 
          
          
          $makemodel="SELECT  a.rft_description
            FROM cm_r_reference_two a
            where  rft_code='$model_code'";
            $stmt1=oci_parse($conn,$makemodel); 
            oci_execute($stmt1);
            if($row=oci_fetch_assoc($stmt1)){
                
    
     $modeldesc=$row['RFT_DESCRIPTION'];
    
  }

          ?>
      

 <div class="box-body">
              <table class="table table-condensed">
                <tr>
                  <th colspan="3" class="text-info">CUSTOMER DETAILS</th>
                  
                  <th colspan="3" class="text-info">VEHICLE DETAILS</th>
                  
                </tr>
                <tr>
                    <td class="text-info">Owner</th>
                    <td>:</th>
                    <td><b><?php echo $custname; ?> </b> </td>
                    <td class="text-info">Year Of Make</th>
                    <td>:</th>
                    <td><b><?php echo $yearofmake; ?></b> </td>
                    <input type="hidden" name="yom" id="yom" value="<?php echo $yearofmake; ?>">
                </tr>
                <tr>
                    <td class="text-info">Phone No</th>
                    <td>:</th>
                    <td><b><?php echo $phoneno; ?> </b></td>
                    <td class="text-info">CC Capacity</th>
                    <td>:</th>
                    <td><b><?php echo $capacity; ?></b> </td>
                    <input type="hidden" name="capacity" id="capacity" value="<?php echo $capacity; ?>">
                </tr>            
                <tr>
                    <td class="text-info">Mobile No</th>
                    <td>:</th>
                    <td><b><?php echo $mobno; ?></b></td>
                    <td class="text-info">Fuel Type</th>
                    <td>:</th>
                    <td><b><?php if($fuel_type=="05ELE"){ echo "ELECTRIC"; } else { echo $fuel_type;}   ?></b></td>
                    <input type="hidden" name="fuel_type" id="fuel_type" value="<?php if($fuel_type=="05ELE"){ echo "ELECTRIC"; } else { echo $fuel_type;}   ?>"> 
                   
                </tr>
                <tr>
                    <td class="text-info">Vehicle No</th>
                    <td>:</th>
                    <td><b><?php echo $vehino; ?></b></td>
                    <td class="text-info">Engine No</th>
                    <td>:</th>
                    <td><b><?php echo $engineno; ?></b></td>
                    <input type="hidden" name="engine" id="engine" value="<?php echo $engineno; ?>">
                </tr>
                <tr>
                    <td class="text-info">Sum Insured </th>
                    <td>:</th>
                    <td> <b><?php echo number_format($suminsured); ?></b></td>
                    <input type="hidden" name="sum_ins" id="sum_ins" value="<?php echo number_format($suminsured); ?>">
                    <td class="text-info">Chassis Number </th>
                    <td>:</th>
                    <td><b> <?php echo $chassis; ?></b></td>
                    <input type="hidden" name="chassis" id="chassis" value="<?php echo $chassis; ?>">
                </tr>
              
                <tr>
                    <td class="text-info">Period of Cover </th>
                    <td>:</th>
                    <td><b> From  <?php echo $start_date; ?> </b>- To :<b> <?php echo $end_date; ?> </b> </td>
                    <input type="hidden" name="start_date" id="start_date" value="<?php echo $start_date; ?>">

                    <input type="hidden" name="end_date" id="end_date" value="<?php echo $end_date; ?>">


                    <td class="text-info">Make & Model </th>
                    <td>:</th>
                    <td> <b><?php echo $modeldesc; ?></b></td>
                    <input type="hidden" name="modeldesc" id="modeldesc" value="<?php echo $modeldesc; ?>">
                </tr>
            
                <tr>
                    <td class="text-info">Days</th>
                    <td>:</th>
                    <td> <b><?php echo $no_days; ?> </b></td> 
                    <input type="hidden" name="no_days" id="no_days" value="<?php echo $no_days; ?>">
                    
                    <td class="text-info">Seating Capacity</th>
                    <td>:</th>
                    <td><b> <?php echo $seating_capacity; ?> </b></td>
                    <input type="hidden" name="seating_capacity" id="seating_capacity" value="<?php echo $seating_capacity; ?>">
                </tr>
                <tr>
                <td> </th>
                    <td></th>
                    <td></td>
                    <td class="text-info"> Original Registration Date </th>
                    <td>:</th>
                    <td> <b><?php echo $original_regist; ?></b> </td>
                    <input type="hidden" name="original_regist" id="original_regist" value="<?php echo $original_regist; ?>">
                </tr>
              
                <tr>
                <th class="text-info">Additional Details</th>
                <th></th>
                <th></th>
                <td class="text-info"> Mauritius Registration Date</th>
                    <td>:</th>
                    <td><b> <?php echo $mts_regist_date; ?> </b></td>
                    <input type="hidden" name="mts_regist_date" id="mts_regist_date" value="<?php echo $mts_regist_date; ?>">
                </tr>
                
                <tr>
                <td class="text-info">Towing</th>
                    <td>:</th>
                    <td> <b> <?php if($towing=="Y"){ echo "YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b>
                    <input type="hidden" name="towing" id="towing" value="<?php echo $towing; ?>">
                   </td>
                   <td class="text-info">Condition</th>
                    <td>:</th>
                    <td><b><?php echo $condition_desc; ?></b></td>
                    <input type="hidden" name="condition_desc" id="condition_desc" value="<?php echo $condition; ?>">
                </tr>
              

                <tr>
                <td class="text-info">Criticall</th>
                    <td>:</th>
                    <td> <b>  <?php if($criticall=="Y" && $no_days > 180){ echo " YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b>  </td>
                    <input type="hidden" name="criticall" id="criticall" value="<?php echo $criticall; ?>">


                    <td class="text-info">Kilowatt</th>
                    <td>:</th>
                    <td><b><?php echo $kilotwat; ?></b></td>
                    <input type="hidden" name="kilotwat" id="kilotwat" value="<?php echo $kilotwat; ?>">
                </tr>
                <tr>
                <td class="text-info">Medical</th>
                    <td>:</th>
                    <td> <b><?php if($medical=="Y" && $no_days > 180){ echo "YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b> </td>
                    <input type="hidden" name="medical" id="medical" value="<?php echo $medical; ?>">
                </tr>
                  
              </table>
            </div>
            <input type="hidden" id="cus_id" value="<?php echo $cus_id; ?>">
            <input type="hidden" id="bus_id" value="<?php echo $bus_id; ?>">
            <input type="hidden" id="quo_seq" value="<?php echo $quo_seq; ?>">
            <input type="hidden" id="policy_sts" value="<?php echo $policy_sts ?>">
              <br> <br>
              
        <div class="col-xs-4">
        <div class="box-header bg-success">
              <h3 class="box-title "> <b>Quotation</b></h3>
            </div>


          <div class="table-responsive bg-warning">
            <table class="table">
                <?php if($bp >= 0 && $no_days <= 428){

                ?>
              <tr>
                <th style="width:50%">Basic Premium:</th>
                <td><b><?php echo number_format($bp); ?></b></td>
              </tr>

              
                  <?php if($class=="MC")
                {
                  ?>
              <tr>
                <th>VIP Premium </th>
                <td><b><?php  echo number_format($vip); ?></b></td>
              </tr>
               <?php } ?>
               <tr>
                <th>High Risk Loading:</th>
                <td><b><?php echo number_format($hrl); ?></b></td>
              </tr>

              <tr>
                <th>Additional Loading:</th>
                <td><b><?php echo number_format($add_load); ?></b></td>
              </tr>

              <tr>
                <th>No Claim Bonus:</th>
                <td><b><?php echo number_format($no_clm); ?></b></td>
              </tr>
              <tr>
                <th>Extension Premium </th>
                <td>  <b><?php echo number_format($ext_prm); ?></b></td>
              </tr>
              <tr>
                <th>Towing </th>
                <td>   <b><?php echo number_format($towing_prm); ?></b></td>
              </tr>
              <tr>
                <th>Passenger Fees </th>
                <td><b><?php  echo number_format($tl); ?></b></td>
              </tr>
              <tr>
                <th>Medical & Critical Cover </th>
                <td> &nbsp;<b><?php  echo number_format($cri_med); ?></b></td>
              </tr>
              <tr>
                <th>Other Charges </th>
                <td> &nbsp;<b><?php   echo number_format($oth);  ?></b></td>
              </tr>
              <tr>
                <th>Policy Fee </th>
                <td><b><?php  echo number_format($polfees); ?></b></td>
               
              </tr>
           

                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
              <tr>
                <th class="bg-success"><h3>Total</h3></th>
                <td class="bg-success"><h3><b><?php echo  number_format($total_prm);?></b></h3></td>
                <input type="hidden" name="total_prm" id="total_prm" value="<?php echo $total_prm; ?>">
                <input type="hidden" name="mileage" id="mileage" value="<?php echo $mileage; ?>">
                <input type="hidden" name="model_code" id="model_code" value="<?php echo $model_code; ?>">
              </tr>
              <?php } 
              else {


                echo '<script type="text/javascript">
                jQuery(function validation(){
                swal({
                  title: "ERROR ",
                  text: "Cant Provide Quotation ! ",
                  icon: "error",
                  button: "Loading.....",
                  //javascript:history.back()
                });
            });
            
            </script>';

           
              }
              

              ?>
            </table>
          </div>
        </div>
        <!-- /.col -->

        <div class="col-xs-4">
         
        <div class="box">
            <div class="box-header bg-info">
              <h3 class="box-title "> <b>Benefits</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                
                </tr>
								
                <tr>

                <?php 


								//SQL FOR MANDATORY BENEFIT

                $sqlbenfit="SELECT * FROM me_r_prod_benefits WHERE mpb_option='1' AND mpb_prod_code='$prod_code'";
                $benefit = oci_parse($conn,$sqlbenfit);
                oci_execute($benefit);

                  while($row=oci_fetch_assoc($benefit)){
                     $desc=$row['MPB_BENEFITS_DESC'];
                     $peril=$row['MPB_PERIL'];
                   // echo $desc_benefit;
                  
      
                
                ?>
                  <td><?php echo $desc; ?></td>
                  
                  
                </tr><?php
								 } 
								 //MANDATORY BENEFIT END 
								?>
                <tr>
               
                
                    
                    
               <?php 
							//PUSH ARRAY FOR ADDITIONAL COVER 
                 $a=[];

                  if($towing=='Y'){
                   array_push($a,"TW");

                  }
               
									//MEDICAL AND CRITICAL 
                  if($criticall=='Y'){
                   array_push($a,"CR");

                  }
                  if($medical=='Y'){
                   array_push($a,"AC");

                  }
									//SEATING CAPACITY 
                  if($seating_capacity > 0){
                   array_push($a,"PC");

                  }

                  					//WARRANTY COVER
                            /*
                  if($waranty1 !== ""){
                   array_push($a,"WC");

                  } */

								
                  /*
									//CAR TO CAR COVER FOR CONDITION NEW
									if($ctcoriginaldate <= 730  &&  $condition=="N"){
										array_push($a,"CTC");
									}


										//CAR TO CAR COVER FOR CONDITION SECOND HAND
										if($ctcmtsdate <= 1826  &&  $condition=="S"){
											array_push($a,"CTC");
										}
                    */
                // $array=['TW','CR','PC','AC'];

                 $code="'".implode("','",$a)."'";
                 //echo $code;
               $sqlben="SELECT * from me_r_prod_benefits where mpb_option='2'  AND mpb_peril IN ($code) AND mpb_prod_code='$prod_code'";
               $bfit = oci_parse($conn,$sqlben);
               oci_execute($bfit );

                 while($row=oci_fetch_assoc($bfit )){
                    $desc=$row['MPB_BENEFITS_DESC'];
                    $peril=$row['MPB_PERIL'];
								 
                   
                 
                 ?>
           <td><?php  echo $desc; ?></td>
          
             </tr>
           <?php } ?>

             <tr>
              <?php    
              if($war_status=="Y") { 
                echo "<td> Warranty Cover Available - Yes :  $schedule  </td>";
              } 
              
            
              elseif($war_status=="N") { 
                echo "<td> Warranty Cover  - Not Available  </td>";
              } 

             
               if($war_status=="") {
                echo "";
              }

             
              
              

              ?>
               
          
             </tr>
            <tr>
              <?php if($ctc !== "N"){ echo "<td>  $ctc</td>"; } ?>

            </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        







        <div class="col-xs-4">
         
         <div class="box">
             <div class="box-header bg-danger">
               <h3 class="box-title "> <b>Claim History</b></h3>
             </div>
            
             <div class="box-body no-padding">
               <table class="table table-condensed">
               <tr>
             <th><b>Acc.Date</b> </th>
             <th><b>Name</b> </th>
             <th><b>Lia.At fault</b> </th>
      </tr>
                
                 <?php 
 $sqlhis="SELECT sui_int_date_loss,sui_int_claim_no,sui_vehicleno,SUI_CLAIMENT_NAME,SUI_POLICY_NO,
 sui_tp_insured,(PROV-REV)PROVISION_AMT, paid, ((PROV-REV)-PAID)OUTSTANDING
 FROM(
 SELECT A.sui_int_claim_no,sui_vehicleno,sui_tp_insured,SUI_CLAIMENT_NAME,SUI_POLICY_NO,sui_int_date_loss,NVL((select sum(nvl(a.prd_value,0))
 from cl_t_provision_dtls a
 where a.prd_claim_no=sui_int_claim_no),0)PROV,NVL((select sum(nvl(a.rrd_value,0)) 
 from CL_T_PROV_REVISION_DTLS a
 where a.rrd_claim_no=sui_int_claim_no),0)REV,NVL((select sum(nvl(a.cre_paid_amount,0))
 from ac_t_central_requi a
 where a.cre_cen_claim_no=sui_int_claim_no
 and a.cre_acc_paid_status='Y'),0)PAID
 FROM cl_t_super_intimation a
 WHERE sui_super_claim_no IN (SELECT V.sui_super_claim_no
 FROM cl_t_super_intimation V
 WHERE V.sui_vehicleno='$vehino'
 AND V.sui_exp_code='MCC'
 AND V.sui_at_fault='Y')
 AND sui_vehicleno='$vehino'
 ORDER BY sui_int_claim_no,sui_int_date_loss)";
 $stmthis=ociparse($conn,$sqlhis);
 ociexecute($stmthis);

 while($row=oci_fetch_assoc($stmthis )){
  $dateloss=$row['SUI_INT_DATE_LOSS'];
  $clmNumber=$row['SUI_INT_CLAIM_NO'];
  $claimentname=$row['SUI_CLAIMENT_NAME'];
  $atfault="AT FAULT";

                  
                  ?>
             <tr>
        
        <td><?php echo $dateloss;?></td>
        <td><?php echo $claimentname;?></td>
        <td><?php echo $atfault;?></td>
        
      </tr>


            <?php } ?>
              
             
               </table>
             </div>
         
           </div>
        
 
         </div>



         <div class="col-xs-4">
        
      
        
        

      </div>
      <!-- /.row -->

   
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  

  
            
    </section>
    <!-- /.content -->


</div>  
<div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" id="closemodal" data-dismiss="modal">Close</button>
                <button type="button" class="btn-dwl btn btn-outline pull-left"  id="download">Generate To PDF</button>
                <button type="button" class="btn-save btn btn-outline" id="save">Update Quotation</button>
              </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script type="text/javascript">
	
 


   document.getElementById("download")
       .addEventListener("click", () => {
           const invoice = this.document.getElementById("invoice");
           console.log(invoice);
           console.log(window);
           var opt = {
               margin: 1,
               filename: 'Quotation For <?php echo $custname ?>.pdf',
               image: { type: 'jpeg', quality: 0.98 },
               html2canvas: { scale: 2 ,dpi: 95, width:1080 , height:1485},
               jsPDF: { unit: 'cm', format: 'a4', orientation: 'portrait' },
               //pagebreak:    { mode: ['avoid-all', 'css'] }
           };
           html2pdf().from(invoice).set(opt).save();
       })





  $(document).ready(function(){
$('#save').click(function(){


  var quo_seq = $('#quo_seq').val();
  var bus_id = $('#bus_id').val();
  var cus_id = $('#cus_id').val();
  var yom = $('#yom').val();
  var capacity = $('#capacity').val();
  var suminsured = $('#suminsured').val();
  var fuel_type =  $('#fuel_type').val();
  var engineno = $('#engineno').val();
  var chassis = $('#chassis').val();
  var mileage = $('#mileage').val();
  var start_date =  $('#start_date').val();
  var end_date = $('#end_date').val();
  var modeldesc = $('#modeldesc').val();
  var model_code = $('#model_code').val();
  var no_days = $('#no_days').val();
  var seating_capacity = $('#seating_capacity').val();
  var original_regist = $('#original_regist').val();
  var mts_regist_date = $('#mts_regist_date').val();
  var towing = $('#towing').val();
  var condition_desc = $('#condition_desc').val();
  var criticall = $('#criticall').val();
  var kilotwat = $('#kilotwat').val();
  var medical = $('#medical').val();
  var pol_sts= $('#policy_sts').val();  
  var total_prm = $('#total_prm').val();


                        $.ajax({
                        url: 'process_update_quotation.php',
                        type: 'POST',
                        data: {
                          
                          quo_seq: quo_seq,
                          bus_id : bus_id,
                          cus_id:cus_id,
                          yom:yom,
                          capacity:capacity,
                          suminsured:suminsured,
                          fuel_type:fuel_type,
                          engineno:engineno,
                          chassis:chassis,
                          mileage:mileage,
                          start_date:start_date,
                          end_date:end_date,
                          modeldesc:modeldesc,
                          model_code:model_code,
                          no_days:no_days,
                          seating_capacity:seating_capacity,
                          original_regist:original_regist,
                          mts_regist_date:mts_regist_date,
                          towing:towing,
                          condition_desc:condition_desc,
                          criticall:criticall,
                          kilotwat:kilotwat,
                          medical:medical,
                          pol_sts:pol_sts,
                          total_prm:total_prm

                        },

      
                         
                      
                     success: function (response) {
                      //alert(response);
                      
                    if(response==1){
                    jQuery(function validation(){
                    swal({
                    title: "Update",
                    text: "Quotation Updated Succesfully ",
                    icon: "success",
                    button: "Ok",
                     });

                     });
                     $(document).ready(function(){
                        $('#save').click(function(){

                          
                        });
                      });
                      
                    }

                  
                     
                     
                     if(response==2){
                      jQuery(function validation(){
                     swal({
                     title: "Not Updated",
                     text: "Could Not Update Quotation",
                     icon: "error",
                     button: "Ok",
                      });
                      });
                     } 

    
                 
                    }
                    
                    
                  
                      }); 
                     
                      
                });
              });

// -------------------- END ------------------------------------


</script>




      
