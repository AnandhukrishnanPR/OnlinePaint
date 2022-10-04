<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php
if(isset($_POST['btnsave']))
{
    if($_SESSION['otp']==$_POST['txtotp'])
    {
        header("Location:Third.php");
    }else{
        echo "<script>
            alert('Incorrect OTP');
            window.location.href='Second.php';
            </script>";
    }
}

?>
<link rel="stylesheet" href="style.css">
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
                                        <input type="text" pattern="[0-9 ]{1,20}" required="" name="txtotp" placeholder="Enter OTP" class="form-control" />
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