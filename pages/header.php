<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>
<?php
ob_start();
$con = mysqli_connect("localhost", "root", "root", "db_paint_outlet");
session_start();
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Paint Outlet</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="../assets/images/favicon.png" />
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:../partials/_navbar.php -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="../others/index.php" style="color:#9a55ff">ONLINE PAINT OUTLET</a>
                    <a class="navbar-brand brand-logo-mini" href="../others/index.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block full-screen-link">
                            <a class="nav-link">
                                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:../partials/_sidebar.php -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <?php
//                            echo "session ".$_SESSION['LoginRole'];
                            ?>
                            <a class="nav-link" href="../others/index.php">
                                <span class="menu-title">Dashboard</span>
                                <i class="mdi mdi-home menu-icon"></i>
                            </a>
                        </li>
                        <?php
                        if($_SESSION['LoginRole']=="admin")
                        {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-seller" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Seller Details</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account-star menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-seller">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="../admin/seller_reg.php">Seller Registration</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../admin/seller_view.php">Seller Details</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/BuyersView.php">
                                <span class="menu-title">View Buyers</span>
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/PaintType.php">
                                <span class="menu-title">Add Paint Types</span>
                                <i class="mdi mdi-buffer menu-icon"></i>
                            </a>
                        </li>
                        <?php
                        }else if($_SESSION['LoginRole']=="seller")
                        {
                        ?>
                        <!------------------------------------------>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-supplier" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Supplier Details</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account-star menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-supplier">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="../seller/supplier_reg.php">Supplier Registration</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../seller/supplier_view.php">Supplier Details</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-spaint" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Paint Details</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-format-paint menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-spaint">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="../seller/AddPaints.php">Add Paints</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../seller/ViewPaints.php">View Paints</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-sdesign" aria-expanded="false" aria-controls="ui-design">
                                <span class="menu-title">Design Details</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-brush menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-sdesign">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="../seller/AddDesigns.php">Add Designs</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../seller/ViewDesigns.php">View Designs</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../seller/ViewOrders.php">
                                <span class="menu-title">View Orders</span>
                                <i class="mdi mdi-file-outline menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../seller/ViewRequests.php">
                                <span class="menu-title">View Requests</span>
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../seller/edit_profile.php">
                                <span class="menu-title">My Profile</span>
                                <i class="mdi mdi-account menu-icon"></i>
                            </a>
                        </li>
                        <?php
                        }else if($_SESSION['LoginRole']=="buyer")
                        {
                        ?>
                        <!--------------------------------------------->
                        <li class="nav-item">
                            <a class="nav-link" href="../buyer/ViewSeller.php">
                                <span class="menu-title">View Sellers</span>
                                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../buyer/PaintOrderStatus.php">
                                <span class="menu-title">My Orders</span>
                                <i class="mdi mdi-file-outline menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../buyer/DesignRequestStatus.php">
                                <span class="menu-title">My Requests</span>
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../buyer/edit_profile.php">
                                <span class="menu-title">My Profile</span>
                                <i class="mdi mdi-account menu-icon"></i>
                            </a>
                        </li>
                        <?php
                        } else {
                            
                        }
                        ?>
                        <!--------------------------------------------->
                        <li class="nav-item">
                            <a class="nav-link" href="../others/settings.php">
                                <span class="menu-title">Settings</span>
                                <i class="mdi mdi-settings menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" data-toggle="modal" data-target="#logoutModal">
                                <span class="menu-title">Logout</span>
                                <i class="mdi mdi-logout-variant menu-icon"></i>
                            </a>
                        </li>

                    </ul>
                </nav>