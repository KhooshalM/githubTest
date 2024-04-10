<?php


    $db_username="CICL";
    $db_password="CICL";
    $db="(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST =192.168.1.226)(PORT = 1521)))(CONNECT_DATA=(SID=MU)))";

    $conn=oci_connect($db_username,$db_password,$db);
    if(!$conn)
    {
echo "Not Connected To Phoenix Database";
    }
    

?>