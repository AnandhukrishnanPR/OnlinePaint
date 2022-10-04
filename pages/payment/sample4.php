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
<style type="text/css">
        .auto-style18 {
            width: 699px;
            height: 359px;
        }

        .auto-style20 {
            width: 114px;
            height: 139px;
        }
    </style>
        <script>
//	setTimeout(function(){window.location="Fourth.php"},4000);
	</script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card" style="text-align: center;min-height: 500px;">
                    <div class="card-body">
                        <img alt="" class="auto-style20" src="Images/loading.gif" /><br>
                        <img alt="" class="auto-style18" src="Images/Process2.JPG" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>