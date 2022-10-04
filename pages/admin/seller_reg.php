<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$seller_id=$_GET['seller_id'];

if($seller_id)
{
    $sels="select * from tbl_seller where seller_id='".$seller_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['seller_name'];
    $em=$datas['seller_email'];
    $ph=$datas['seller_phno'];
    $exp=$datas['seller_experience'];
}

if(isset($_POST['btnsave']))
{
    $dd=date('ymd');
    $username=$dd.random_username();
    $password=random_password();
    
    $img=$_FILES['txtpic']['name'];
    $temp=$_FILES['txtpic']['tmp_name'];
    $ext=pathinfo($img,PATHINFO_EXTENSION);
    $ra=rand(10000,10000000);
    $img1=basename($img,$ext);
    $image=$dd.$ra.".".$ext;//20071547859465.jpg
    move_uploaded_file($temp,"../profiles/sellers/".$image);
    
    $ins="insert into tbl_login(login_username,login_password,login_role) values('".$username."','".$password."','seller')";
    mysqli_query($con,$ins);
    $sels = "select * from tbl_login where login_username='" .$username . "' order by login_id desc limit 1";
    $rows=mysqli_query($con,$sels);
    $data=mysqli_fetch_array($rows);
    $ins="insert into tbl_seller(seller_name,seller_email,seller_phno,seller_experience,seller_profile,seller_reg_date,login_id) values('".$_POST['txtname']."','".$_POST['txtemail']."','".$_POST['txtphno']."','".$_POST['txtexp']."','".$image."',curdate(),'".$data['login_id']."')";
    mysqli_query($con,$ins);
    $name=$_POST['txtname'];
    $mailid=$_POST['txtemail'];
    require("class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->SMTPSecure = "tls";

    $mail->Host = "smtp.gmail.com";  // specify main and backup server
    $mail->Port = 587;
    $mail->Username = "mecproject2k20@gmail.com";  // SMTP username
    $mail->Password = "MECPROJECT2K20"; // SMTP password

    $mail->From = "mecproject2k20@gmail.com";
    $mail->FromName = "Paint Outlet";
    $mail->AddAddress($mailid, $name);


    $mail->WordWrap = 50;// set word wrap to 50 characters
    $mail->IsHTML(true);// set email format to HTML

    $mail->Subject = "Registration";

    $mail->Body    = "Dear user, Your registration with Paint Outlet is completed successfully. Please login with username <b>".$username."</b> and password <b>".$password."</b> for further actions";

    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if(!$mail->Send()) {
//            echo "Mailer Error: " . $mail->ErrorInfo;
            echo "<script>
            alert('Registered successfully without sending mail');
            window.location.href='seller_reg.php';
            </script>";
     } else {
             echo "<script>
            alert('Registered successfully');
            window.location.href='seller_reg.php';
            </script>";
     }
    
//    header("Location:seller_reg.php");
}

if(isset($_POST['btnupdate']))
{  
    $ins="update tbl_seller set seller_name='".$_POST['txtname']."',seller_email='".$_POST['txtemail']."',seller_phno='".$_POST['txtphno']."',seller_experience='".$_POST['txtexp']."' where seller_id='".$seller_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    var sid ='".$seller_id."';
    alert('Updated successfully');
    window.location.href='seller_reg.php?seller_id='+sid;
    </script>";
//    header("Location:seller_reg.php?seller_id=".$seller_id);
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_seller set seller_status='active' where seller_id='".$seller_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Activated successfully');
    window.location.href='seller_view.php';
    </script>";
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_seller set seller_status='deactive' where seller_id='".$seller_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Deactivated successfully');
    window.location.href='seller_view.php';
    </script>";
}

if(isset($_POST['btncancel']))
{
    
    header("Location:seller_view.php");
    
}


function random_password( $length = 6 ) 
{
	$chars = "ABCDEFGH0123456789";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}

function random_username( $length = 6 ) 
{
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}


?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Seller Profile</h4>
                        <form method="post" enctype="multipart/form-data" class="form-sample">
                            <p class="card-description"> Personal info </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" pattern="[a-zA-z ]{2,20}" required="" name="txtname" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email:</label>
                                        <div class="col-sm-8">
                                            <input type="email" required="" name="txtemail" placeholder="Enter Email" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contact No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" pattern="[0-9]{5,10}" required="" placeholder="Enter Phone Number" value="<?php echo $ph; ?>" name="txtphno" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Experience:</label>
                                        <div class="col-sm-8">
                                            <input type="text" required="" name="txtexp" placeholder="Enter Experience" value="<?php echo $exp; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if($seller_id==0)
                                {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Profile Pic:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="txtpic" placeholder="Select Photo" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($seller_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-success mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <button type="submit" name="btncancel" class="btn btn-light">Cancel</button>
                                        <button type="submit" name="btnupdate" style="float: right;background-color: #00ffb8;margin-left: 50%;" class="btn btn-gradient-primary"> UPDATE </button>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> SAVE </button>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>