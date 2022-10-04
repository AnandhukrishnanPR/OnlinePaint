<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <!-- partial -->
        <?php include '../header.php'; ?>
        <?php
        $drhead_id=$_GET['drhead_id'];
        $rid=$_GET['rid'];
        $selq="select * from tbl_design_request_head ph inner join tbl_order_address oa on ph.oaddress_id=oa.oaddress_id where ph.drhead_id='".$drhead_id."'";
        mysqli_query($con,$selq);
        $rowq=mysqli_query($con,$selq);
        $dataq=mysqli_fetch_array($rowq);
        
        if(isset($_POST['btnupdate']))
        {
            $ins="update tbl_order_address set oaddress='".$_POST['txtadd']."',oadress_place='".$_POST['txtplace']."',oadress_pincode='".$_POST['txtpin']."',oadress_landmark='".$_POST['txtland']."' where oaddress_id='".$dataq['oaddress_id']."'";
            mysqli_query($con,$ins);
            echo "<script>
            var sid ='".$drhead_id."';
            alert('Updated successfully');
            window.location.href='RequestProfile.php?drhead_id='+sid;
            </script>";
        }

        if($rid)
        {
            $ins="update tbl_design_request_detail set drdetail_status='deactive' where drdetail_id='".$rid."'";
            mysqli_query($con,$ins);
            echo "<script>
            var sid ='".$drhead_id."';
            alert('Deleted successfully');
            window.location.href='RequestProfile.php?drhead_id='+sid;
            </script>";
        }
        
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Request Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Address info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtadd" value="<?php echo $dataq['oaddress']?>" placeholder="Enter Address" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Place:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtplace" value="<?php echo $dataq['oadress_place']?>" placeholder="Enter Place" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Landmark:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="txtland" value="<?php echo $dataq['oadress_landmark']?>" placeholder="Enter Landmark" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pincode:</label>
                                        <div class="col-sm-9">
                                            <input type="text" pattern="[0-9]{0,6}" value="<?php echo $dataq['oadress_pincode']?>" name="txtpin" placeholder="Enter Pincode" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <button type="submit" name="btnupdate" class="btn btn-gradient-primary mr-2"> UPDATE ADRRESS </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  <div class="card-body">
                    <h4 class="card-title">Design Details</h4>
                    <p class="card-description"> Design <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Rate per Sq Ft</th>
                          <th>Square Feet</th>
                          <th>Unit Total</th>
                          <th>Description</th>
                          <!--<th>Remove</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $tot_amount=0;
                          $sel="select * from tbl_design_request_detail od inner join tbl_design p on od.design_id=p.design_id where od.drdetail_status<>'deactive' and od.drhead_id='".$drhead_id."'";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                              $tot_amount=$tot_amount+$data['podetail_unit_total'];
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['design_name'];?></td>
                          <td><?php echo $data['drdetail_rate_per_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_unit_total'];?></td>
                          <td><?php echo $data['drdetail_description'];?></td>
                          <!--<td class="text-success"><a href="PaintCart.php?rid=<?php //echo $data['drdetail_id'];?>">Remove </a></td>-->
                        </tr>
                          
                          <?php
                          $i++;
                          }
                          
                          ?>
                        <tr>
                            <td colspan="5" >Total AMount:</td>
                            <td><?php echo $dataq['drhead_total_amount'];?> /-</td>
                        </tr>
                      </tbody>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <form method="post" class="form-sample">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <button type="submit" name="btnsend" class="btn btn-gradient-primary"> CANCEL REQUEST </button>
                                    &nbsp;&nbsp;<a href="DesignRequestStatus.php" class="btn btn-gradient-light"> BACK </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['btnsend']))
                    {
                        $ins2 = "update tbl_design_request_head set drhead_status='cancelled' where drhead_id='".$drhead_id."'";
                        mysqli_query($con, $ins2);
                        header("Location:DesignRequestStatus.php");

                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php include '../footer.php'; ?>

