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

        <style type="text/css">
            input[type=radio] {
                display:none; 
                margin:10px;
            }
            input[type=radio] + label {
                display:inline-block;
                margin:-2px;
                padding: 2px;
                background-color: #ffffff;
                border-color: #ddd;
            }
            input[type=radio]:checked + label { 
               background-image: none;
                border-radius: 10px;
                border:solid 2px #26ce1b;
            }
            .radion_img{
                border-radius: 10px;
            }
        </style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Payment Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Enter Your Card Details </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Select card:</label>
                                        <div class="col-sm-3">
                                            <input type="radio" id="radio1" name="radios" value="all" checked>
                                            <label for="radio1"><img alt=""  class="radion_img" width="150" height="100" src="Images/prepaid.png" /></label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="radio" id="radio2" name="radios"value="false">
                                            <label for="radio2"><img alt=""  class="radion_img" width="150" height="100" src="Images/debit.png" /></label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="radio" id="radio3" name="radios" value="true">
                                            <label for="radio3"><img alt=""  class="radion_img" width="150" height="100" src="Images/credit.png" /></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Card Number:</label>
                                        <div class="col-sm-8">
                                            <input type="text" pattern="[0-9 ]{1,20}" required="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">CVV:</label>
                                        <div class="col-sm-8">
                                            <input type="text" pattern="[0-9]{3}" required="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Name on card:</label>
                                        <div class="col-sm-8">
                                            <input type="text" pattern="[0-9 ]{1,20}" required="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Date:</label>
                                        <div class="col-sm-8">
                                            <input type="date" required=""  class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
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