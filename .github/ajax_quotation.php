<?php
//echo "TEST";
include_once('connectdb.php');

//error_reporting(0);
session_start();




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
//echo $towing;
//echo "<br>";









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


//CAR TO CAR LOGIC FOR CONDITION IF NEW 
//ORIGINAL REGISTRATION DATE MUST BE 5 YEARS MINUS TODAY DATE


//IF CONDITION IF NEW DO THIS
$ctcnew="select ROUND(sysdate-to_date('$original_regist')) AS CTCNEW from dual";
$stidctc = oci_parse($conn,$ctcnew);
oci_execute($stidctc);
if($row=oci_fetch_assoc($stidctc)){
	$ctcoriginaldate=$row['CTCNEW'];
//echo $ctcoriginaldate;
//
 } 
 

 //echo $mts_regist_date;

//IF CONDITION IF SECOND HAND DO THIS
 $ctcmts="select ROUND(sysdate-to_date('$mts_regist_date')) AS CTCMTS from dual";
 $stidmts = oci_parse($conn,$ctcmts);
 oci_execute($stidmts);
 if($row=oci_fetch_assoc($stidmts)){
	 $ctcmtsdate=$row['CTCMTS'];
 //echo $ctcmtsdate;
 //
	} 


$user=$_POST['user'];
$brn=$_POST['brn'];


 
//echo $brn;
//echo "<br>";

//IF PRODUCT_CODE 3A INCLUDE 3a_quote.php PAGE
if($prod_code=="3A"){
  include "3a_quote.php";
}

//IF PRODUCT_CODE 1A INCLUDE 1a_quote.php PAGE
if($prod_code=="1A"){
  include "1a_quote.php";
}


//IF PRODUCT_CODE 1C INCLUDE 1c_quote.php PAGE
if($prod_code=="1C"){
  include "1c_quote.php";
}





//TOTAL PREMIUM FOR QUOTATION 
//$total=$prm+$ext_prm+$towing_prm+$cri_med+$others_prm+$pol_fees+$pass_fees+$add_load+$vip;
//echo "<br>";
//echo $total;





//END

?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
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

    
<!--
    <section class="invoice" id="invoice">
    <h3>Quotation For <?php echo $clasdesc .' - '. $descode?></h3>
     
      <div class="row">
        <div class="col-xs-9">
          <h2 class="page-header">
           
          </h2>
        </div>
       
      </div>

    

  
      <div class="row">
        <div class="col-xs-6 table-responsive">
       
        </div>
      
      </div>
     

      <div class="row-xs-9">
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <b><h4> Customer Details</b> </h4> 
            
              Owner :-    &nbsp;   <?php echo $custname; ?>  <br>
              Phone No :-   &nbsp;   <?php echo $phoneno; ?> <br>
             Mobile No :-  &nbsp;  <?php echo $mobno; ?>  <br>
            Vehicle No :-  &nbsp;  <?php echo $vehino; ?>  <br>
            Sum Insured :-  &nbsp;  Rs. &nbsp; <?php echo number_format($suminsured); ?>  <br>
            Period of Cover : &nbsp; From :- &nbsp; <?php echo $start_date; ?> &nbsp;  To :- <?php  echo $end_date     ?> <br>
           Days  :- &nbsp; <?php echo $dif_period; ?> <br>
					 Mauritius Registration Date :- &nbsp; <?php echo $mts_regist_date; ?> <br>
        </div>
        
        <div class="col-sm-4 invoice-col">
        <b> <h4>Vehicle Details</b> </h4>
          
          Year Of Make:</b>&nbsp;   <?php echo $yearofmake; ?>  <br>
          CC Capacity:</b> <?php echo $capacity; ?><br>
          Fuel Type:</b> <?php echo $fuel_type; ?><br>
          Engine No :-  &nbsp;  <?php echo $engineno; ?>  <br>
          Chassis Number :-  &nbsp;  <?php echo $chassis; ?>  <br>
					
					
        



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
          Make & Model :- &nbsp;  <?php echo $modeldesc; ; ?>  <br>
          Seating Capacity :- &nbsp;  <?php echo $seating_capacity; ?>  <br>
					Original Registration Date :- &nbsp; <?php echo $original_regist; ?> <br>
        </div>
        
       
        <div class="col-sm-4 invoice-col">
        <b> <h4>Additional Details</b> </h4>

        <?php ///if($towing=="Y"){ echo "Towing  :- &nbsp;   YES  <br>";} else { echo "Towing  :- &nbsp;   NOT ADDED  <br>"; } ?>


        <?php //if($medical=="Y" && $dif_period > 180){ echo "Medical  :- &nbsp;   YES  <br>";} else { echo "Medical  :- &nbsp;   NOT ADDED  <br>"; } ?>

        
        <?php //if($criticall=="Y" && $dif_period > 180){ echo "Critical Illness  :- &nbsp;   YES  <br>";} else { echo "Critical Illness  :- &nbsp;   NOT ADDED  <br>"; } ?>  
           

				Condition :- &nbsp;  <?php echo $condition_desc; ; ?>  <br>

        </div>
        
     
      </div>
-->
 <!-- /.box-header -->
 <div class="box-body">
              <table class="table table-condensed">
                <tr>
                  <th colspan="3" >Customer Details</th>
                  
                  <th colspan="3" >Vehicle Details</th>
                  
                </tr>
                <tr>
                    <td>Owner</th>
                    <td>:</th>
                    <td><b><?php echo $custname; ?> </b> </td>
                    <td>Year Of Make</th>
                    <td>:</th>
                    <td><b><?php echo $yearofmake; ?></b> </td>
                   
                </tr>
                <tr>
                    <td>Phone No</th>
                    <td>:</th>
                    <td><b><?php echo $phoneno; ?> </b></td>
                    <td>CC Capacity</th>
                    <td>:</th>
                    <td><b><?php echo $capacity; ?></b> </td>
                  
                </tr>            
                <tr>
                    <td>Mobile No</th>
                    <td>:</th>
                    <td><b><?php echo $mobno; ?></b></td>
                    <td>Fuel Type</th>
                    <td>:</th>
                    <td><b><?php echo $fuel_type; ?></b></td>
                   
                </tr>
                <tr>
                    <td>Vehicle No</th>
                    <td>:</th>
                    <td><b><?php echo $vehino; ?></b></td>
                    <td>Engine No</th>
                    <td>:</th>
                    <td><b><?php echo $engineno; ?></b></td>
                   
                </tr>
                <tr>
                    <td>Sum Insured </th>
                    <td>:</th>
                    <td> <b><?php echo number_format($suminsured); ?></b></td>
                    <td>Chassis Number </th>
                    <td>:</th>
                    <td><b> <?php echo $chassis; ?></b></td>
                   
                </tr>
              
                <tr>
                    <td>Period of Cover </th>
                    <td>:</th>
                    <td><b> From  <?php echo $start_date; ?> </b>- To :<b> <?php echo $end_date; ?> </b> </td>
                    <td>Make & Model </th>
                    <td>:</th>
                    <td> <b><?php echo $modeldesc; ?></b></td>
                </tr>
            
                <tr>
                    <td>Days</th>
                    <td>:</th>
                    <td> <b><?php echo $no_days; ?> </b></td>  
                    <td>Seating Capacity</th>
                    <td>:</th>
                    <td><b> <?php echo $seating_capacity; ?> </b></td>
                </tr>
                <tr>
                    <td> Mauritius Registration Date</th>
                    <td>:</th>
                    <td><b> <?php echo $mts_regist_date; ?> </b></td>
                    <td> Original Registration Date </th>
                    <td>:</th>
                    <td> <b><?php echo $original_regist; ?></b> </td>
                </tr>
              
                <tr>
                <th>Additional Details</th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
                
                <tr>
                <td>Towing</th>
                    <td>:</th>
                    <td> <b> <?php if($towing=="Y"){ echo "YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b>
                   </td>
                   <td>Medical</th>
                    <td>:</th>
                    <td> <b><?php if($medical=="Y" && $no_days > 180){ echo "YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b> </td>

                </tr>
              

                <tr>
                <td>Criticall</th>
                    <td>:</th>
                    <td> <b>  <?php if($criticall=="Y" && $no_days > 180){ echo " YES  <br>";} else { echo "NOT ADDED  <br>"; } ?></b>  </td>
                    <td>Condition</th>
                    <td>:</th>
                    <td><b><?php echo $condition_desc; ?></b></td>
                </tr>
                  
              </table>
            </div>
     
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
                echo "<td> Warranty Cover Available - $schedule  </td>";
              } 
              
            
              elseif($war_status=="N") { 
                echo "<td> Warranty Cover  - Not Available  </td>";
              } 


              else { echo  "<td> Warranty Cover  <br>    $war_status  </td>";}
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










        
        

      </div>
      <!-- /.row -->

   
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  

                                
        
   
   
            
    </section>
    <!-- /.content -->



 
    




</div>