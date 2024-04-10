<?php
$api_url="http://192.168.1.119/phoenix/index.php/api/classes/list";
$json_data=file_get_contents($api_url);
 
$repond_data=json_decode($json_data);
$user_data = $repond_data->data;

//print_r($user_data);

foreach($user_data as $user)
{
    
 //echo $user->CLA_CODE;
 //echo "<br>";
 echo $user->CLA_CODE;
 echo "<br>";
 //echo "<hr>";



}




?>


