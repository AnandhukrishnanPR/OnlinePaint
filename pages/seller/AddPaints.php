<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$paint_id=$_GET['paint_id'];

if($paint_id)
{
    $sels="select * from tbl_paint where paint_id='".$paint_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['paint_name'];
    $em=$datas['paint_price'];
    $pt=$datas['ptype_id'];
}

if(isset($_POST['btnsave']))
{
    $ins="insert into tbl_paint(paint_name,paint_price,ptype_id,seller_id) values('".$_POST['txtname']."','".$_POST['txtrate']."','".$_POST['seltype']."','".$_SESSION['UserID']."')";
    mysqli_query($con,$ins);
    $sels="select * from tbl_paint order by paint_id desc limit 1";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    header("Location:AddColors.php?paint_id=".$datas['paint_id']);
}

if(isset($_POST['btnupdate']))
{  
    $ins="update tbl_paint set paint_name='".$_POST['txtname']."',paint_price='".$_POST['txtrate']."',ptype_id='".$_POST['seltype']."' where paint_id='".$paint_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var pid='".$paint_id."';
    alert('Updated successfully');
    window.location.href='AddPaints.php?paint_id='+pid;
    </script>";
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_paint set paint_status='active' where paint_id='".$paint_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var pid='".$paint_id."';
    alert('Activated successfully');
    window.location.href='AddPaints.php?paint_id='+pid;
    </script>";
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_paint set paint_status='deactive' where paint_id='".$paint_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var pid='".$paint_id."';
    alert('Deactivated successfully');
    window.location.href='AddPaints.php?paint_id='+pid;
    </script>";
}

if(isset($_POST['btncancel']))
{
    
    header("Location:ViewPaints.php");
    
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Paint Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Paint info </p>
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
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Type:</label>
                                        <div class="col-sm-10">
                                            
                                            <select name="seltype" class="form-control" required>
                                                <option value="">----------- Select Paint Type---------</option>
                                                <?php
                                                    $selm = "select * from tbl_paint_type where ptype_status<>'deactive'";
                                                    $rowm = mysqli_query($con, $selm);
                                                    while ($datam = mysqli_fetch_array($rowm)) {
                                                ?>
                                                <option value="<?php echo $datam['ptype_id']?>"<?php if($pt==$datam['ptype_id']){ ?>selected=""<?php } ?> ><?php echo $datam['ptype']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($paint_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-success mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <a href="AddColors.php?paint_id=<?php echo $paint_id;?>" class="btn btn-info"> ADD COLORS </a>
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
                                        if($paint_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnupdate"  class="btn btn-gradient-primary"> UPDATE </button>
                                        &nbsp;&nbsp;<a href="ViewPaints.php" class="btn btn-gradient-light">BACK</a>
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