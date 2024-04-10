
<?php
include_once('connectdb.php');
session_start();
if ($_SESSION['me_code']=="")
{
  header('location:index.php');
}
$me_code=$_SESSION['me_code'];
$newsql="SELECT count(a.pol_policy_no) as new_pol, sum(cp) as new_premium
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('N')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='$me_code'
AND A.ref_no IS NOT NULL";

$result_new=oci_parse($conn,$newsql);
oci_execute($result_new);

if($new_values=oci_fetch_assoc($result_new)){

  $new_pol=$new_values['NEW_POL'];
  $new_premium=$new_values['NEW_PREMIUM'];
}

$rensql="SELECT count(a.pol_policy_no) as new_pol, sum(cp) as new_premium
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('R')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='$me_code'
AND A.ref_no IS NOT NULL";

$result_ren=oci_parse($conn,$rensql);
oci_execute($result_ren);

if($new_values=oci_fetch_assoc($result_ren)){

  $ren_pol=$new_values['NEW_POL'];
  $ren_premium=$new_values['NEW_PREMIUM'];
}


$ensql="SELECT count(a.pol_policy_no) as new_pol, sum(cp) as new_premium
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('A')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='$me_code'
AND A.ref_no IS NOT NULL";

$result_en=oci_parse($conn,$ensql);
oci_execute($result_en);

if($new_values=oci_fetch_assoc($result_en)){

  $en_pol=$new_values['NEW_POL'];
  $en_premium=$new_values['NEW_PREMIUM'];
}

$cansql="SELECT count(a.pol_policy_no) as new_pol, sum(cp) as new_premium
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('F')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='$me_code'
AND A.ref_no IS NOT NULL";

$result_can=oci_parse($conn,$cansql);
oci_execute($result_can);

if($new_values=oci_fetch_assoc($result_can)){

  $can_pol=$new_values['NEW_POL'];
  $can_premium=$new_values['NEW_PREMIUM'];
}



$select ="SELECT to_char(a.trn_date,'YYYY-MM-DD') as trn_date, sum(cp) as tot_prem
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('N','R','A','F')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='$me_code'
AND A.ref_no IS NOT NULL
group by a.trn_date
order by trn_date asc";
                        
                        $result_prem=oci_parse($conn,$select);
                        oci_execute($result_prem);

                            $ttl=[];
                            $date=[];
                            while($row=oci_fetch_assoc($result_prem))
                            {
                               
                                $ttl[]=$row['TOT_PREM'];
                                $date[]=$row['TRN_DATE'];
                            }
                           


?>


<?php include_once('header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

<div class="box-body">
    
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo 'Rs '.number_format($new_premium,2); ?></h3>

              <p>New Policies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">No of Policies <i class="fa fa-arrow-circle-right"></i><b><?php echo ' '.$new_pol; ?></b></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo 'Rs '.number_format($ren_premium,2); ?><sup style="font-size: 20px"></sup></h3>

              <p>Renewal Policies</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">No of Polices <i class="fa fa-arrow-circle-right"></i><b><?php echo ' '.$ren_pol; ?></b></a>
          </div>
        </div>
        <!-- ./col -->



        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo 'Rs '.number_format($en_premium,2); ?></h3>

              <p>Endorsements</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">No of Polices <i class="fa fa-arrow-circle-right"></i><b><?php echo ' '.$en_pol; ?></b></a>
          </div>
        </div>
        <!-- ./col -->

        

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo 'Rs '.number_format($can_premium,2); ?></h3>

              <p>Cancellations</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">No of Polices <i class="fa fa-arrow-circle-right"></i><b><?php echo ' '.$can_pol; ?></b></a>
          </div>
        </div>
        <!-- ./col -->
      </div>


    
      <div class="box box-warning">
        <div class="box-header with-border">
                <h3 class="box-title">Premium By Date</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
            <div class="chart">            
            <canvas id="earningbydate" style="height:250px;"></canvas>
             </div>
          </div>
      </div>

<div class="row">
  <div class="col-md-6">

  <div class="box box-info">
        <div class="box-header with-border">
                <h3 class="box-title">Non Renewed Policies</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

     
      </div>

  </div>
  <div class="col-md-6">
  <div class="box box-info">
        <div class="box-header with-border">
                <h3 class="box-title">Premium Comparison</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

          
      </div>

  </div>

      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
var ctx = document.getElementById('earningbydate').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo json_encode($date); ?>,
        datasets: [{
            label: 'Total Premium',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($ttl); ?>
        }]
    },

    // Configuration options go here
    options: {}
});
</script>


<!--<script>
  $(document).ready( function () {
    $('#bestsellingproductlist').DataTable({
       
    });
} );
</script>

<script>
  $(document).ready( function () {
    $('#orderlisttable').DataTable({
        "order":[[0,"desc"]]
    });
} );
</script>-->
 
  <?php include_once('footer.php'); ?>