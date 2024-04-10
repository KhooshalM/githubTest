<?php 
include_once('connectdb.php');
session_start();
if ($_SESSION['useremail']=="")
{
  header('location:index.php');
}

if($_SESSION['role']=="Admin")
{
    include_once('header.php'); 
}
else
{
    include_once('headeruser.php');
}

if(isset($_POST['btnupdate']))
{
    $oldpassword=$_POST['txtoldpass'];
    $newpassword=$_POST['txtnewpass'];
    $confpassword=$_POST['txtconfpass'];

    $email=$_SESSION['useremail'];
    $select=$pdo->prepare("select * from tbl_user where useremail='$email'");
    $select->execute();
    $row=$select->fetch(PDO::FETCH_ASSOC);

    $useremail_db=$row['useremail'];
    $password_db=$row['password'];

    if($oldpassword==$password_db)
    {
        if($newpassword==$confpassword)
        {
            $update=$pdo->prepare("update tbl_user set password=:pass where useremail=:email");
            $update->bindParam(':pass',$confpassword);
            $update->bindParam(':email',$email);
                if($update->execute())
                {
                    echo '<script type="text/javascript">
                    jQuery(function validation(){
                      swal({
                        title: "Good Job!",
                        text: "Your Password Updated Successfully",
                        icon: "success",
                        button: "OK",
                      });
                    });
                    
                    </script>';

                }
                else
                {
                    echo '<script type="text/javascript">
                    jQuery(function validation(){
                      swal({
                        title: "Error!",
                        text: "Query Failed",
                        icon: "error",
                        button: "OK",
                      });
                    });
                    
                    </script>';

                }

        }
        else
        {
            echo '<script type="text/javascript">
        jQuery(function validation(){
          swal({
            title: "Warning!",
            text: "New and Confirmed Password does not match...",
            icon: "warning",
            button: "OK",
          });
        });
        
        </script>';

        }

    }
    else
    {
        echo '<script type="text/javascript">
        jQuery(function validation(){
          swal({
            title: "Warning!",
            text: "Your Password is Wrong! Please provide the correct password",
            icon: "warning",
            button: "OK",
          });
        });
        
        </script>';

    }
}


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post" >
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Old Password</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Old Password" name="txtoldpass" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" name="txtnewpass" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" name="txtconfpass" required>
                </div>
           
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>
              </div>
            </form>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  <?php include_once('footer.php'); ?>