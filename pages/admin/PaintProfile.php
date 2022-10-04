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
    $sels="select * from tbl_paint d inner join tbl_seller s on d.seller_id=s.seller_id where d.paint_id='".$paint_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['paint_name'];
    $em=$datas['paint_price'];
    $sels2="select * from tbl_paint_type where ptype_id='".$datas['ptype_id']."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
    $pt=$datas2['ptype'];
    $seller_id=$datas['seller_id'];
}

if(isset($_POST['btnaccept']))
{
    header("Location:OrderPaints.php?paint_id=".$paint_id);
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
                                            <input type="text" readonly="" name="txtname" value="<?php echo $name; ?>" placeholder="Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly="" name="txtrate" placeholder="0/-" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Type:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly="" name="seltype" placeholder="Type" value="<?php echo $pt; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p class="card-description"> Owner info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" value="<?php echo $datas['seller_name']; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email ID:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" placeholder="0/-" value="<?php echo $datas['seller_email']; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" placeholder="0/-" value="<?php echo $datas['seller_phno']; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Experience:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" placeholder="0/-" value="<?php echo $datas['seller_experience']; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label class="col-form-label">Available Colors:</label>
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
                                    <img src="../colors/<?php echo $data2['pcolor_pic'];?>" style="width: 100px;height: 100px;"><br>
                                    <?php echo $data2['pcolor_name'];?>
                                </div>
                                  <?php
                                  }
                                }
                                ?>
                                
                            </div>
                            <a href="ViewPaints.php?seller_id=<?php echo $seller_id;?>" class="btn btn-gradient-light" style="float: right">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>