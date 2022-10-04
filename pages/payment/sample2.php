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

?>
<link rel="stylesheet" href="style.css">
        <title>UpWork</title>
        <script>
            function checknum(y)
            {
                var numericExp = /^\d{4}$/;
                if (numericExp.test(y) == false)
                {
                    alert("Not 4 digit confirmation number");
                    return false;
                }
            }
        </script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-6">
                <div class="card" style="text-align: center;min-height: 500px;padding: 50px">
                    <div class="card-body">
                        <h4 class="card-title">OTP Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Enter OTP </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <input type="text" pattern="[0-9 ]{1,20}" required="" placeholder="Enter OTP" class="form-control" />
                                    </div>
                                    <div class="" style="text-align: center;">
                                       <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> NEXT </button>
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