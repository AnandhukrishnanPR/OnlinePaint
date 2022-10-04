<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php
$design_id = $_GET['design_id'];
$drhead_id = $_GET['drhead_id'];

if ($design_id) {
    $sels = "select * from tbl_design_photo pc inner join tbl_design p on pc.design_id=p.design_id inner join tbl_seller s on p.seller_id=s.seller_id where pc.design_id='" . $design_id . "'";
    $rows = mysqli_query($con, $sels);
    $datas = mysqli_fetch_array($rows);
    $name = $datas['design_name'];
    $sname = $datas['seller_name'];
    $sel_id = $datas['seller_id'];
    $pem = $datas['design_rate_per_sqfeet'];
    $seller_id=$datas['seller_id'];
}

if (isset($_POST['btnsave'])) {
    
    if($drhead_id!="")
    {
        $seld2 = "select * from tbl_design_request_detail where drhead_id='" .$drhead_id. "' and seller_id='".$sel_id."' and design_id='".$design_id."' and drdetail_status='active'";
        $rowd2 = mysqli_query($con, $seld2);
        $numd2= mysqli_num_rows($rowd2);
        if($numh2==0)
        {
            $ins2 = "insert into tbl_design_request_detail(drhead_id,design_id,drdetail_sqfeet,drdetail_rate_per_sqfeet,drdetail_unit_total) values('" .$drhead_id. "','".$design_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "')";
            mysqli_query($con, $ins2);
            header("Location:RequestCart.php?drhead_id=".$datah2['drhead_id']."&seller_id=".$sel_id);
        }
        else
        {
            $datad2 = mysqli_fetch_array($rowd2);
            $ins2 = "update into tbl_design_request_detail set drdetail_sqfeet='" . $_POST['txtlr'] . "',drdetail_rate_per_sqfeet='" . $pem . "',drdetail_unit_total='" . $_POST['txttot'] . "' where podetail_id='".$datad2['podetail_id']."'";
            mysqli_query($con, $ins2);
            header("Location:RequestCart.php?drhead_id=".$datah2['drhead_id']."&seller_id=".$sel_id);
        }
    }
    else
    {
        
        $selh2 = "select * from tbl_design_request_head where buyer_id='" .$_SESSION['UserID']. "' and seller_id='".$sel_id."' and drhead_issued_date=curdate() and drhead_status='active'";
        $rowh2 = mysqli_query($con, $selh2);
        $numh2= mysqli_num_rows($rowh2);
        if($numh2>0)
        {
            $datah2 = mysqli_fetch_array($rowh2);
            $seld2 = "select * from tbl_design_request_detail where drhead_id='" .$datah2['drhead_id']. "' and design_id='".$design_id."' and drdetail_status='active'";
            $rowd2 = mysqli_query($con, $seld2);
            $numd2= mysqli_num_rows($rowd2);
            if($numd2==0)
            {
                $ins2 = "insert into tbl_design_request_detail(drhead_id,design_id,drdetail_sqfeet,drdetail_rate_per_sqfeet,drdetail_unit_total,drdetail_description) values('" .$datah2['drhead_id']. "','".$design_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "','" . $_POST['txtdes'] . "')";
                mysqli_query($con, $ins2);
                header("Location:RequestCart.php?drhead_id=".$datah2['drhead_id']."&seller_id=".$sel_id);
            }
            else
            {
                $datad2 = mysqli_fetch_array($rowd2);
                $ins2 = "update tbl_design_request_detail set drdetail_sqfeet='" . $_POST['txtlr'] . "',drdetail_rate_per_sqfeet='" . $pem . "',drdetail_unit_total='" . $_POST['txttot'] . "',drdetail_description='" . $_POST['txtdes'] . "' where podetail_id='".$datad2['podetail_id']."'";
                mysqli_query($con, $ins2);
//                echo $ins2;
                header("Location:RequestCart.php?drhead_id=".$datah2['drhead_id']."&seller_id=".$sel_id);
            }
        }
        else {
            $ins = "insert into tbl_design_request_head(buyer_id,drhead_issued_date,seller_id) values('" .$_SESSION['UserID']. "',curdate(),'".$sel_id."')";
            mysqli_query($con, $ins);
            $selh = "select * from tbl_design_request_head order by drhead_id desc limit 1";
            $rowh = mysqli_query($con, $selh);
            $datah = mysqli_fetch_array($rowh);
            $ins2 = "insert into tbl_design_request_detail(drhead_id,design_id,drdetail_sqfeet,drdetail_rate_per_sqfeet,drdetail_unit_total,drdetail_description) values('" .$datah['drhead_id']. "','".$design_id."','" . $_POST['txtlr'] . "','" . $pem . "','" . $_POST['txttot'] . "','" . $_POST['txtdes'] . "')";
            mysqli_query($con, $ins2);
            header("Location:RequestCart.php?drhead_id=".$datah['drhead_id']."&seller_id=".$sel_id);
        }
    }
    
    
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
                        <h4 class="card-title">Request Details</h4>
                        <p class="card-description"> Design info </p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="txtname" value="<?php echo $name; ?>" placeholder="Name" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Rate:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="txtrate" id="txtrate" placeholder="0/-" value="<?php echo $pem; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Designer:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" name="seltype" placeholder="Designer" value="<?php echo $sname; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="card-description"> Design Photos </p>
                        <div class="row">
                            <?php
                            $sel2="select * from tbl_design_photo where dphoto_status<>'deactive' and design_id='".$design_id."'";
                            $row2=mysqli_query($con,$sel2);
                            $num_cl= mysqli_num_rows($row2);
                            if($num_cl>0)
                            {
                                while($data2=mysqli_fetch_array($row2))
                              {
                              ?>
                            <div class="col-md-2">
                                <img src="../designs/<?php echo $data2['dphoto'];?>" style="width: 150px;height: 150px;">
                            </div>
                              <?php
                              }
                            }
                            ?>

                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form method="post" class="form-sample">
                            <p class="card-description"> Request info </p>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Enter how many Square Feet that you want:</label>
                                        <div class="col-sm-6">
                                        <input type="text" pattern="[0-9.]{1,20}" required="" onkeyup="getTotal()" name="txtlr" id="txtlr" value="<?php echo $sqft; ?>" placeholder="Enter Square Feet" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Total Rate:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="" name="txttot" id="txttot" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <textarea type="text" name="txtdes" id="txtdes" placeholder="Enter your Description" class="form-control" style="min-height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> NEXT </button>
                                        <a href="ViewDesigns.php?seller_id=<?php echo $seller_id;?>" class="btn btn-gradient-light">Cancel</a>
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