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
        $selq="select * from tbl_design_request_head ph inner join tbl_order_address oa on ph.oaddress_id=oa.oaddress_id inner join tbl_supplier b on ph.supplier_id=b.supplier_id where ph.drhead_id='".$drhead_id."'";
        mysqli_query($con,$selq);
        $rowq=mysqli_query($con,$selq);
        $dataq=mysqli_fetch_array($rowq);
        
        if(isset($_POST['btnaccept']))
        {
            header("Location:RequestSupplier.php?drhead_id=".$drhead_id);
        }

        if(isset($_POST['btnreject']))
        {
            $ins="update tbl_paint_order_head set pohead_status='rejected' where pohead_id='".$pohead_id."'";
            mysqli_query($con,$ins);
            header("Location:ViewRequests.php");
        }
        
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Address</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Delivery Address info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtadd" value="<?php echo $dataq['oaddress']?>" placeholder="Address" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Place:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtplace" value="<?php echo $dataq['oadress_place']?>" placeholder="Place" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Landmark:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtland" value="<?php echo $dataq['oadress_landmark']?>" placeholder="Landmark" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pincode:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" value="<?php echo $dataq['oadress_pincode']?>" name="txtpin" placeholder="Pincode" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Starting Info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Starting Date:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtadd" value="<?php echo $dataq['drhead_starting_date']?>" placeholder="Address" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Supplier Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtplace" value="<?php echo $dataq['supplier_name']?>" placeholder="Place" class="form-control" />
                                        </div>
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
                            <td colspan="4" >Total AMount:</td>
                            <td colspan="2"><?php echo $dataq['drhead_total_amount'];?> /-</td>
                        </tr>
                      </tbody>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <form method="post" class="form-sample">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <a href="DesignRequestStatus.php" class="btn btn-gradient-light" style="float: right"> BACK </a>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php include '../footer.php'; ?>

