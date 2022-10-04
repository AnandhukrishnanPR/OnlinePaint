<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$buyer_id=$_GET['buyer_id'];

if($buyer_id)
{
    $sels="select * from tbl_buyer where buyer_id='".$buyer_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['buyer_name'];
    $em=$datas['buyer_email'];
    $ph=$datas['buyer_phno'];
    $exp=$datas['buyer_reg_date'];
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_buyer set buyer_status='active' where buyer_id='".$buyer_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Activated successfully');
    window.location.href='BuyersView.php';
    </script>";
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_buyer set buyer_status='deactive' where buyer_id='".$buyer_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Deactivated successfully');
    window.location.href='BuyersView.php';
    </script>";
    
}

if(isset($_POST['btncancel']))
{
    
    header("Location:BuyersView.php");
    
}


?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Buyer Profile</h4>
                        <form method="post" enctype="multipart/form-data" class="form-sample">
                            <p class="card-description"> Personal info </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly="" name="txtname" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email:</label>
                                        <div class="col-sm-8">
                                            <input type="email" readonly="" name="txtemail" placeholder="Enter Email" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contact No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" placeholder="Enter Phone Number" value="<?php echo $ph; ?>" name="txtphno" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Registered Date:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="" name="txtexp" placeholder="Enter Experience" value="<?php echo $exp; ?>" class="form-control" />
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
                                        <button type="submit" name="btnaccept" class="btn btn-gradient-primary mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <button type="submit" name="btncancel" class="btn btn-light">Cancel</button>
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