<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$supplier_id=$_GET['supplier_id'];

if($supplier_id)
{
    $sels="select * from tbl_supplier where supplier_id='".$supplier_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['supplier_name'];
    $em=$datas['supplier_email'];
    $ph=$datas['supplier_phno'];
    $exp=$datas['supplier_experience'];
}

if(isset($_POST['btnsave']))
{
    $dd=date('Y-m-d');
    $username=$dd.random_username();
    $password=random_password();
    $img=$_FILES['txtpic']['name'];
    $temp=$_FILES['txtpic']['tmp_name'];
    $ext=pathinfo($img,PATHINFO_EXTENSION);
    $ra=rand(10000,10000000);
    $img1=basename($img,$ext);
    $image=$dd.$ra.".".$ext;
    move_uploaded_file($temp,"../profiles/suppliers/".$image);
    $ins="insert into tbl_login(login_username,login_password,login_role) values('".$username."','".$password."','supplier')";
    mysqli_query($con,$ins);
    $sels = "select * from tbl_login where login_username='" .$username . "' order by login_id desc limit 1";
    $rows=mysqli_query($con,$sels);
    $data=mysqli_fetch_array($rows);
    $ins="insert into tbl_supplier(supplier_name,supplier_email,supplier_phno,supplier_experience,supplier_profile,supplier_reg_date,login_id) values('".$_POST['txtname']."','".$_POST['txtemail']."','".$_POST['txtphno']."','".$_POST['txtexp']."','".$image."',curdate(),'".$data['login_id']."')";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Registered successfully');
    window.location.href='supplier_reg.php';
    </script>";
//    header("Location:supplier_reg.php");
}

if(isset($_POST['btnupdate']))
{
    
    $ins="update tbl_supplier set supplier_name='".$_POST['txtname']."',supplier_email='".$_POST['txtemail']."',supplier_phno='".$_POST['txtphno']."',supplier_experience='".$_POST['txtexp']."' where supplier_id='".$supplier_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var sid='".$supplier_id."';
    alert('Updated successfully');
    window.location.href='supplier_reg.php?supplier_id='+sid;
    </script>";
//    header("Location:supplier_reg.php?supplier_id=".$supplier_id);
    
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_supplier set supplier_status='active' where supplier_id='".$supplier_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Activated successfully');
    window.location.href='supplier_view.php';
    </script>";
//    header("Location:supplier_view.php");
    
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_supplier set supplier_status='deactive' where supplier_id='".$supplier_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Deactivated successfully');
    window.location.href='supplier_view.php';
    </script>";
//    header("Location:supplier_view.php");
    
}

if(isset($_POST['btncancel']))
{
    
    header("Location:supplier_view.php");
    
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
                        <h4 class="card-title">Supplier Profile</h4>
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
                                if($supplier_id==0)
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
                                        if($supplier_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-gradient-primary mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <button type="submit" name="btncancel" class="btn btn-light">Cancel</button>
                                        <button type="submit" name="btnupdate" style="float: right;background-color: #00ffb8;margin-left: 50%;" class="btn btn-light"> UPDATE </button>
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