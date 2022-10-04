<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$buyer_id=$_SESSION['UserID'];

if($buyer_id)
{
    $sels="select * from tbl_buyer where buyer_id='".$buyer_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['buyer_name'];
    $em=$datas['buyer_email'];
    $ph=$datas['buyer_phno'];
    $exp=$datas['buyer_address'];
}


if(isset($_POST['btnupdate']))
{  
   
    $ins="update tbl_buyer set buyer_name='".$_POST['txtname']."',buyer_email='".$_POST['txtemail']."',buyer_phno='".$_POST['txtphno']."',buyer_address='".$_POST['txtadd']."' where buyer_id='".$buyer_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Profile Updated successfully');
    window.location.href='edit_profile.php';
    </script>";
}


if(isset($_POST['btncancel']))
{
    
    header("Location:buyer_view.php");
    
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
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Address:</label>
                                        <div class="col-sm-12">
                                            <textarea type="text" name="txtadd" placeholder="Address" class="form-control" style="min-height: 100px" ><?php echo $exp; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($buyer_id!=0)
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