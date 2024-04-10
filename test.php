<script src="Chart.js-2.8.0/dist/Chart.min.js"></script>
<?php
session_start();
include_once('connectdb.php');

$select ="SELECT to_char(a.trn_date,'YYYY-MM-DD') as trn_date, sum(round(cp)) as tot_prem
FROM mv_uw_pol_new a
WHERE  TO_CHAR(A.trn_date,'YYYYMMDD')BETWEEN to_char(TRUNC(SYSDATE, 'MM'),'YYYYMMDD') and to_char(LAST_DAY(SYSDATE),'YYYYMMDD')
AND a.pol_type IN ('N','R','A','F')
AND A.pol_slc_brn_code NOT IN ('CT','AG00','HO','CICL')
AND A.pol_type <> 'S'
and pol_marketing_executive_code='11354'
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


<canvas id="earningbydate" style="height:250px;"></canvas>

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

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>