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
    $sels2="select * from tbl_paint_type where ptype_id='".$datas['ptype_id']."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
    $pt=$datas2['ptype'];
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
    header("Location:ViewPaints.php");
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_paint set paint_status='active' where paint_id='".$paint_id."'";
    mysqli_query($con,$ins);
    header("Location:ViewPaints.php");
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_paint set paint_status='deactive' where paint_id='".$paint_id."'";
    mysqli_query($con,$ins);
    header("Location:ViewPaints.php");
    
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
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="" name="txtname" value="<?php echo $name; ?>" placeholder="Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Price:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="" name="txtrate" placeholder="0/-" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Type:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="" name="seltype" placeholder="Type" value="<?php echo $pt; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label class="col-form-label">Select Colors:</label>
                            <div class="row">
                                <?php
                                $sel2="select * from tbl_paint_color where pcolor_status<>'deactive' and paint_id='".$paint_id."'";
                                $row2=mysqli_query($con,$sel2);
                                $num_cl= mysqli_num_rows($row2);
                                if($num_cl>0)
                                {
                                    while($data2=mysqli_fetch_array($row2))
                                  {
                                  ?>
                                <div class="col-md-2">
                                    <a href="PaintOrderDetails.php?pcolor_id=<?php echo $data2['pcolor_id'];?>"><img src="../colors/<?php echo $data2['pcolor_pic'];?>" style="width: 100px;height: 100px;"></a><br>
                                    <?php echo $data2['pcolor_name'];?>
                                </div>
                                  <?php
                                  }
                                }
                                ?>
                                
                            </div>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>