<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!doctype html>
<?php 
ob_start();
include 'header.php'; 

if (isset($_POST['btnsubmit'])) {
    if ($_POST['txtpswd'] == $_POST['txtcpswd']) {
        $sel = "select * from tbl_login where login_username='" . $_POST['txtuname'] . "' order by login_id desc limit 1";
        $row=mysqli_query($con,$sel);
        $num_rows=mysqli_num_rows($row);
        if($num_rows>0)
        {
            echo "<script>alert('This Username is alredy exists! Try with another one');</script>";
        } else {
            $ins="insert into tbl_login(login_username,login_password,login_role) values('".$_POST['txtname']."','".$_POST['txtpswd']."','buyer')";
            mysqli_query($con,$ins);
            $sels = "select * from tbl_login where login_username='" . $_POST['txtuname'] . "'";
            $rows=mysqli_query($con,$sels);
            $data=mysqli_fetch_array($rows);
            $ins="insert into tbl_buyer(buyer_name,buyer_email,buyer_phno,buyer_address,buyer_reg_date,login_id) values('".$_POST['txtname']."','".$_POST['txtemail']."','".$_POST['txtphno']."','".$_POST['txtadd']."',curdate(),'".$data['login_id']."')";
            mysqli_query($con,$ins);
            echo "<script>
            alert('Registered successfully');
            window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script>alert('Confirmed password is incoorect! Check once more');</script>";
    }
}
?>
<main>
    <!--? Hero Start -->
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 pt-70 text-center">
                            <h2>Registration</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!--?  Contact Area start  -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Enter Your Details</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" method="post" >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control valid" required="" name="txtname" id="name" type="text" pattern="[a-z A-Z]{2,20}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control valid" required="" name="txtadd" id="add" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Address'" placeholder="Enter your Address"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" required="" name="txtemail" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Email'" placeholder="Enter your Email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control" required="" name="txtphno" id="phno" type="text" pattern="[0-9]{5,10}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Phone Number'" placeholder="Enter your Phone Number">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control valid" required="" name="txtuname" id="uname" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Create your Username'" placeholder="Create your Username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" required="" name="txtpswd" id="pswd" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Create your Password'" placeholder="Create your Password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" required="" name="txtcpswd" id="cpswd" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm your Password'" placeholder="Confirm your Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="btnsubmit" class="button button-contactForm boxed-btn">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Area End -->
</main>
<?php include 'footer.php'; ?>