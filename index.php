<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- sweetalert -->
<script src="bower_components/sweetalert/sweetalert.js"></script>

<?php
include_once('connectdb.php');
session_start();
if(isset($_POST['btn_login'])) //check if button login is pressed
{
  //get values from form
  $username=$_POST['txt_username'];
  $password=$_POST['txt_password'];

  //sql query to retrive user and details from database
  $query="SELECT SFC_CODE, SFC_FIRST_NAME, SFC_SURNAME, SFC_BRN_CODE,SFC_STATUS
  FROM SM_M_SALES_FORCE 
          WHERE sfc_username=UPPER('$username') 
          and sfc_password=UPPER(pk_cl_t_hot_intimation.fn_decrypt_sfc_password('$password')) 
          and sfc_active='Y' ";

  $result=oci_parse($conn,$query);
  oci_execute($result);

    $i=0;
    if($res_values=oci_fetch_assoc($result)) //fetching values array
    {
      $i++;
    }

      if($i==1)
      {
        //store user details in session/global variable
        $_SESSION['me_code']=$res_values['SFC_CODE'];
        $_SESSION['me_fname']=$res_values['SFC_FIRST_NAME'];
				$_SESSION['me_sname']=$res_values['SFC_SURNAME'];
        $_SESSION['me_brn']=$res_values['SFC_BRN_CODE'];		
        $_SESSION['me_status']=$res_values['SFC_STATUS'];			
							
						
              //message display using swal/sweet alert
              echo '<script type="text/javascript">
                        jQuery(function validation(){
                        swal({
                          title: "Good job!'.$_SESSION['me_fname'].'",
                          text: "Login Credentials Successful !",
                          icon: "success",
                          button: "Loading.....",
                        });
                    });
                    </script>';

                    header('refresh:3;dashboard.php');

      }
      else
      {
        echo '<script type="text/javascript">
                  jQuery(function validation(){
                  swal({
                    title: "Warning Username or Password is Wrong",
                    text: "Details Not Matched",
                    icon: "error",
                    button: "Ok",
                  });
              });
              </script>';
      }
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="indexx.php"><b>PHOENIX</b>INS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="txt_username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="txt_password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!-- code for checkbox removed -->
          <a href="#" onclick="swal('To Get Password','Please Contact the Admin for the Process','error');">I forgot my password</a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_login">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- code for social button removed -->

    <!-- /.social-auth-links -->

   
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
