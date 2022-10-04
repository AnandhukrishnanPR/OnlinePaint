<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$_SESSION['pohead_id']=$_GET['pohead_id'];

if(isset($_POST['btnsave']))
{
    $sels = "select * from tbl_buyer where buyer_id='" . $_SESSION['UserID'] . "'";
    $rows = mysqli_query($con, $sels);
    $num_rows = mysqli_num_rows($rows);
    $datas = mysqli_fetch_array($rows);
    $_SESSION['otp']=rand(10000, 10000000);;
    $name=$datas['buyer_name'];
    $mailid=$datas['buyer_email'];
    require("class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->SMTPSecure = "tls";

    $mail->Host = "smtp.gmail.com";  // specify main and backup server
    $mail->Port = 587;
    $mail->Username = "mecproject2k20@gmail.com";  // SMTP username
    $mail->Password = "MECPROJECT2K20"; // SMTP password

    $mail->From = "mecproject2k20@gmail.com";
    $mail->FromName = "Paint Outlet";
    $mail->AddAddress($mailid, $name);


    $mail->WordWrap = 50;// set word wrap to 50 characters
    $mail->IsHTML(true);// set email format to HTML

    $mail->Subject = "OTP";

    $mail->Body    = "Dear user, Your One Time Password is <b>".$_SESSION['otp']."</b>";

    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if(!$mail->Send()) {
//            echo "Mailer Error: " . $mail->ErrorInfo;
            echo "<script>
            alert('Registered successfully without sending mail');
            window.location.href='seller_reg.php';
            </script>";
     } else {
            echo "<script>
            alert('Check your Email please');
            window.location.href='Second.php';
            </script>";
     }
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
                                            <input type="text" pattern="[a-zA-Z ]{1,20}" required="" class="form-control" />
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