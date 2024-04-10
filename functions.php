<?php



function basic_premium($yearofmake,$capacity,$brn){
    //FIND BASIC PREMIUM
    include_once('connectdb.php');

    $sql="select cicl.pkg_premium.bp_3a_premium('$yearofmake','$capacity','$brn')as PREMIUM from dual";
   // echo $sql;
    $sidwk = oci_parse($conn,$sql);
    oci_execute($sidwk);
   // $prm=oci_result($sidwk, strtoupper("PREMIUM"));
    //echo $sidwk;
   
    while($row=oci_fetch_assoc($sidwk)){
     $prm=$row['PREMIUM'];
     echo $prm;
     //echo "<br>";
     
     return $prm;
    }     

}






?>