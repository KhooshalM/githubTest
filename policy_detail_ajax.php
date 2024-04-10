<?php
include_once('connectdb.php');
session_start();


$polno=$_POST['polno'];
$polseq=$_POST['polseq'];
$bus_id=$_POST['bus_id'];
$cus_id=$_POST['cusid'];


//echo $polno;
//echo "<br>";
//echo $polseq;

$sql="select  * 
from(
SELECT   deb_trn_date,deb_deb_note_no,deb_policy_no,piml_premium.veh_num(deb_policy_no)Risk,
deb_pol_period_from,deb_pol_period_to,deb_prepared_by,deb_total_amount,
(SELECT pcb_percentage
  FROM uw_t_pol_com_breakup a
  where pcb_pcm_pol_seq_no=deb_pol_seq_no)per_com,
  deb_tit_code,deb_cus_full_name,
deb_cus_addr_line_1,deb_cus_addr_line_2,deb_cus_addr_line_3
  FROM rc_t_debit_note a
  where  deb_pol_seq_no='$polseq'

  union all
  
SELECT 
drc_trn_date,
drc_dir_rec_no,
drc_policy_no,
piml_premium.veh_num(drc_policy_no)Risk,
drc_pol_period_from,
drc_pol_period_to,
drc_prepared_by,
drc_total_amount,
(SELECT pcb_percentage
  FROM uw_t_pol_com_breakup a
  where pcb_pcm_pol_seq_no=drc_pol_seq_no)per_com,
drc_tit_code,
drc_cus_full_name,
drc_cus_addr_line_1,
drc_cus_addr_line_2,
drc_cus_addr_line_3
FROM rc_t_dir_receipt a
where drc_pol_seq_no='$polseq'
)";


$result=oci_parse($conn,$sql);
oci_execute($result);

if($row=oci_fetch_assoc($result))
{

    $deb_note=$row['DEB_DEB_NOTE_NO'];
    $deb_polno=$row['DEB_POLICY_NO'];
    $transaction_date=$row['DEB_TRN_DATE'];
    $vehno=$row['RISK'];
    $deb_pol_period_from=$row['DEB_POL_PERIOD_FROM'];
    $deb_pol_period_to=$row['DEB_POL_PERIOD_TO'];
    $deb_prepared_by=$row['DEB_PREPARED_BY'];
    $deb_total_amount=$row['DEB_TOTAL_AMOUNT'];
    $per_com=$row['PER_COM'];
    $deb_tit_code=$row['DEB_TIT_CODE'];
    $deb_cus_full_name=$row['DEB_CUS_FULL_NAME'];
    $deb_cus_addr_line_1=$row['DEB_CUS_ADDR_LINE_1'];
    $deb_cus_addr_line_2=$row['DEB_CUS_ADDR_LINE_2'];
    $deb_cus_addr_line_3=$row['DEB_CUS_ADDR_LINE_3'];

    

    
}


?>

    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-hover">
           


                <tr>
                    <td class="text-info">Owner</th>
                    <td>:</th>
                    <td><b><?php echo $deb_tit_code.' '.$deb_cus_full_name; ?> </b> </td>


                    <td class="text-info">Vehicle No</th>
                    <td>:</th>
                    <td><b><?php echo $vehno; ?></b> </td>
                   
                </tr>
                <tr>

                    <td class="text-info">Address</th>
                    <td>:</th>
                    <td><b><?php echo  $deb_cus_addr_line_1 .' '. $deb_cus_addr_line_2 .' '. $deb_cus_addr_line_3 ?> </b></td>
                    <td class="text-info">Transaction Date</th>
                    <td>:</th>
                    <td><b><?php echo $transaction_date ?></b> </td>
                    
                </tr>    
                  <tr>

                    <td class="text-info">Total Amount</th>
                    <td>:</th>
                    <td><b><?php echo $deb_total_amount ?> </b></td>
                    <td class="text-info">Policy Period</th>
                    <td>:</th>
                    <td><b><?php echo $deb_pol_period_from .' - '. $deb_pol_period_to ?></b> </td>
                    
                </tr>   
                <tr>

                    <td class="text-info">Policy Number</th>
                    <td>:</th>
                    <td><b><?php echo $deb_polno ?> </b></td>
                   
                    <td class="text-info">Commision</th>
                    <td>:</th>
                    <td><b><?php echo $per_com;  ?>%</b> </td>
                    
                </tr> 
                  <tr>

                    <td class="text-info">Debit / Receipt No.</th>
                    <td>:</th>
                    <td><b><?php echo $deb_note ?> </b></td>
                    <td class="text-info">Prepared By</th>
                    <td>:</th>
                    <td><b><?php echo $deb_prepared_by  ?></b> </td>
                    
                </tr> 
                    <input type="hidden" value="<?php echo $deb_polno ?>" id="pol_no"   >
                    <input type="hidden" value="<?php echo $polseq ?>" id="pol_seq"   >
                    <input type="hidden" value="<?php echo $cus_id ?>" id="cus_id"   >
                
                    </table>
                    
            </div>
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
           
          <div class="modal-footer">
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
                    where mf_pol_no='$deb_polno'";
                    $polresult=oci_parse($conn,$sqlchk);
                    oci_execute($polresult);
                    $row1=oci_fetch_assoc($polresult);      

                    $mfpolno=$row1['MF_POL_NO'];
                    $mfseq=$row1['MF_POL_SEQ'];
                   // echo $mfpolno;
                    
                      

                   if($mfpolno == ""){
                    echo "<button type='button'  class='btn-fin btn btn-success  pull-right' data-id='$bus_id'>Finalise</button>";
                   } 
                   else {
                   echo "";
                   }
                    
                    ?>
          
                   
          </div> 
        </div>
      </div>



<script>
$(document).on("click", ".btn-fin", function(){
  event.preventDefault();
            var polno = $('#pol_no').val();
           
            var polseq = $('#pol_seq').val();
            var cusid = $('#cus_id').val();
            var bus_id = $(this).data('id');
            //alert(bus_id);
                     
           
                        $.ajax({
                        url: 'policy_process.php',
                        type: 'post',
                        data: {
                          
                            polno: polno, 
                            polseq:polseq,
                            bus_id:bus_id,
                            cusid:cusid
                        
                        
                        },
                                          
                        success: function(response){ 
                        if(response == 1){
                       
                              jQuery(function validation(){
                                  swal({
                                  title: "Business Finalise ",
                                  text: "Business Finalise",
                                  icon: "success",
                                  button: "Ok",
                               });
                                });
                            
                                $("#modal-primary-pol").modal('hide');
                                setTimeout(function(){
                                   window.location.reload();
                             }, 2000);
                         }
                      
                      

                      }
                  
                      });
                     
                });


</script>








