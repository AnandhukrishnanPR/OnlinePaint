<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$drhead_id=$_GET['drhead_id'];
$paint_id=$_GET['paint_id'];

//if($drhead_id)
//{
//    $sels="select * from tbl_paint_color where drhead_id='".$drhead_id."'";
//    $rows=mysqli_query($con,$sels);
//    $datas=mysqli_fetch_array($rows);
//    $name=$datas['pcolor_name'];
//    $em=$datas['pcolor_value'];
//    $im=$datas['pcolor_pic'];
//}

if(isset($_POST['btnsave']))
{
    $ins="insert into tbl_order_address(buyer_id,oaddress,oadress_place,oadress_pincode,oadress_landmark) values('".$_SESSION['UserID']."','".$_POST['txtadd']."','".$_POST['txtplace']."','".$_POST['txtpin']."','".$_POST['txtland']."')";
    mysqli_query($con,$ins);
    $selh = "select * from tbl_order_address order by oaddress_id desc limit 1";
    $rowh = mysqli_query($con, $selh);
    $datah = mysqli_fetch_array($rowh);
    $ins2 = "update tbl_design_request_head set oaddress_id='" . $datah['oaddress_id'] . "',drhead_status='waiting...' where drhead_id='".$drhead_id."'";
    mysqli_query($con, $ins2);
    echo "<script>
    alert('Request Sended successfully');
    window.location.href='DesignRequestStatus.php';
    </script>";
}


if(isset($_POST['btnfinish']))
{
    $adid=$_POST['txtoadd'];
    $ins2 = "update tbl_design_request_head set oaddress_id='" . $adid . "',drhead_status='waiting...' where drhead_id='".$drhead_id."'";
    mysqli_query($con, $ins2);
    echo "<script>
    alert('Request Sended successfully');
    window.location.href='DesignRequestStatus.php';
    </script>";
    
}

if(isset($_POST['btncancel']))
{
    
    header("Location:ViewSeller.php");
    
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Address Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Address info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtadd" placeholder="Enter Address" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Place:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtplace" placeholder="Enter Place" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Landmark:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtland" placeholder="Enter Landmark" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pincode:</label>
                                        <div class="col-sm-9">
                                            <input type="text" pattern="[0-9]{0,6}" name="txtpin" placeholder="Enter Pincode" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> FINISH </button>
                                        <a href="ViewPaints.php" class="btn btn-light">Cancel</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                        $i=1;
                        $sel="select * from tbl_order_address where buyer_id='".$_SESSION['UserID']."' and oaddress_status<>'deactive'";
                        $row=mysqli_query($con,$sel);
                        $numadd= mysqli_num_rows($row);
                        if($numadd>0)
                        {
                    ?>
                    <h2 class="card-title" style="text-align: center;font-size: 2em;color: #0606c4;">OR</h2>
                    <div class="card-body">
                        <h4 class="card-title">Choose your Address</h4><br><br>
                        <form method="post" class="form-sample">
                            <div class="row">
                                <?php
                                    $i=1;
                                    $sel="select * from tbl_order_address where buyer_id='".$_SESSION['UserID']."' and oaddress_status<>'deactive'";
                                    $row=mysqli_query($con,$sel);
                                    $numadd= mysqli_num_rows($row);
                                    while($data=mysqli_fetch_array($row))
                                    {

                                ?>
                                <div class="col-md-6">
                                    <div class="row">
                                    <div class="col-md-1">
                                        <input type="radio" name="txtoadd" id="txtoadd" value="<?php echo $data['oaddress_id'];?>" />
                                    </div>
                                    <div class="col-md-10">
                                        <span class="col-sm-12 col-form-label" style="text-decoration: underline">Address <?php echo $i;?></span>
                                       <div class="form-group row">
                                           <span class="col-sm-12 col-form-label"><?php echo $data['oaddress'];?></span>
                                           <label class="col-sm-12">Place: <?php echo $data['oadress_place'];?></label><br>
                                           <label class="col-sm-12">Pincode: <?php echo $data['oadress_pincode'];?></label><br>
                                           <label class="col-sm-12">Landmark: <?php echo $data['oadress_landmark'];?></label>
                                       </div>
                                    </div>
                                    </div>
                                </div>
                                <?php
                                    $i++;
                                    }
                                ?>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <button type="submit" name="btnfinish" class="btn btn-gradient-primary mr-2"> FINISH </button>
                                        <a href="ViewDesigns.php" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>