<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <!-- partial -->
        <?php include '../header.php'; ?>
        <?php
        $pohead_id=$_GET['pohead_id'];
        $rid=$_GET['rid'];
        $selq="select * from tbl_paint_order_head ph inner join tbl_order_address oa on ph.oaddress_id=oa.oaddress_id inner join tbl_buyer b on ph.buyer_id=b.buyer_id where ph.pohead_id='".$pohead_id."'";
        mysqli_query($con,$selq);
        $rowq=mysqli_query($con,$selq);
        $dataq=mysqli_fetch_array($rowq);
        
        if(isset($_POST['btnaccept']))
        {
            header("Location:OrderSupplier.php?pohead_id=".$pohead_id);
        }

        if(isset($_POST['btnreject']))
        {
            $ins="update tbl_paint_order_head set pohead_status='rejected' where pohead_id='".$pohead_id."'";
            mysqli_query($con,$ins);
            echo "<script>
            alert('Rejected successfully');
            window.location.href='ViewOrders.php';
            </script>";
        }
        
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Customer info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtadd" value="<?php echo $dataq['buyer_name']?>" placeholder="Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Ph No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" name="txtplace" value="<?php echo $dataq['buyer_phno']?>" placeholder="Ph No:" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email:</label>
                                        <div class="col-sm-9">
                                            <input type="text"  readonly="" name="txtland" value="<?php echo $dataq['buyer_email']?>" placeholder="Email" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text"  readonly="" value="<?php echo $dataq['buyer_address']?>" name="txtpin" placeholder="Address" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <input type="text"  readonly="" name="txtland" value="<?php echo $dataq['oadress_landmark']?>" placeholder="Landmark" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pincode:</label>
                                        <div class="col-sm-9">
                                            <input type="text"  readonly="" value="<?php echo $dataq['oadress_pincode']?>" name="txtpin" placeholder="Pincode" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  <div class="card-body">
                    <h4 class="card-title">Items Details</h4>
                    <p class="card-description"> Item <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Color</th>
                          <th>Rate</th>
                          <th>Litre</th>
                          <th>Unit Total</th>
                          <!--<th>Remove</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $tot_amount=0;
                          $sel="select * from tbl_paint_order_detail od inner join tbl_paint_color pc on od.pcolor_id=pc.pcolor_id inner join tbl_paint p on pc.paint_id=p.paint_id where od.podetail_status<>'deactive' and od.pohead_id='".$pohead_id."'";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                              $tot_amount=$tot_amount+$data['podetail_unit_total'];
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['paint_name'];?></td>
                          <td><?php echo $data['pcolor_name'];?></td>
                          <td><?php echo $data['podetail_rate_per_lr'];?></td>
                          <td><?php echo $data['podetail_lr'];?></td>
                          <td><?php echo $data['podetail_unit_total'];?></td>
                          <!--<td class="text-success"><a href="PaintCart.php?rid=<?php echo $data['podetail_id'];?>">Remove </a></td>-->
                        </tr>
                          
                          <?php
                          $i++;
                          }
                          
                          ?>
                        <tr>
                            <td colspan="5" >Total AMount:</td>
                            <td  align="left"><?php echo $dataq['pohead_total_amount'];?> /-</td>
                        </tr>
                      </tbody>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if($dataq['pohead_cash']=="Cash on Delivery"){
                            ?>
                                <span class="btn btn-info"> CASH ON DELIVERY </span>
                            <?php
                            }else if($dataq['pohead_cash']=="Paid"){
                            ?>
                                <span class="btn btn-success"> PAID ON <?php echo $dataq['pohead_cash_date'];?></span>
                            <?php
                            }
                            ?>
                            <a href="ViewOrders.php" class="btn btn-light" style="float: right"> BACK </a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php include '../footer.php'; ?>

