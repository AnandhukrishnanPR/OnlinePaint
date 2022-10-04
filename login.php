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
    $sel = "select * from tbl_login where login_username='" . $_POST['txtuname'] . "' and login_password='" . $_POST['txtpswd'] . "'";
    $row = mysqli_query($con, $sel);
    $num_row = mysqli_num_rows($row);
    if ($num_row > 0) {
        $data = mysqli_fetch_array($row);
        $_SESSION['LoginID'] = $data['login_id'];
        $_SESSION['LoginRole'] = $data['login_role'];
        if ($data['login_role'] == "admin") {
            $sels = "select * from tbl_admin where login_id='" . $data['login_id'] . "'";
            $rows = mysqli_query($con, $sels);
            $num_rows = mysqli_num_rows($rows);
            if ($num_rows > 0) {
                $datas = mysqli_fetch_array($rows);
                $_SESSION['UserID'] = $datas['admin_id'];
                header("Location:pages/others/index.php");
            } else {
                echo "<script>alert('Invalid Username or Password!');</script>";
            }
        } elseif ($data['login_role'] == "seller") {
            $sels = "select * from tbl_seller where login_id='" . $data['login_id'] . "' and seller_status='active'";
            $rows = mysqli_query($con, $sels);
            $num_rows = mysqli_num_rows($rows);
            if ($num_rows > 0) {
                $datas = mysqli_fetch_array($rows);
                $_SESSION['UserID'] = $datas['seller_id'];
                header("Location:pages/others/index.php");
            } else {
                echo "<script>alert('Invalid Username or Password!');</script>";
            }
        } elseif ($data['login_role'] == "buyer") {
            $sels = "select * from tbl_buyer where login_id='" . $data['login_id'] . "' and buyer_status='active'";
            $rows = mysqli_query($con, $sels);
            $num_rows = mysqli_num_rows($rows);
            if ($num_rows > 0) {
                $datas = mysqli_fetch_array($rows);
                $_SESSION['UserID'] = $datas['buyer_id'];
                header("Location:pages/others/index.php");
            } else {
                echo "<script>alert('Invalid Username or Password!');</script>";
            }
        } else {
            echo "<script>alert('Invalid Username or Password!');</script>";
        }
    } else {
        echo "<script>alert('Invalid Username or Password!');</script>";
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
                            <h2>LOGIN</h2>
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
                <div class="col-lg-8">
                    <form class="form-contact contact_form" method="post" novalidate="novalidate">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control valid" name="txtuname" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Username'" placeholder="Enter your Username">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control valid" name="txtpswd" id="email" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Password'" placeholder="Enter your Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="btnsubmit" class="button button-contactForm boxed-btn">LOGIN</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>