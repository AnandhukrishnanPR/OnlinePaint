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
    $sels="select * from tbl_design d inner join tbl_seller s on d.seller_id=s.seller_id where d.design_id='".$design_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['design_name'];
    $em=$datas['design_rate_per_sqfeet'];
    $pt=$datas['design_description'];
    $seller_id=$datas['seller_id'];
}

if(isset($_POST['btnaccept']))
{
    header("Location:DesignRequestDetails.php?design_id=".$design_id);
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
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" readonly="" name="seltype" placeholder="Description" value="<?php echo $pt; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p class="card-description"> Designer info </p>
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
                            <label class="col-form-label">Design Photos:</label>
                            <div class="row">
                                <?php
                                $sel2="select * from tbl_design_photo where dphoto_status<>'deactive' and design_id='".$design_id."'";
                                $row2=mysqli_query($con,$sel2);
                                $num_cl= mysqli_num_rows($row2);
                                if($num_cl>0)
                                {
                                    while($data2=mysqli_fetch_array($row2))
                                  {
                                  ?>
                                <div class="col-md-2">
                                    <img src="../designs/<?php echo $data2['dphoto'];?>" style="width: 150px;height: 150px;">
                                </div>
                                  <?php
                                  }
                                }
                                ?>
                                
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <?php
                                        if($design_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-gradient-primary mr-2"> SEND REQUEST </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <a href="ViewDesigns.php?seller_id=<?php echo $seller_id;?>" class="btn btn-gradient-light" style="float: right">BACK</a>
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