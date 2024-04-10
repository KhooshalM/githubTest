<?php
include_once('connectdb.php');
error_reporting(0);
session_start();
$me_code=$_SESSION['me_code'];
$user=$_SESSION['me_fname'];
$brn=$_SESSION['me_brn']; 
$cusotmer_id=$_POST['cus_id'];
$ref_id=$_POST['ref_id'];

//echo $ref_id;

// SQL TO GET REFERAL NAME BY REFERAL ID 
// GET REFERAL ID TO CHECK CUSTOMER
$sql="SELECT * FROM me_m_customers WHERE mmc_id='$ref_id'";

$result=oci_parse($conn,$sql);
oci_execute($result);
while($row=oci_fetch_assoc($result))

{
    $fname=$row['MMC_FIRSTNAME'];
    $surname=$row['MMC_SURNAME'];

   // echo  $fname;
}
//END


//CUSTOMER ID TO GET FIRSTNAME AND LASTNAME OF CUSTOMER  
$sqlcus="SELECT * FROM me_m_customers WHERE mmc_id='$cusotmer_id'";

$resultcus=oci_parse($conn,$sqlcus);
oci_execute($resultcus);
while($row=oci_fetch_assoc($resultcus))

{
    $fnamecus=$row['MMC_FIRSTNAME'];
    $surnamecus=$row['MMC_SURNAME'];

   
}







?>


<center> CUSTOMER NAME  :- <?php echo $fnamecus .' '. $surnamecus  ?></center>


<center>REFERED BY :- <?php echo $fname .' '. $surname  ?></center>


<br> <br>


<?php  
$sqlref="SELECT COUNT (mmc_ref_id)total_refered
  FROM me_m_customers a
  where mmc_ref_id='$cusotmer_id'";

$ref=oci_parse($conn,$sqlref);
oci_execute($ref);
while($row=oci_fetch_assoc($ref))
{

$total=$row['TOTAL_REFERED'];

}


?>
<center>TOTAL PEOPLE REFERED :-  <?php echo $total; ?></center>
<br>

                    <table id="salesreporttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                
                                <th>Mobile No</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $refered="SELECT * FROM me_m_customers a
                            where mmc_ref_id='$cusotmer_id'";

                            $stmt=oci_parse($conn,$refered);
                            oci_execute($stmt);
                            while($row=oci_fetch_assoc($stmt))
                            {

                            
                                $title=$row['MMC_TITLE'];
                                $fname=$row['MMC_FIRSTNAME'];
                                $surname=$row['MMC_SURNAME'];
                                $mobno=$row['MMC_MOBILENO'];

                            


                                        ?>

                              <tr>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $fname; ?></td>
                                <td><?php echo $surname; ?></td>
                                
                                <td><?php echo $mobno; ?></td>
                              </tr>
                              <?php  } ?>
                        </tbody>
                    </table>