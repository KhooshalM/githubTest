<?php 
include_once('connectdb.php');
//error_reporting(0);
session_start();
$pol=$_POST['polno'];
$me=$_SESSION['me_code'];
//echo $pol;
$sqlname="SELECT    (cus_indv_other_names||' '||cus_indv_surname)cus_name
FROM uw_m_customers b,uw_t_pol_risks b,sm_m_sales_force b,uw_m_cust_addresses b,uw_t_policies

WHERE pol_cus_code=cus_code
AND prs_plc_pol_seq_no=POL_SEQ_NO
AND sfc_code=pol_marketing_executive_code
AND sfc_code=pol_marketing_executive_code
AND adr_seq_no=pol_adr_seq_no

AND pol_policy_no ='$pol'";
 $result=oci_parse($conn,$sqlname);
 oci_execute($result);
 while($row=oci_fetch_assoc($result))

 {
  $cus_name=$row['CUS_NAME'];
 }

?>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
       

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i>Search for Contact.</h3>

          <p>
            Search for Contact . If Contact is Available , Please Proceed to create the Business<?php /* echo $pol; */?>
           <br> <br>

            Type The Name And Press Enter to Search if Contact already Available  <br> <b> <?php /*echo $cus_name; */ ?></b>
             
            
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" id="search" name="search" class="form-control" placeholder="Search"  value="<?php echo $cus_name;?>">
              <input type="hidden" value="<?php echo $pol ?>" id="pol">

              <div class="input-group-btn">
                <button class="btn btn-search btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->


      <div class="result">
                 
      </div>

    </section>

  


<script>
$(document).on("click", ".btn-search", function(){

  
  event.preventDefault();
  var search = $('#search').val();
  //alert(search);

  $(document).ready(function(){
        // fetch data from table without reload/refresh page
       
        function loadData(query,pol){
          $.ajax({
            url : "search_cus.php",
            type: "POST",
            data:{query:query,pol:pol},
            success:function(response){
              $(".result").html(response);
            }
          });  
        }

        
        // live search data from table without reload/refresh page
        $("#search").keyup(function()
        {
          var search = $(this).val();
          var pol= $('#pol').val();
          //alert(pol);
          if (search !="") {
            loadData(search,pol);
          }
        });
    });
      
  });


                      
              

  /*
    var cus_id = $('#title').val();
    var fname = $('#fname').val();
    var surname = $('#surname').val();
    var phoneno = $('#phoneno').val();
    var mobno = $('#mobno').val();
    var nic = $('#nic').val();
    var email = $('#email').val();
    var city = $('#city').val();
    var adr1 = $('#adr1').val();
    var adr2 = $('#adr2').val();
    var adr3 = $('#adr3').val();
    var district = $('#district').val();
    var occupation = $('#occupation').val();
    var source_of_fund = $('#source_of_fund').val();

        $.ajax({
        url: 'process_renewal_cus.php',
          type: 'post',
           data: {
             pol: pol,
             
             

                },
                cache: false,
                success: function (data) {
                 $('#message').html(data);
               // setTimeout(function(){location.href="daily_act.php"} , 1000);
                 $("#modal-default").modal('hide');
                   location.reload();
                   }   
                
                  });
                      
                 
*/
                  
   




</script>
               