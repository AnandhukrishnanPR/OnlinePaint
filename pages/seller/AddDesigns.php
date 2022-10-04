<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$design_id=$_GET['design_id'];

if($design_id)
{
    $sels="select * from tbl_design where design_id='".$design_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['design_name'];
    $em=$datas['design_rate_per_sqfeet'];
    $pt=$datas['design_description'];
}

if(isset($_POST['btnsave']))
{
    $ins="insert into tbl_design(design_name,design_rate_per_sqfeet,design_description,seller_id) values('".$_POST['txtname']."','".$_POST['txtrate']."','".$_POST['txtdes']."','".$_SESSION['UserID']."')";
    mysqli_query($con,$ins);
    $sels="select * from tbl_design order by design_id desc limit 1";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    header("Location:AddDesignPhotos.php?design_id=".$datas['design_id']);
}

if(isset($_POST['btnupdate']))
{  
    $ins="update tbl_design set design_name='".$_POST['txtname']."',design_rate_per_sqfeet='".$_POST['txtrate']."',design_description='".$_POST['txtdes']."' where design_id='".$design_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var did='".$design_id."';
    alert('Updated successfully');
    window.location.href='AddDesigns.php?design_id='+did;
    </script>";
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_design set design_status='active' where design_id='".$design_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var did='".$design_id."';
    alert('Activated successfully');
     window.location.href='AddDesigns.php?design_id='+did;
    </script>";
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_design set design_status='deactive' where design_id='".$design_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var did='".$design_id."';
    alert('Deactivated successfully');
     window.location.href='AddDesigns.php?design_id='+did;
    </script>";
}

if(isset($_POST['btncancel']))
{
    
    header("Location:ViewDesigns.php");
    
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Design Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Design info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="" name="txtname" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price:</label>
                                        <div class="col-sm-10">
                                            <input type="text" pattern="[0-9.]{1,20}" required="" name="txtrate" placeholder="Enter Rate" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description:</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="" name="txtdes" placeholder="Enter Description" value="<?php echo $pt; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($design_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-success mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <a href="AddDesignPhotos.php?design_id=<?php echo $design_id;?>" class="btn btn-warning"> ADD PHOTOS </a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> NEXT </button>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($design_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnupdate" style="float: right;" class="btn btn-gradient-primary"> UPDATE </button>
                                        &nbsp;&nbsp;<a href="ViewDesigns.php" class="btn btn-gradient-light">Cancel</a>
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