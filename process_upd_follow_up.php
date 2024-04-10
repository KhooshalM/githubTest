<?php
include_once('connectdb.php');

$bus_id=strtoupper($_POST['bus_id']);
$typeofcontact=strtoupper($_POST['typeofcontact']);
$comment=strtoupper($_POST['comment']);

//echo"<script>
//alert('$bus_id+'$typeofcontact'+'$comment');
//</script>";

$update="UPDATE me_t_risks SET 
mtb_follow_up_type='$typeofcontact',
modified_date=sysdate
WHERE mtb_seq='$bus_id'";

$stid = oci_parse($conn,$update); 
oci_execute($stid);
if((oci_num_rows($stid) == true )){
    echo '<script type="text/javascript">
    jQuery(function validation(){
    swal({
      title: "Transaction!",
      text: "Follow Up Done!",
      icon: "success",
     
    });
});
</script>';

} else {
    echo '<script type="text/javascript">
                            jQuery(function validation(){
                            swal({
                              title: "Warning",
                              text: "Update Not Sucessfull",
                              icon: "error",
                              button: "Ok",
                            });
                        });
                        </script>';
}

?>