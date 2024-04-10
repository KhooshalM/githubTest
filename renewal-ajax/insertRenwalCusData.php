<?php
include_once('../connectdb.php');
session_start();
$me = $_SESSION['me_code'];
$user = $_SESSION['me_fname'];
$brn = $_SESSION['me_brn'];
//$pol=$_POST["polno"];

$title = $_POST['title'];
$fname = strtoupper($_POST['fname']);
$surname = strtoupper($_POST['surname']);
$phoneno = $_POST['phoneno'];
$mobno = $_POST['mobno'];
$nic = strtoupper($_POST['nic']);
$email = strtoupper($_POST['email']);
$city = strtoupper($_POST['city']);
$adr1 = strtoupper($_POST['adr1']);
$adr2 = strtoupper($_POST['adr2']);
$adr3 = strtoupper($_POST['adr3']);
$district = strtoupper($_POST['district']);
$occupation = strtoupper($_POST['occupation']);
$source_of_fund = strtoupper($_POST['source_of_fund']);

$initialsFname = substr($fname, 0, 1);
$initialsLname = substr($surname, 0, 1);
$initials = $initialsFname . '.' . $initialsLname;

//echo"<script> 
//alert('$me'+'$user'+'$brn'+'$pol'+'$title'+'$fname'+'$surname'+'$phoneno'+'$mobno'+'$nic'
//+'$email'+'$city'+'$adr1'+'$adr2'+'$adr3'+'$district'+'$occupation'+'$source_of_fund'+'$initials');
//</script>";

// Check if the mobile number already exists

$check = "SELECT COUNT(*) AS num_rows FROM me_m_customers WHERE mmc_mecode = '$me' AND mmc_mobileno = '$mobno'";
$stmt = oci_parse($conn, $check);
oci_execute($stmt);
$row = oci_fetch_assoc($stmt);
$count = $row['NUM_ROWS'];

if ($count > 0) {
    // Mobile number already exists, inform the user
    echo '1';
} else {
    // Mobile number doesn't exist, proceed with insertion
    $insert = "INSERT INTO me_m_customers (
        mmc_surname,
        mmc_firstname,
        mmc_initials,
        mmc_title,
        mmc_nicno,
        mmc_mobileno,
        mmc_email,
        mmc_address1,
        mmc_address2,
        mmc_address3,
        mmc_city,
        mmc_district,
        mmc_business_occ,
        mmc_mecode,
        created_by,
        created_date,
        mmc_status,
        mmc_brn,
        mmc_source_of_fund)
    VALUES (
        '$surname',
        '$fname',
        '$initials',
        '$title',
        '$nic',
        '$mobno',
        '$email',
        '$adr1',
        '$adr2',
        '$adr3',
        '$city',
        '$district',
        '$occupation',
        '$me',
        '$user',
        sysdate,
        'A',
        '$brn',
        '$source_of_fund')";

    $stid = oci_parse($conn, $insert);
    oci_execute($stid);

    // Check if the insertion was successful
    $rowsAffected = oci_num_rows($stid);
    if ($rowsAffected > 0) {
        // Insertion successful
        echo '2';
    } else {
        // Insertion failed
        echo '0';
    }
}
?>
