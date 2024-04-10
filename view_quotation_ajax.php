<?php
include_once('connectdb.php');
session_start();
$quo_seq=$_POST['quo_seq'];
//echo $quo_seq;
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 



$sql="SELECT  a.mtq_quo_seq,

a.mtb_seq,
b.mtb_vehi_no,b.mtb_class,b.mtb_product,b.me_code,
c.mmc_firstname ||' '|| c.mmc_surname AS CUSNAME,c.mmc_phoneno,c.mmc_mobileno,
c.mmc_address1,c.mmc_address2,c.mmc_address3,c.mmc_city,c.mmc_title,c.mmc_nicno,
a.mmc_id, a.mtq_sum_ins, a.mtq_yom,

a.mtq_capacity, a.mtq_fuel_type, a.mtq_mileage, a.mtq_chassis,
a.mtq_engine, a.mtq_make_model,
(SELECT rft_description from cm_r_reference_two where rft_code=mtq_make_model)AS MAKEMODEL,




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
and a.mtq_quo_seq='$quo_seq'";



$result=oci_parse($conn,$sql);
oci_execute($result);
 while($row=oci_fetch_assoc($result)){

$quo_id=$row['MTQ_QUO_SEQ'];
$bus_id=$row['MTB_SEQ'];
$cus_id=$row['MMC_ID'];
$custname=$row['CUSNAME'];
$phoneno=$row['MMC_PHONENO'];
$mobno=$row['MMC_MOBILENO'];
$vehino=$row['MTB_VEHI_NO'];
$class=$row['MTB_CLASS'];
$address1=$row['MMC_ADDRESS1'];
$address2=$row['MMC_ADDRESS2'];
$address3=$row['MMC_ADDRESS3'];
$city=$row['MMC_CITY'];
$title=$row['MMC_TITLE'];
$nic=$row['MMC_NICNO'];
//echo $class;
//echo "<br>";

$prod_code=$row['MTB_PRODUCT'];


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
//$total_prm=$row['MTQ_TOT_PRM'];
$mtq_quo_status=$row['MTQ_QUO_STATUS'];
$mtq_uw_status=$row['MTQ_UW_STATUS'];
$created_date=$row['CREATED_DATE'];
$created_by=$row['CREATED_BY'];
$modified_date=$row['MODIFIED_DATE'];
$modified_by=$row['MODIFIED_BY'];
$kilowat=$row['MTQ_KW'];

$me_name=$row['ME_NAME'];
$sfc_email1=$row['SFC_EMAIL1'];
$sfc_mobile1=$row['SFC_MOBILE1'];
$sfc_brn=$row['SFC_BRN_CODE'];
$me_desig=$row['DESIG'];





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
//echo $tl;





?>
  

  
      
    <?php
  //  echo $prod_code;

     $sqlprod="SELECT prd_code,prd_cla_code,INITCAP(prd_description)PRDDESC FROM uw_m_products WHERE prd_code='$prod_code' AND  prd_status='Y'";
     $sticode = oci_parse($conn,$sqlprod);
     oci_execute($sticode);
     
     if($row=oci_fetch_assoc($sticode)){
         $descode=$row['PRDDESC'];
      //echo $descode;
       //ech
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


 <!-- Main content -->
 <section class="invoice">

 





 <div class="" style="margin-bottom: 0!important;">
                 
                 <img src="dist/img/LOGO-PHOENIX_INS.png" width="300" height="100">
      
         </div>
           <div class="col-xs-12">

           <br>

       
           </div>
           <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-gray">
        
              <!-- /.widget-user-image -->
              <center> <h4 class="modal-title"><b>Quotation For   <?php  echo $clasdesc.' - '.$descode; ?></b></h4></center>
             
            </div>
           
          </div>
          <!-- /.widget-user -->
        </div>
 
</div>

<br> <br>



 <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="row">
        <div class="col-md-4">
          <div>
            <div>
             <!-- <i class="fa fa-text-width"></i>-->

              <h4 class="text-yellow"><b>Customer Details</b></h4> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         



              <table  style="width:100%">
                  
                  <tr>
                    <td class="text-info">Customer Name</th>
                    <td>: </th>
                    <td> &nbsp; <b><?php echo $title.' '.$custname; ?> </b> </td>
                </tr>
                
                <tr>
                    <td class="text-info">City</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $city; ?>  </td>
                </tr>
                <tr>
                    <td class="text-info">Mobile No</th>
                    <td>: </th>
                    <td> &nbsp;  <?php echo $mobno; ?>  </td>
                </tr>
                <tr>
                    <td class="text-info">Phone No</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $phoneno; ?>   </td>
                </tr>
              </table>


              <table  style="width:100%">
                <tr>


                <td>  <h4 class="text-yellow"><b>Cover Details</b></h4> </td>

                </tr>
                <tr>
                    <td class="text-info">Class</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $clasdesc?> </td>
                </tr>
                <tr>
                    <td class="text-info">Product</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $descode?> </td>
                </tr>





                <tr>
                    <td class="text-info">Period</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $start_date; ?> -    <?php echo $end_date; ?> </td>
                </tr>


                <tr>
                    <td class="text-info">Days</th>
                    <td>: </th>
                    <td> &nbsp;  <?php echo $no_days; ?>   </td>
                </tr>


                <tr>
                    <td class="text-info">Sum Insured</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo number_format($suminsured); ?>  </td>
                </tr>

                <tr>
                    <td class="text-info">Seating Capacity</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $seating_capacity; ?>  </td>
                </tr>
               
                <tr>
                    <td class="text-info">Quotation No</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $quo_id ?> </td>
                </tr>
               
                </table>
               


            </div>
            <!-- /.box-body -->




                                                                                                                                           


          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <div>
            <div>
              <!-- <i class="fa fa-text-width"></i> -->

              <h4 class="text-yellow"><b>Vehicle Details</b></h4> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          

            <table  style="width:100%">
                  
                  <tr>
                    <td class="text-info">Vehicle No</th>
                    <td>: </th>
                    <td> &nbsp; <b><?php echo $vehino; ?> </b> </td>
                </tr>
                <tr>
                    <td class="text-info">Year of Make.</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $yearofmake; ?>  </td>
                </tr>
                <tr>
                    <td class="text-info">CC Capacity</th>
                    <td>: </th>
                    <td> &nbsp; <?php echo $capacity; ?>  </td>
                </tr>
                <tr>
                    <td class="text-info">Fuel Type</th>
                    <td>: </th>
                    <td> &nbsp; <?php if($fuel_type=="05ELE"){ echo "ELECTRIC"; } else { echo $fuel_type;}   ?>   </td>
                </tr>
                <tr>
                    <td class="text-info">Engine No</th>
                    <td>: </th>
                    <td> &nbsp; <?php  echo $engineno;?>   </td>
                </tr>
                <tr>
                    <td class="text-info">Chassis No</th>
                    <td>: </th>
                    <td> &nbsp; <?php  echo $chassis;?>   </td>
                </tr>
                <tr>
                    <td class="text-info">Make And Model</th>
                    <td>: </th>
                    <td> &nbsp; <?php  echo $modeldesc;?>  </td>
                </tr>
                <tr>
                    <td class="text-info">Original Registration Date</th>
                    <td>: </th>
                    <td> &nbsp;<?php  echo $original_regist;?>   </td>
                </tr>
                <tr>
                    <td class="text-info">Original Mauritius Date</th>
                    <td>: </th>
                    <td> &nbsp;  <?php  echo $mts_regist_date;?>  </td>
                </tr>
                <tr>
                    <td class="text-info">Condition</th>
                    <td>: </th>
                    <td> &nbsp; <?php  echo $condition_desc;   ?>   </td>
                </tr>


                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <div>
            <div>
             <!-- <i class="fa fa-text-width"></i>-->

              <h4 class="text-yellow"><b>ME / AGENT Details</b></h4> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          
         <table  style="width:100%">
  
       <tr>
         <td class="text-info">NAME</th>
         <td>: </th>
         <td> &nbsp; <b><?php echo $me_name; ?></b>  </td>
      </tr>
      <tr>
         <td class="text-info">Phone No.</th>
         <td>: </th>
         <td> &nbsp; <?php echo $sfc_mobile1; ?> </td>
      </tr>
      <tr>
         <td class="text-info">Email</th>
         <td>: </th>
         <td> &nbsp; <?php echo $sfc_email1; ?>  </td>
      </tr>
      <tr>
         <td class="text-info"> Branch</th>
         <td>: </th>
         <td> &nbsp; <?php echo $sfc_brn; ?>  </td>
      </tr>
      <tr>
         <td class="text-info"> Designation</th>
         <td>: </th>
         <td> &nbsp; <?php echo $me_desig; ?>  </td>
      </tr>
      <tr>
         <td class="text-info"> Generated Date</th>
         <td>: </th>
         <td> &nbsp; <?php echo $modified_date; ?>  </td>
      </tr>


    </table>
   

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        




      </div>
      <!-- /.row -->
  

      <br>    
    <div class="callout bg-yellow disabled color-palette" style="margin-bottom: 0!important;">
      <span>
      <center>
      
      <h3> Premium    <b>  MUR  <?php echo  number_format($total_prm);?></b></h3> <h5> <b>Inclusive policy fee and FSC fees </b></h5> 
      </center>
      </span>
    </div>
 <br>
     
   
   
  
        <!-- ./col -->
 
          <div class="box box-solid">
            <div class="box-header with-border">
              <!-- <i class="fa fa-text-width"></i> -->

              <h3 class="box-title text-yellow"><b>Cover Benefits</b></h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <ul class="list-styled">
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
              <li><?php echo $desc; ?></li>
              <?php } ?>
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
                  $code="'".implode("','",$a)."'";
                  //echo $code;
                $sqlben="SELECT * from me_r_prod_benefits where mpb_option='2'  AND mpb_peril IN ($code) AND mpb_prod_code='$prod_code'";
                $bfit = oci_parse($conn,$sqlben);
                oci_execute($bfit );
 
                  while($row=oci_fetch_assoc($bfit )){
                     $desc=$row['MPB_BENEFITS_DESC'];
                     $peril=$row['MPB_PERIL'];
                  
                    
                  
                  ?>

                <li><?php  echo $desc; ?></li>

                <?php } ?>


                <?php    
              if($war_status=="Y") { 
                echo "<li>Warranty Cover Available - Yes :  $schedule  </li>";
              } 
              
            
              elseif($war_status=="N") { 
                echo "<li> Warranty Cover  - Not Available  </li>";
              } 

             
               if($war_status=="") {
                echo "";
              }

              ?>

                <li><?php if($ctc !== "N"){ echo "<td>  $ctc</td>"; } ?></li>

            </ul>
            
            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
    
      
        <!-- ./col -->
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <h4 class="box-title text-yellow"><b>Terms And Condition</b></h4>
            <div class="box-body">
            <ul class="list-styled">
              <li>Quotation is valid for a period of 15 days.</li>
              <li>Final premium may change upon submission of proposal form by the proposer</li>
              <li>Surveys or Agent may need to inspect the vehicle.</li>
              <li>Required document - ID/Passport, Utility bills for proof of address (within three months), Deeds of sales, Certificate of Horsepower (HP), Driving Licence, Claims history for last three years, Certificate of incorporation and BRN( for a company ). </li>
              
            </ul>
            </div>
            <!-- /.box-body -->
          
      
        <!-- ./col -->


  <?php  }?>
    </section>
    <div class="clearfix"></div>

    
</section>
    <div class="modal-footer">
             
                <button type="button" class="btn btn-primary  pull-left"  id="download">Generate To PDF</button>
                
    </div>
     
     
      


  



  

              
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
  document.getElementById("download").addEventListener("click", function() {
    // Convert HTML to PDF
    const element = document.getElementById("invoice"); // Replace with the ID of the HTML element you want to convert
    const options = {
      filename: '<?php echo $custname ?>',
      jsPDF: {
        format: "a3",
        orientation: "portrait",
        unit: "cm",
        compressPDF: false,
        precision: 96,
        putOnlyUsedFonts: false,
        floatPrecision: 16
      }
    };
    html2pdf().set(options).from(element).save();
  });
</script>



