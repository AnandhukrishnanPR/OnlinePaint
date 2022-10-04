
<?php include '../header.php'; ?>
<?php   
    
    if(isset($_POST['btnsubmit']))
    {
        $olduname=$_POST['txtolduname'];
        $newuname=$_POST['txtnewuname'];
        
        if($olduname=="" || $newuname=="")
        {
            echo "<script>alert('Please Enter Username');</script>";
        }
        else
        {
                $sel="select * from tbl_login where login_username='".$olduname."' and login_id='".$_SESSION['LoginID']."'";
                $row=mysqli_query($con,$sel);
                $num_row= mysqli_num_rows($row);
                $data=mysqli_fetch_array($row);

                if($num_row>0)
                {
                    $sel2="select * from tbl_login where login_username='".$newuname."'";
                    $row2=mysqli_query($con,$sel2);
                    $num_row2= mysqli_num_rows($row2);
                    if($num_row2>0)
                    {
                        echo "<script>alert('This username is already exists');</script>";
                    }
                    else
                    {   
                        $selA2="update tbl_login set login_username='".$newuname."' where login_id='".$_SESSION['LoginID']."'";
                        mysqli_query($con,$selA2);
                        echo "<script>alert('Username Changed successfully!');</script>";
                    }
                }
                else
                {   
                    ?>
                    <script>alert('Incorrect Username')</script>
                    <?php

                }
            
            
        }
    }

    if(isset($_POST['btnpsubmit']))
    {
        $pswd=$_POST['txtoldpswd'];
        $npswd=$_POST['txtnewpswd'];
        $cpswd=$_POST['txtconfirm'];
        
        if($npswd!=$cpswd)
        {
            echo "<script>alert('Confirmed Password is Incorrect');</script>";
        }
        else
        {
                $selp="select * from tbl_login where login_password='".$pswd."' and login_id='".$_SESSION['LoginID']."'";
                $rowp=mysqli_query($con,$selp);
                $num_rowp= mysqli_num_rows($rowp);

                if($num_rowp>0)
                { 
                    $selA2="update tbl_login set login_password='".$npswd."' where login_id='".$_SESSION['LoginID']."'";
                    mysqli_query($con,$selA2);
                    echo "<script>alert('Password Changed successfully!');</script>";
                }
                else
                {   
                    echo "<script>alert('Incorrect Password')</script>";

                }
            
            
        }
    }

?>
<!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Username</h4>
                    <br><br>
                    <form method="post" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Old Username</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="txtolduname" name="txtolduname" value=""  placeholder="Enter Your Old Username" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Username</label></div>
                            <div class="col-12 col-md-9"><input type="txtnewuname" id="txttype" name="txtnewuname" value=""  placeholder="Enter Your New Username" class="form-control"></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="btnsubmit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Change
                            </button>
                            <button type="reset" name="btnreset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <br><br>
                    <form method="post" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Old Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="txtoldpswd" name="txtoldpswd" value=""  placeholder="Enter Your Old Password" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="txttype" name="txtnewpswd" value=""  placeholder="Enter Your New Password" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="txtconfirm" name="txtconfirm" value=""  placeholder="Confirm Your Password" class="form-control"></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="btnpsubmit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Change
                            </button>
                            <button type="reset" name="btnpreset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->

<?php include '../footer.php'; ?>