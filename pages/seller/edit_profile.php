<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$seller_id=$_SESSION['UserID'];

if($seller_id)
{
    $sels="select * from tbl_seller where seller_id='".$seller_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['seller_name'];
    $em=$datas['seller_email'];
    $ph=$datas['seller_phno'];
    $exp=$datas['seller_experience'];
    $im=$datas['seller_profile'];
}

if(isset($_POST['btnupdate']))
{  
    $img=$_FILES['txtpic']['name'];
    $temp=$_FILES['txtpic']['tmp_name'];
    if($img=="")
    {
        $image=$im;
    }
    else
    {
        $ext=pathinfo($img,PATHINFO_EXTENSION);
        $ra=rand(10000,10000000);
        $img1=basename($img,$ext);
        $image=$dd.$ra.".".$ext;
        move_uploaded_file($temp,"../profiles/sellers/".$image);
    }
    
    
    $ins="update tbl_seller set seller_name='".$_POST['txtname']."',seller_email='".$_POST['txtemail']."',seller_phno='".$_POST['txtphno']."',seller_experience='".$_POST['txtexp']."',seller_profile='".$image."' where seller_id='".$seller_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Profile Updated successfully');
    window.location.href='edit_profile.php';
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
                        <h4 class="card-title">My Profile</h4>
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
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Change Profile:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="txtpic" placeholder="Select Photo" class="form-control" />
                                            <?php
                                            if($im!="")
                                            {
                                            ?>
                                            <img src="../profiles/sellers/<?php echo $im;?>" style="width: 100px;height: 100px;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($seller_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnupdate" class="btn btn-gradient-primary mr-2"> UPDATE </button>
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