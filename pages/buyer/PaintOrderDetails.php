<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php
$pcolor_id = $_GET['pcolor_id'];
$paint_id = $_GET['paint_id'];
$pohead_id = $_GET['pohead_id'];

if ($pcolor_id) {
    $sels = "select * from tbl_paint_color pc inner join tbl_paint p on pc.paint_id=p.paint_id where pc.pcolor_id='" . $pcolor_id . "'";
    $rows = mysqli_query($con, $sels);
    $datas = mysqli_fetch_array($rows);
    $name = $datas['pcolor_name'];
    $em = $datas['pcolor_value'];
    $im = $datas['pcolor_pic'];
    $pname = $datas['paint_name'];
    $pem = $datas['paint_price'];
    $sel_id = $datas['seller_id'];
    $sels2 = "select * from tbl_paint_type where ptype_id='" . $datas['ptype_id'] . "'";
    $rows2 = mysqli_query($con, $sels2);
    $datas2 = mysqli_fetch_array($rows2);
    $pt = $datas2['ptype'];
}

if (isset($_POST['btnsave'])) {
    
    if($pohead_id!="")
    {
        $seld2 = "select * from tbl_paint_order_detail where pohead_id='" .$pohead_id. "' and seller_id='".$sel_id."' and pcolor_id='".$pcolor_id."' and podetail_status='active'";
        $rowd2 = mysqli_query($con, $seld2);
        $numd2= mysqli_num_rows($rowd2);
        if($numh2==0)
        {
            $ins2 = "insert into tbl_paint_order_detail(pohead_id,pcolor_id,podetail_lr,podetail_rate_per_lr,podetail_unit_total) values('" .$pohead_id. "','".$pcolor_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "')";
            mysqli_query($con, $ins2);
            header("Location:PaintCart.php?pohead_id=".$datah2['pohead_id']."&seller_id=".$sel_id);
        }
        else
        {
            $datad2 = mysqli_fetch_array($rowd2);
            $ins2 = "update into tbl_paint_order_detail set podetail_lr='" . $_POST['txtlr'] . "',podetail_rate_per_lr='" . $pem . "',podetail_unit_total='" . $_POST['txttot'] . "' where podetail_id='".$datad2['podetail_id']."'";
            mysqli_query($con, $ins2);
            header("Location:PaintCart.php?pohead_id=".$datah2['pohead_id']."&seller_id=".$sel_id);
        }
    }
    else
    {
        
        $selh2 = "select * from tbl_paint_order_head where buyer_id='" .$_SESSION['UserID']. "' and seller_id='".$sel_id."' and pohead_issued_date=curdate() and pohead_status='active'";
        $rowh2 = mysqli_query($con, $selh2);
        $numh2= mysqli_num_rows($rowh2);
        if($numh2>0)
        {
            $datah2 = mysqli_fetch_array($rowh2);
            $seld2 = "select * from tbl_paint_order_detail where pohead_id='" .$datah2['pohead_id']. "' and pcolor_id='".$pcolor_id."' and podetail_status='active'";
            $rowd2 = mysqli_query($con, $seld2);
            $numd2= mysqli_num_rows($rowd2);
            if($numd2==0)
            {
                $ins2 = "insert into tbl_paint_order_detail(pohead_id,pcolor_id,podetail_lr,podetail_rate_per_lr,podetail_unit_total) values('" .$datah2['pohead_id']. "','".$pcolor_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "')";
                mysqli_query($con, $ins2);
                header("Location:PaintCart.php?pohead_id=".$datah2['pohead_id']."&seller_id=".$sel_id);
            }
            else
            {
                $datad2 = mysqli_fetch_array($rowd2);
                $ins2 = "update tbl_paint_order_detail set podetail_lr='" . $_POST['txtlr'] . "',podetail_rate_per_lr='" . $pem . "',podetail_unit_total='" . $_POST['txttot'] . "' where podetail_id='".$datad2['podetail_id']."'";
                mysqli_query($con, $ins2);
//                echo $ins2;
                header("Location:PaintCart.php?pohead_id=".$datah2['pohead_id']."&seller_id=".$sel_id);
            }
        }
        else {
            $ins = "insert into tbl_paint_order_head(buyer_id,pohead_issued_date,seller_id) values('" .$_SESSION['UserID']. "',curdate(),'".$sel_id."')";
            mysqli_query($con, $ins);
            $selh = "select * from tbl_paint_order_head order by pohead_id desc limit 1";
            $rowh = mysqli_query($con, $selh);
            $datah = mysqli_fetch_array($rowh);
            $ins2 = "insert into tbl_paint_order_detail(pohead_id,pcolor_id,podetail_lr,podetail_rate_per_lr,podetail_unit_total) values('" .$datah['pohead_id']. "','".$pcolor_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "')";
            mysqli_query($con, $ins2);
            header("Location:PaintCart.php?pohead_id=".$datah['pohead_id']."&seller_id=".$sel_id);
        }
    }
    
    
}

if (isset($_POST['btnupdate'])) {
    $dd = date('Y-m-d');
    $img = $_FILES['txtpic']['name'];
    $temp = $_FILES['txtpic']['tmp_name'];
    if ($img == "") {
        $image = $im;
    } else {
        echo "<script>alert('" . $img . "');</script>";
        $ext = pathinfo($img, PATHINFO_EXTENSION);
        $ra = rand(10000, 10000000);
        $img1 = basename($img, $ext);
        $image = $dd . $ra . "." . $ext;
        move_uploaded_file($temp, "../colors/" . $image);
    }
    $ins = "update tbl_paint_color set pcolor_name='" . $_POST['txtname'] . "',pcolor_value='" . $_POST['txtvalue'] . "',pcolor_pic='" . $image . "' where pcolor_id='" . $pcolor_id . "'";
    mysqli_query($con, $ins);
    header("Location:ViewPaints.php");
}


if (isset($_POST['btnaccept'])) {
    $ins = "update tbl_paint_color set pcolor_status='active' where pcolor_id='" . $pcolor_id . "'";
    mysqli_query($con, $ins);
    header("Location:ViewSeller.php");
}

if (isset($_POST['btnreject'])) {
    $ins = "update tbl_paint_color set pcolor_status='deactive' where pcolor_id='" . $pcolor_id . "'";
    mysqli_query($con, $ins);
    header("Location:ViewSeller.php");
}

if (isset($_POST['btncancel'])) {

    header("Location:ViewSeller.php");
}
?>
<script>
    function getTotal()
    {
        var pc=0;
        var ltr=0;
        var tot=0;
        if(document.getElementById("txtrate").value==="")
        {
            pc=0;
        }
        else
        {
            pc=parseInt(document.getElementById("txtrate").value);
        }
        if(document.getElementById("txtlr").value==="")
        {
            ltr=0;
        }
        else
        {
            ltr=parseInt(document.getElementById("txtlr").value);
        }
        
        tot=pc * ltr;
        document.getElementById("txttot").value=tot;
    }
</script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>
                        <p class="card-description"> Paint info </p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="txtname" value="<?php echo $pname; ?>" placeholder="Name" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Price:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="txtrate" id="txtrate" placeholder="0/-" value="<?php echo $pem; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="seltype" placeholder="Type" value="<?php echo $pt; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="card-description"> Color info </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <?php
                                        if ($pcolor_id != 0) {
                                            ?>
                                        <img src="../colors/<?php echo $im; ?>" style="width: 100px;height: 100px;"><br><br>
                                                <?php echo $name; ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form method="post" class="form-sample">
                            <p class="card-description"> Order info </p>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Enter how many litre that you want:</label>
                                        <div class="col-sm-5">
                                        <input type="text" pattern="[0-9.]{1,20}" required="" onkeyup="getTotal()" name="txtlr" id="txtlr" value="<?php echo $ltr; ?>" placeholder="Enter Litre" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Rate:</label>
                                        <div class="col-sm-5">
                                            <input type="text" readonly="" name="txttot" id="txttot" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> NEXT </button>
                                        <a href="ViewPaints.php" class="btn btn-gradient-light">Cancel</a>
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